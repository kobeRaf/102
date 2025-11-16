<?php

namespace App\Http\Controllers;

use App\Models\RespoCenter;
use Illuminate\Http\Request;

class RespoCenterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|',
            'name' => 'required|string|max:255',
        ]);

        $refno = 'RESPO-' . date('Ymd') . '-' . rand(10000, 99999);
        RespoCenter::create([
            'ref_no' => $refno,
            'code'   => $request->code,
            'name'   => $request->name,
        ]);

        return redirect()->back()->with('success', 'Respo Center added successfully!');
    }
}
