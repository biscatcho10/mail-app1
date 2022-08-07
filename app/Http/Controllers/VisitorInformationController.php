<?php

namespace App\Http\Controllers;

use App\Classes\Information;
use App\Models\VisitorInformation;

class VisitorInformationController extends Controller
{

    private $info;

    public function __construct()
    {
        $this->info = new Information();
    }

    public function saveInformation()
    {
        // $this->info->getAllInfoIP($this->ip)->getAllInfoSystem();
        $visitorInfo = new VisitorInformation();
        $this->extracted($visitorInfo);
        $visitorInfo->save();
    }

    /**
     * @return mixed
     */
    public function updateLastVisit()
    {
        date_default_timezone_set("Africa/Cairo");
        $visitorInfo = VisitorInformation::where("vis_ip", $this->info->getIp())->first();
        if ($visitorInfo) {
            $this->extracted($visitorInfo);
            $visitorInfo->vis_lastvisit = date('Y-m-d H:i:s', time());
            $visitorInfo->save();
        } else {
            $this->saveInformation();
        }
        return $this->info->getIp();
    }

    /**
     * @param $visitorInfo
     */
    public function extracted($visitorInfo): void
    {
        $visitorInfo->vis_ip = $this->info->getIp();
        $visitorInfo->vis_city = $this->info->getCity();
        $visitorInfo->vis_country = $this->info->getCountry();
        $visitorInfo->vis_countrycode = $this->info->getCountryCode();
        $visitorInfo->vis_os = $this->info->getOs();
        $visitorInfo->vis_browser = $this->info->getBrowser();
        $visitorInfo->vis_latitude = $this->info->getLatitude();
        $visitorInfo->vis_longitude = $this->info->getLongitude();
    }
}
