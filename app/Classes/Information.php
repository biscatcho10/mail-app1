<?php

namespace App\Classes;

class Information
{
    private $app;

    private $currentIp;

    private $country;

    private $countryCode;

    private $latitude;

    private $longitude;

    private $city;

    private $browser;

    private $os;

    private $os_array = array(
        '/windows nt 10.0/i' => 'Windows 10',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    private $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );

    public function __construct()
    {
        $this->getAllInfoIP("194.36.108.89")->getAllInfoSystem();
    }

    /**
     * @param null $ip
     * @return $this
     */
    public function getAllInfoIP($ip = null): Information
    {
        $this->currentIp = request()->server("REMOTE_ADDR");
//        $this->currentIp = $ip;
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=" . $this->currentIp));
        $this->country = $geo["geoplugin_countryName"];
        $this->countryCode = $geo["geoplugin_countryCode"];
        $this->city = $geo["geoplugin_city"];
        $this->longitude = $geo["geoplugin_longitude"];
        $this->latitude = $geo["geoplugin_latitude"];
        return $this;
    }

    /**
     * @return $this
     */
    public function getAllInfoSystem(): Information
    {
        $user_agent = request()->server("HTTP_USER_AGENT");
        $this->os = "Unknown OS Platform";
        foreach ($this->os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $this->os = $value;
            }
        }
        $this->browser = "Unknown Browser";
        foreach ($this->browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $this->browser = $value;
            }
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->currentIp;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getOs()
    {
        return $this->os;
    }

    public function getBrowser()
    {
        return $this->browser;
    }
}
