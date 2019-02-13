<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalReceipt;
use App\PersonalRent;
use App\GroupReceipt;
use App\Grouprent;
use Carbon\Carbon;
use App\Report;


class ReportController extends Controller
{
    public function get_stats()
    {
        $report = new report;
        $unreturned_personal = personalrent::where('status','1')->count();
        $unreturned_group    = grouprent::where('status','1')->count();
        $unreturned          = $unreturned_personal + $unreturned_group;
        $report->unreturned  = $unreturned;
        //count expired
        $expired_personal = personalrent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                        ->where('status','2')
                                        ->count();
        $expired_group    =    grouprent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                        ->where('status','2')
                                        ->count();                                        
        $report->expired = $expired_personal + $expired_group;
        //count lost
        $lost_personal = personalrent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                     ->where('status','3')
                                     ->count();
        $lost_group    =    grouprent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                     ->where('status','3')
                                     ->count();                                           
        $report->lost = $lost_personal + $lost_group;
        //count how many fine paid
        $paid_fine_count_personal = personalreceipt::where('type','2')->count();
        $paid_fine_count_group    = groupreceipt::where('type','2')->count();
        $report->paid_fine_count  = $paid_fine_count_personal + $paid_fine_count_group;
        //count total fine paid
        $paid_fine_personal = personalreceipt::where('type','2')->sum('fine');
        $paid_fine_group    = groupreceipt::where('type','2')->sum('total');
        $report->paid_fine  = $paid_fine_personal + $paid_fine_group;
        //count how many lost paid 
        $paid_lost_count_personal = personalreceipt::where('type','3')->count();
        $paid_lost_count_group    = groupreceipt::where('type','3')->count();
        $report->paid_lost_count  = $paid_lost_count_personal + $paid_lost_count_group;

        //count total lost paid
        $paid_lost_personal = personalreceipt::where('type','3')->sum('fine');
        $paid_lost_group    = groupreceipt::where('type','3')->sum('total');
        $report->paid_lost  = $paid_lost_personal + $paid_lost_group;
        return response($report->toJson(),200);

    }

    public function get_month()
    {
        $report = report::all();
        return response($report->toJson(),200);
    }

}
