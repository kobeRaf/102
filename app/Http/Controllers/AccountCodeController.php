<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountCode;

class AccountCodeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'accountcode_name' => 'required|string|max:255',
        ]);
       
          
         $refno = 'ACC-' . date('Ymd') . '-' . rand(10000, 99999);

        AccountCode::create([
            'ref_no' => $refno,
            'accountcode_name' => $request->accountcode_name,
        ]);


        return redirect()->back()->with('success', 'Account Code added successfully!');
    }
}
