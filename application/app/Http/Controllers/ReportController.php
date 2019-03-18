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
        //count how many fine paid
        $paid_fine_count_personal = personalreceipt::where('total_fine','>','0')
                                                   ->count();
        $paid_fine_count_group    = groupreceipt::where('total_fine','>','0')
                                                   ->count();
        $paid_fine_count  = $paid_fine_count_personal + $paid_fine_count_group;
        //count how many lost paid
        $paid_lost_count_personal = personalreceipt::where('total_price','>','0')
                                                   ->count();
        $paid_lost_count_group    = groupreceipt::where('total_price','>','0')
                                                   ->count();
        $paid_lost_count  = $paid_lost_count_personal + $paid_lost_count_group;
        //count total fine paid
        $report->paid_count = $paid_fine_count + $paid_lost_count;
        $paid_personal = personalreceipt::sum('total_fine') + personalreceipt::sum('total_price');
        $paid_group    = groupreceipt::sum('total_fine') + groupreceipt::sum('total_price');
        $report->total_paid  = $paid_personal + $paid_group;
        return response($report->toJson(),200);
    }

    public function get_month()
    {
        $report = report::all();
        return response($report->toJson(),200);
    }

}
