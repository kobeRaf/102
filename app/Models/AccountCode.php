<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountCode extends Model
{
   protected $table = 'accountcodes';

   protected $fillable = ['ref_no', 'accountcode_name'];
}
