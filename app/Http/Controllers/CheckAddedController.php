<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Cheque;
use App\Models\Receiver;
use App\Models\AccountCode;

class CheckAddedController extends Controller
{
    public function view(Request $request)
    {
        $query = Cheque::with(['payee', 'respocenter', 'accountcode']);
                         // ✅ sort check numbers numerically; // ✅ FIXED
        

        if ($request->filled('name')) {
            $query->whereHas('payee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('cheque_type')) {
            $query->where('cheque_type', $request->cheque_type);
        }

        if ($request->filled('fund_type')) {
            $query->where('fund_type', $request->fund_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('date_issued', [$request->date_from, $request->date_to]);
        }

        $cheques = $query->latest()->paginate(7);

        // ✅ Pass account codes to the view
        $accountcodes = AccountCode::all();

        return view('checkadded.index', compact('cheques', 'accountcodes'));
    }

    public function markReturned($id)
    {
        $cheque = Cheque::findOrFail($id);
        $cheque->status = 'returned';
        $cheque->date_returned = now();
        $cheque->save();

        return redirect()->back()->with('success', 'Cheque has been marked as returned.');
    }

    public function markCancelled($id)
    {
        $cheque = Cheque::findOrFail($id);
        $cheque->status = 'cancelled';
        $cheque->date_cancelled = now();
        $cheque->save();

        return redirect()->back()->with('success', 'Cheque has been marked as cancelled.');
    }


    public function release(Request $request, $id)
    {
        $refno = 'RECEIVER-' . date('Ymd') . '-' . rand(10000, 99999);
        $cheque = Cheque::findOrFail($id);
        $cheque->status = 'claimed';
        $cheque->date_release = now();
        $cheque->save();

        $signatureFileName = null;

        if ($request->filled('signature')) {
            $folderPath = public_path('signatureimages/');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $image_parts = explode(";base64,", $request->signature);
            $image_base64 = base64_decode($image_parts[1]);
            $receiverName = Str::slug($request->name, '_');  
            $dateNow = Carbon::now()->format('Ymd_His');
            $signatureFileName = "img_{$receiverName}_{$dateNow}.png";
            file_put_contents($folderPath . $signatureFileName, $image_base64);
        }

        Receiver::create([
            'ref_no'       => $refno,
            'cheque_id'    => $cheque->id,
            'contactno'    => $request->contactno,
            'name'         => $request->name,
            'date_claimed' => Carbon::now(),
            'signature'    => $signatureFileName,
        ]);

        return redirect()
            ->route('checkadded.index')
            ->with('success', 'Cheque released successfully.');
    }

    public function print(Request $request)
    {
        $query = Cheque::with(['payee', 'respocenter', 'accountcode', 'receiver'])
                        ->orderByRaw('CAST(no AS UNSIGNED) ASC');

        // ✅ Check if any filter/search input is used
        $hasFilter = $request->filled('name') ||
                    $request->filled('cheque_type') ||
                    $request->filled('fund_type') ||
                    $request->filled('account_code') ||
                    $request->filled('status') ||
                    ($request->filled('date_from') && $request->filled('date_to'));

        $cheques = collect(); // default: no data

        if ($hasFilter) {
            // Apply filters only when the user searches
            if ($request->filled('name')) {
                $query->whereHas('payee', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                });
            }

            if ($request->filled('cheque_type')) {
                $query->where('cheque_type', $request->cheque_type);
            }

            if ($request->filled('fund_type')) {
                $query->where('fund_type', $request->fund_type);
            }

            if ($request->filled('account_code')) {
                $query->whereHas('accountcode', function ($q) use ($request) {
                    $q->where('accountcode_name', $request->account_code);
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('date_issued', [$request->date_from, $request->date_to]);
            }

            $cheques = $query->get(); // ✅ get all results (no pagination)
        }

        $accountcodes = AccountCode::all();

        return view('checkadded.print', compact('cheques', 'accountcodes', 'hasFilter'));
    }

}
