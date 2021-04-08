<?php declare(strict_types=1);
namespace eduroam\device;
class UserAgent{
	private $userAgent;
	const USER_AGENTS = [
		'stationary_windows' => ['/Windows NT [1-9]/'],
		'mobile_ios_legacy' => ['/\((iPad|iPhone|iPod);.*OS [1-9]_/', '/\((iPad|iPhone|iPod);.*OS 10_/'],
		'mobile_ios' => ['/\((iPad|iPhone|iPod);.*OS /'], // geteduroam is only supported on iOS 11+
		'stationary_macos' => ['/Mac OS X [1-9]/'], // Big Sur is 11, but Safari is locked on 10
		'stationary_linux' => ['/Linux(?!.*Android)/'],
		'stationary_chromeos' => ['/CrOS/'],
		'mobile_android_legacy' => ['/Android [4-7][._][0-9]/'], // geteduroam is only supported on Android 8+
		'mobile_android' => ['/Android [89][._][0-9]/', '/Android [1-9][0-9]+[._][0-9]/'],
		0 => ['//'],
	];
	const OS_NAMES = [
		'windows' => 'Windows',
		'ios_legacy' => 'iOS',
		'ios' => 'iOS',
		'macos' => 'macOS',
		'linux' => 'Linux',
		'chromeos' => 'ChromeOS',
		'android_legacy' => 'Android',
		'android' => 'Android',
	];
	const CAT_MAPS = [
		'w10' => 'stationary_windows',
		'apple_global' => 'stationary_macos',
		'android_recent' => 'mobile_android',
		'android_8_10' => 'mobile_android',
		'android_4_7' => 'mobile_android_legacy',
		'linux' => 'stationary_linux',
		'chromeos' => 'stationary_chromeos',
	];

	public function __construct( string $userAgent = null ) {
		$this->userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'];
	}

	public function getUserAgentName():?string{
		if ( array_key_exists( $this->userAgent, static::USER_AGENTS ) ) {
			return $this->userAgent;
		}
		if ( array_key_exists( $this->userAgent, static::CAT_MAPS ) ) {
			return static::CAT_MAPS[$this->userAgent];
		}
		foreach( static::USER_AGENTS as $userAgent => $regexes ){
			foreach( $regexes as $regex ) {
				if ( is_string( $userAgent ) && preg_match( $regex, $this->userAgent ) ) {
					return $userAgent;
				}
			}
		}
		return null;
	}
	public function getOS():?string{
		$agentName = $this->getUserAgentName();
		if ( $agentName === null ) return null;
		return substr( strstr( $agentName, '_' , false ), 1 );
	}
	public function getType():?string{
		$agentName = $this->getUserAgentName();
		if ( $agentName === null ) return null;
		return strstr( $agentName, '_' , true );
	}

	public function getOSName():?string{
		$os = $this->getOS();
		if ( $os === null ) return null;
		if ( array_key_exists( $os, static::OS_NAMES ) ) {
			return static::OS_NAMES[$os];
		}
		return null;
	}
}
