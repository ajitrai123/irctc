<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdrHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'reasonIndex',
        'tdr_reason',
        'status'
     ];
}
