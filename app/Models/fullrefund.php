<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fullrefund extends Model
{
    use HasFactory;

    protected $table = 'full_refund';
    protected $fillable = [
        'bookingId', 'responseCode', 'responseStatus',
         'responseData', 'responseMessage', 'responseServer',
          'responseDate', 'irctc_errorMsg','otherData','created_at','updated_at',
          'status'
    ];
}
