<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;
use App\Models\RespoCenter;
use App\Models\Cheque;
use App\Models\Fund;
use App\Models\AccountCode;

class AdminController extends Controller
{

    public function view() {
        $lbpCount = Cheque::where('cheque_type', 'LBP')->count();
        $dbpCount = Cheque::where('cheque_type', 'DBP')->count();

        $lbpClaimed = Cheque::where('cheque_type', 'LBP')->where('status', 'claimed')->count();
        $lbpCancelled = Cheque::where('cheque_type', 'LBP')->where('status', 'cancelled')->count();

        $dbpClaimed = Cheque::where('cheque_type', 'DBP')->where('status', 'claimed')->count();
        $dbpCancelled = Cheque::where('cheque_type', 'DBP')->where('status', 'cancelled')->count();

        $claimedCount = Cheque::where('status', 'claimed')->count();
        $cancelledCount = Cheque::where('status', 'cancelled')->count();

        $payeeCount = Payee::count();
        $respoCount = RespoCenter::count();
        $fundCount = Fund::count();
        $accountCodeCount = AccountCode::count();

        $totalCount = $lbpCount + $dbpCount;

        return view('admin.dashboard.index', compact('lbpCount', 'dbpCount', 'totalCount', 'claimedCount', 'cancelledCount', 'lbpClaimed', 'lbpCancelled', 'dbpClaimed', 'dbpCancelled', 'respoCount', 'payeeCount', 'fundCount', 'accountCodeCount'));

    }

}
