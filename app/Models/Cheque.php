<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $table = 'cheques';

    protected $fillable = [
        'ref_no',
        'no',
        'amount',
        'status',
        'cheque_type',
        'dvno',
        'nop',
        'fund_type',
        'date_issued',
        'date_returned',
        'date_cancelled',
        'date_claimed',
        'accountcode_id',
        'respocenter_id',
        'payee_id',
    ];

    public function respocenter()
    {
        return $this->belongsTo(RespoCenter::class);
    }

    public function payee()
    {
        return $this->belongsTo(Payee::class);
    }

    public function receiver()
    {
        return $this->hasOne(Receiver::class);
    }

        public function accountcode()
    {
        return $this->belongsTo(AccountCode::class);
    }
}
