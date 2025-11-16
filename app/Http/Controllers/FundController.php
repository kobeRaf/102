<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|',
            'name' => 'required|string|max:255',
        ]);

        $refno = 'FUND-' . date('Ymd') . '-' . rand(10000, 99999);
        Fund::create([
            'ref_no' => $refno,
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Fund added successfully!');
    }
}
