<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partialrefund extends Model
{
    use HasFactory;
    protected $table = 'partial_refund';
    protected $fillable = [
      'id', 'bookingId', 'cancellationId', 'passengerUid',
      'passengerSerialNo', 'responseCode', 'responseStatus',
      'responseData', 'responseMessage', 'responseServer', 'responseDate',
      'otherData', 'created_at', 'updated_at',
      'status'
    ];
}
