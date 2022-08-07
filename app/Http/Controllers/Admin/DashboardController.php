<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VisitorInformationController;
use App\Models\Category;
use App\Models\Email;
use App\Models\Mail;
use App\Models\VisitorInformation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
//        $this->visitors();
//        $visitors = [
//            "all" => VisitorInformation::count(),
//            "last30days" => VisitorInformation::whereDate("vis_lastvisit", '>', Carbon::now()->subDays(30))->count()
//        ];
//        $social = ['allSocial' => 0,'allCount'=>0,'last30daysClick'=>0,'last30daysCount'=>0];
//        $stores = ['allStore' => 0,'allCount'=>0,'last30daysClick'=>0,'last30daysCount'=>0];
//        $clicks = ['allClick' => 0,'allCount'=>0,'last30daysClick'=>0,'last30daysCount'=>0];
        $emails = count(Email::all());
        $categories = count(Category::all());
        $mails = count(Mail::all());
        $scheduled_mails = count(DB::select('SELECT * FROM jobs'));

        return view("admin.components.dashboard.index", compact('emails', 'categories', 'mails', 'scheduled_mails'));
    }

    /**
     * @return JsonResponse
     */
    public function mapData(): JsonResponse
    {
        return response()->json(VisitorInformation::visitorsMap());
    }

    /**
     * @return JsonResponse
     */
    public function browserUsage(): JsonResponse
    {
        return response()->json(VisitorInformation::visitorsBrowser());
    }

    public function visitors()
    {
        (new VisitorInformationController)->updateLastVisit();
    }

}
