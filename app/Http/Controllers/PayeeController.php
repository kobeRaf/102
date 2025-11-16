<?php

namespace App\Http\Controllers;

use App\Models\Payee;
use Illuminate\Http\Request;

class PayeeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',
        ]);
        
        $refno = 'PAYEE-' . date('Ymd') . '-' . rand(10000, 99999);
        Payee::create([
            'ref_no' => $refno,
            'name' => $request->name,
        ]);

        return redirect()->back()
            ->withInput() // restores cheque form values carried as hidden inputs
            ->with('success', 'Payee added successfully!');
    }
}
