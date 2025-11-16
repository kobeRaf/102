<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespoCenter extends Model
{
    protected $table = 'respocenters';

    protected $fillable = ['ref_no', 'code', 'name'];
}
