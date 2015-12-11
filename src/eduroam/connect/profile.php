<?php declare(strict_types=1);
namespace Eduroam\Connect;

use \stdClass;

use \Eduroam\CAT\CAT;

/**
 * Configuration profile.
 *
 * An identity provider may have one or more profiles.  These represent a method
 * to configure eduroam and will typically be available for multiple devices.
 */
class Profile {

	/**
	 * List of all profiles by CAT base, identity provider and language.
	 *
	 * This profile data structure contains the name of the profile.
	 *
	 * This variable is static to facilitate lazy-loading.
	 * The CAT API has no support to get one identity provider,
	 * so we'll have to get them all at the same time.
	 *
	 * @link https://cat.eduroam.org/doc/UserAPI/tutorial_UserAPI.pkg.html#actions.listProfiles
	 */
	static $profiles;
	/**
	 * List of all profile attributes by CAT base, identity provider and language.
	 *
	 * This profile data structure contains data about the profile, such as
	 * devices, support information and custom texts.
	 *
	 * This variable is static to facilitate lazy-loading.
	 * The CAT API has no support to get one identity provider,
	 * so we'll have to get them all at the same time.
	 *
	 * @link https://cat.eduroam.org/doc/UserAPI/tutorial_UserAPI.pkg.html#actions.listProfiles
	 */
	static $profileAttributes;

	/**
	 * Fill lazy loaded $profiles.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $idpID Identity provider ID
	 * @param string $lang Language
	 */
	private static function loadProfilesByIdPEntityID(CAT $cat, int $idpID, string $lang = '') {
		if (!isset(static::$profiles[$cat->getBase()][$idpID][$lang])) {
			foreach($cat->listProfiles($idpID, $lang) as $profile) {
				static::$profiles[$cat->getBase()][$idpID][$lang][$profile->id] = $profile;
			}
		}
	}

	/**
	 * Get all profiles as lazy loaded objects in an indexed array.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $idpID Identity provider ID
	 * @param string $lang Language
	 *
	 * @return Profile[]
	 */
	public static function getProfilesByIdPEntityID(CAT $cat, int $idpID, string $lang = ''): array {
		static::loadProfilesByIdPEntityID($cat, $idpID, $lang);
		$profiles = [];
		foreach(static::$profiles[$cat->getBase()][$idpID][$lang] as $profile) {
			$profiles[$profile->id] = new Profile($cat, $idpID, (int)$profile->id, $lang);
		}
		return $profiles;
	}

	/**
	 * Fill lazy loaded profile with its attributes.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $profileID Profile ID
	 * @param string $lang Language
	 */
	private static function loadProfileAttributesByID(CAT $cat, int $profileID, string $lang = '') {
		if (!isset(static::$profileAttributes[$cat->getBase()][$profileID][$lang])) {
			static::$profileAttributes[$cat->getBase()][$profileID][$lang] = $cat->profileAttributes($profileID, $lang);
		}
	}

	/**
	 * Get raw devices by profile ID.
	 *
	 * This method gets the devices from the already loaded profile attributes,
	 * or returns null.  This way, the devices that were sent with the attributes
	 * may be reused instead of retrieving them again.
	 * @param CAT $cat CAT instance
	 * @param int $profileID Profile ID
	 * @param string $lang Language
	 *
	 * @return stdClass[]
	 */
	public static function getRawDevicesByProfileID(CAT $cat, int $profileID, string $lang = ''): array {
		if (isset(static::$profileAttributes[$cat->getBase()][$profileID][$lang]->devices)) {
			return static::$profileAttributes[$cat->getBase()][$profileID][$lang]->devices;
		}
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
	 * Language flag to use in requests against CAT
	 * @var string
	 */
	private $lang;

	/**
	 * Construct a lazy loaded profile.
	 *
	 * @param CAT $cat CAT instance
	 * @param int $idpID Identity provider ID
	 * @param int $profileID Profile ID
	 * @param string $lang Language
	 */
	public function __construct(CAT $cat, int $idpID, int $profileID, string $lang = '') {
		$this->cat = $cat;
		$this->idpID = $idpID;
		$this->profileID = $profileID;
		$this->lang = $lang;
	}

	/**
	 * Get the raw data associated with this profile, containing the name.
	 *
	 * This is the JSON data converted to a PHP object.
	 *
	 * @return stdClass
	 */
	public function getRaw(): stdClass {
		self::loadProfileAttributesByID($this->cat, $this->profileID, $this->lang);
		return static::$profileAttributes[$this->cat->getBase()][$this->profileID][$this->lang];
	}

	/**
	 * Get the raw data of this profile's attributes, containing contact info and
	 * devices.
	 *
	 * This is the JSON data converted to a PHP object.
	 *
	 * @return stdClass
	 */
	public function getRawAttributes(): stdClass {
		self::loadProfilesByIdPEntityID($this->cat, $this->idpID, $this->lang);
		return static::$profiles[$this->cat->getBase()][$this->idpID][$this->lang][$this->profileID];
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
	 * Get the ID of this identity provider as it is stored in the CAT database.
	 *
	 * @return int The identity provider ID
	 */
	public function getIdpID(): int {
		return $this->idpID;
	}

	/**
	 * Get the friendly name of this profile.
	 *
	 * @return string The friendly name of this profile
	 */
	public function getDisplay(): string {
		static::loadProfilesByIdPEntityID($this->cat, $this->idpID, $this->lang);
		if (!static::$profiles[$this->cat->getBase()][$this->idpID][$this->lang][$this->profileID]->display) {
			return $this->getIdentityProvider()->getDisplay();
		} else {
			return $this->getRawAttributes()->display;
		}
	}

	/*
	 * omitting #hasLogo() and #getIdentityProviderName() because these
	 * belong in the IdentityProvider class.
	 */

	/**
	 * Get the support e-mail address for this profile.
	 *
	 * @return string|null support e-mail address for this profile
	 */
	public function getLocalEmail() {
		$raw = $this->getRaw();
		if (isset($raw->local_email)) {
			return $raw->local_email;
		}
	}

	/**
	 * Get the support telephone number address for this profile.
	 *
	 * @return string|null support telephone number address for this profile
	 */
	public function getLocalPhone() {
		$raw = $this->getRaw();
		if (isset($raw->local_phone)) {
			return $raw->local_phone;
		}
	}

	/**
	 * Get the support URL address for this profile.
	 *
	 * @return string|null support URL address for this profile
	 */
	public function getLocalUrl() {
		$raw = $this->getRaw();
		if (isset($raw->local_url)) {
			return $raw->local_url;
		}
	}

	/**
	 * Get the description for this profile in plain unformatted text.
	 * This is displayed on the download page.
	 *
	 * @return string|null support e-mail address for this profile
	 */
	public function getDescription() {
		$raw = $this->getRaw();
		if (isset($raw->description)) {
			return $raw->description;
		}
	}

	/**
	 * Get the supported devices for this profile in an indexed array.
	 *
	 * @return Device[]
	 */
	public function getDevices(): array {
		static::loadProfileAttributesByID($this->cat, $this->profileID);
		$devices = [];
		foreach($this->getRaw()->devices as $device) {
			if (($device->redirect || $device->status >= 0) && (!isset($device->options->hidden) || !$device->options->hidden))
			$devices[$device->id] = new Device($this->cat, $this->idpID, $this->profileID, $device->id, $this->lang);
		}
		return $devices;
	}

	/**
	 * Determines whether this profile is supported by the identity provider.
	 * A profile is considered supported if one of the following is available:
	 * support email, support phone, local url.
	 *
	 * @return bool This profile is supported
	 */
	public function hasSupport(): bool {
		return $this->getLocalEmail() || $this->getLocalPhone() || $this->getLocalUrl();
	}

	/**
	 * Get a lazy loaded instance of the identity provider that is associated with
	 * this profile.
	 *
	 * @return IdentityProvider
	 */
	public function getIdentityProvider(): IdentityProvider {
		return new IdentityProvider($this->cat, $this->idpID, $this->lang);
	}

	/**
	 * Determines whether a redirect is set for this profile.
	 *
	 * @return bool Profile has a redirect set
	 */
	public function isRedirect(): bool {
		foreach($this->getDevices() as $device) {
			if (!$device->isProfileRedirect()) {
				return false;
			}
		}
		return true;
	}

}
