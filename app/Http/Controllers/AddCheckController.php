<?php
namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Models\RespoCenter;
use App\Models\Payee;
use App\Models\Fund;
use App\Models\AccountCode;

use Illuminate\Http\Request;


class AddCheckController extends Controller
{
    public function view()
    {
        $respocenters = RespoCenter::all();
        $funds = Fund::all();
        $payees = Payee::all();
        $accountcodes = AccountCode::all();
        $recentCheques = Cheque::with(['payee', 'respocenter'])
            ->latest()
            ->take(5)
            ->get();

        return view('addcheck.index', compact('respocenters', 'payees', 'recentCheques', 'funds', 'accountcodes'));
    }

    public function store(Request $request) 
    {
        $refno = 'CHECK-' . date('Ymd') . '-' . rand(10000, 99999);
        $request->merge([
            'amount' => str_replace(',', '', $request->amount),
            'ref_no' => $refno,
        ]);

        $request->validate([
            'ref_no' => 'required|string|max:255|unique:cheques,ref_no',
            'no' => 'required|unique:cheques,no',
            'amount' => 'required|numeric',
            'status' => 'required|string|max:50',
            'dvno' => 'required|string|max:50',
            'nop' => 'required|string|max:50',
            'cheque_type' => 'required|string|max:50',
            'fund_type' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'date_returned' => 'nullable|date',
            'accountcode_id' => 'required|exists:accountcodes,id',
            'respocenter_id' => 'nullable|exists:respocenters,id',
            'payee_id' => 'required|exists:payees,id',
        ]);

        Cheque::create($request->all());

        return redirect()->back()->with('success', 'Cheque added successfully!');
    }
}
