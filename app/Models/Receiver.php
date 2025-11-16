<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
    {
        protected $table = 'receivers';

        protected $fillable = ['ref_no', 'name', 'contactno', 'date_claimed', 'cheque_id', 'signature'];

            public function cheque()
        {
            return $this->belongsTo(Cheque::class);
        }
    }


