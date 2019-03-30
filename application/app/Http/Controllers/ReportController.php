<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalReceipt;
use App\PersonalRent;
use App\GroupReceipt;
use App\GroupRent;
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
                                        ->whereIn('status', ['2','3','5','6','8'])
                                        ->count();
        $expired_group    =    grouprent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                        ->whereIn('status', ['2','3','5','6','8'])
                                        ->count();                                        
        $report->expired = $expired_personal + $expired_group;

        //count lost
        $lost_personal = personalrent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                     ->whereIn('status', ['4', '5','7','8'])
                                     ->count();
        $lost_group    =    grouprent::where('item_out', '>=', Carbon::now()->startOfMonth())
                                     ->whereIn('status', ['4', '5','7','8'])
                                     ->count();                                        
        $report->lost = $lost_personal + $lost_group;

        //count number and total of fine paid
        $fine_paid_count_personal = personalreceipt::where('total_fine','>','0')
                                                   ->count();
        $fine_paid_count_group    = groupreceipt::where('total_fine','>','0')
                                                   ->count();
        $report->fine_paid_count  = $fine_paid_count_personal + $fine_paid_count_group;
        $report->fine_total_paid    = groupreceipt::sum('total_fine') + personalreceipt::sum('total_fine');

        //count number and total of lost paid
        $lost_paid_count_personal = personalreceipt::where('total_price','>','0')
                                                   ->count();
        $lost_paid_count_group    = groupreceipt::where('total_price','>','0')
                                                   ->count();
        $report->lost_paid_count  = $lost_paid_count_personal + $lost_paid_count_group;
        $report->lost_total_paid = groupreceipt::sum('total_price') + personalreceipt::sum('total_price');

        return response($report->toJson(),200);
    }

    public function get_month()
    {
        $report = report::all();
        return response($report->toJson(),200);
    }

}
