<?php declare(strict_types=1);
namespace Eduroam\Connect;

use \stdClass;

use \Eduroam\CAT\CAT;

/**
 * A device that can be used on the eduroam network with a given profile.
 */
class Device {

	/**
	 * List of groups as they appear in the UI
	 */
	const DEVICE_GROUPS = [
		'Windows' => ['/^w[0-9]/', '/^vista$/'],
		'Apple' => ['/^apple/', '/^mobileconfig/'],
		'Android' => ['/^android/'],
		'Other' => ['//'],
	];


	/**
	 * List of all devices, by CAT base, identity and profile.
	 *
	 * This variable is static to facilitate lazy-loading.
	 * The CAT API has no support to get one identity provider,
	 * so we'll have to get them all at the same time.
	 */
	public static $devices;

	/**
	 * Fill lazy loaded $devices.
	 *
	 * Consumers should be hesitant to use this function, and should try to get
	 * the devices from Profile::getDevices() first, since it may already have
	 * loaded them into memory.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $idpID Identity provider ID
	 * @param int $profileID Profile ID
	 * @param string $lang Language
	 *
	 * @see https://cat.eduroam.org/doc/UserAPI/tutorial_UserAPI.pkg.html#actions.listDevices
	 */
	private static function loadDevices(CAT $cat, int $idpID, int $profileID, string $lang = '') {
		$devices = 0;
		if (!isset(static::$devices[$cat->getBase()][$lang][$idpID][$profileID])) {
			$devices = Profile::getRawDevicesByProfileID($cat, $profileID, $lang);
			if (!$devices) {
				$devices = $cat->listDevices($profileID);
			}
			foreach($devices as $device) {
				static::$devices[$cat->getBase()][$lang][$idpID][$profileID][$device->id] = $device;
			}
		}
	}

	/**
	 * Add a group dimension to the given $devices array, so that the UI can group
	 * the different device profiles into a more generic operating system group.
	 *
	 * @param Device[] $devices The devices to group, typically output from
	 * 	Profile#getDevices()
	 *
	 * @return Device[][]
	 */
	public static function groupDevices(array $devices): array {
		// Make array with same keys as DEVICE_GROUPS, but all initial values are []
		$result = array_map(function(){return [];}, static::DEVICE_GROUPS);
		foreach($devices as $device) {
			if ($device->getStatus() != 0) continue;
			$group = null;
			foreach(static::DEVICE_GROUPS as $maybeGroup => $osRegexps) {
				foreach($osRegexps as $osRegexp) {
					if (preg_match($osRegexp, $device->getDeviceID()) === 1) {
						$group = $maybeGroup;
						break 2;
					}
				}
			}
			if (!is_null($group)) {
				$result[$group][] = $device;
			}
		}
		foreach($result as $key => $value) {
			if (!$result[$key]) {
				unset($result[$key]);
			}
		}
		return $result;
	}

	/**
	 * CAT instance
	 * @var CAT
	 */
	private $cat;
	/**
	 * Identity provider Entity ID in CAT API
	 * @var int
	 */
	private $idpID;
	/**
	 * Profile ID in CAT API
	 * @var int
	 */
	private $profileID;
	/**
	 * Device ID in CAT API
	 * @var int
	 */
	private $deviceID;
	/**
	 * Device info, this is a separate CAT call and thus not in #getRaw()
	 */
	private $deviceInfo;
	/**
	 * Language flag to use in requests against CAT
	 * @var string
	 */
	private $lang;

	/**
	 * Construct a new lazy loaded device.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $idpID Identity provider ID
	 * @param int $profileID Profile ID
	 * @param string $deviceID Device ID
	 * @param string $lang Language
	 */
	public function __construct(CAT $cat, int $idpID, int $profileID, string $deviceID, string $lang = '') {
		$this->cat = $cat;
		$this->idpID = $idpID;
		$this->profileID = $profileID;
		$this->deviceID = $deviceID;
		$this->lang = $lang;
	}

	/**
	 * Get the ID of this device as it is stored in the CAT database.
	 *
	 * @return string The device ID
	 */
	public function getDeviceID(): string {
		return $this->deviceID;
	}

	/**
	 * Get the ID of this profile as it is stored in the CAT database.
	 *
	 * @return int The profile ID
	 */
	public function getProfileID(): int {
		return $this->profileID;
	}

	/**
	 * Get the raw data associated with this device.
	 *
	 * This is the JSON data converted to a PHP object.
	 *
	 * @return stdClass
	 */
	public function getRaw(): stdClass {
		$this->loadDevices($this->cat, $this->idpID, $this->profileID, $this->lang);
		return static::$devices[$this->cat->getBase()][$this->lang][$this->idpID][$this->profileID][$this->deviceID];
	}

	/**
	 * Get the friendly name for this device.
	 *
	 * This will typically be the operating system that runs on this device.
	 * There are some special cases, such as 'EAP config' and 'External', where
	 * the first is a special kind of configuration profile provided by CAT and
	 * the latter is an internal method for handling profiles that only provide
	 * a redirect.
	 *
	 * @return string
	 */
	public function getDisplay(): string {
		$raw = $this->getRaw();
		if ($this->isProfileRedirect()) {
			return 'External';
		}
		return $raw->display;
	}

	/**
	 * Get the status of this device.
	 *
	 * It's not clear what this means, but 0 appears to mean success.
	 *
	 * @return int status
	 */
	public function getStatus(): int {
		$raw = $this->getRaw();
		if (isset($raw->status)) {
			return $raw->status;
		}
	}

	/**
	 * Get the redirect URL where the configuration for this device can be
	 * obtained.  This feature may be used by an identity provider that has custom
	 * profiles or those that want to push extra settings through their profiles.
	 *
	 * If this device is available through CAT, this function will return a falsey
	 * value.  Use #getDownloadLink() to always get a link you can send your user
	 * to.
	 *
	 * @return string Redirect URL
	 */
	public function getRedirect(): string {
		return $this->getRaw()->redirect;
	}

	/**
	 * Get the admin-provided custom EAP text.
	 *
	 * This text may provide important information to the user and must be visible
	 * on the download page.  If no text is provided, this function will return
	 * a falsey value.
	 *
	 * @return string|null Admin-provided custom EAP text
	 */
	public function getEapCustomText() {
		if (isset($this->getRaw()->eap_customtext)) {
			return $this->getRaw()->eap_customtext;
		}
	}

	/**
	 * Get the admin-provided custom device text.
	 *
	 * This text may provide important information to the user and must be visible
	 * on the download page.  If no text is provided, this function will return
	 * a falsey value.
	 *
	 * @return string|null Admin-provided custom device text
	 */
	public function getDeviceCustomText() {
		if (isset($this->getRaw()->device_customtext)) {
			return $this->getRaw()->device_customtext;
		}
	}

	/**
	 * (undocumented feature)
	 *
	 * This is another message the CAT API can return.
	 * As opposed to other custom texts, the message contains HTML code.
	 * This documentation is based on reverse engineering and may improve when
	 * better documentation becomes available.
	 *
	 * @deprecated
	 *
	 * @return string|null HTML message, without enclosing <p>
	 */
	public function getMessage() {
		if (isset($this->getRaw()->message)) {
			return $this->getRaw()->message;
		}
	}

	/**
	 * (undocumented feature)
	 *
	 * This is another message the CAT API can return.
	 * As opposed to other custom texts, the message contains HTML code.
	 * This documentation is based on reverse engineering and may improve when
	 * better documentation becomes available.
	 *
	 * @deprecated
	 *
	 * @return string|null HTML message, with enclosing <p>
	 */
	public function getDeviceInfo() {
		if ($this->isRedirect()) {
			// Seems like CAT doesn't answer this one on redirects...
			return null;
		}
		if (!isset($this->deviceInfo)) {
			$this->deviceInfo = $this->cat->getDeviceInfo($this->getDeviceID(), $this->getProfileID());
		}
		return $this->deviceInfo;
	}

	/**
	 * Get the download link for this device.
	 *
	 * When the device's configration profile is available on CAT, this function
	 * will return the canonical URL of the device's profile on CAT.  If the
	 * profile provides this device with a redirect, this function will return the
	 * URL the redirect points to.
	 *
	 * @return string URL
	 */
	public function getDownloadLink(): string {
		if ($this->isRedirect()) {
			return $this->getRaw()->redirect;
		}
		$this->cat->generateInstaller($this->getDeviceID(), $this->getProfileID());
		return $this->cat->getBase() . '?'
			.	http_build_query(['action' => 'downloadInstaller', 'id' => $this->getDeviceID(), 'profile' => $this->getProfileID()], '', '&', PHP_QUERY_RFC3986);
	}

	/**
	 * Determines whether this device's download link is a redirect.
	 *
	 * @return bool This device's URL is a redirect
	 */
	public function isRedirect(): bool {
		return !!$this->getRaw()->redirect;
	}

	/**
	 * Determines whether this device's download link is a redirect set by the
	 * profile that this device is a part of.
	 *
	 * @return bool Redirect is set by the profile
	 */
	public function isProfileRedirect(): bool {
		$raw = $this->getRaw();
		return $this->deviceID === '0' && !isset($raw->display) && $raw->redirect;
	}

}
