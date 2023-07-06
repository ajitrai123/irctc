<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
  use HasFactory;

  protected $table = 'payments';
  protected $fillable = [
    'agentUid', 'bookingId', 'csc_txn', 'reqTxn', 'txn_status', 'totalFare', 'wpServiceCharge', 'wpServiceTax', 'insuranceCharge', 'travelAgentCharge', 'cscCommission', 'walletAmount', 'totalCollectibleAmount', 'travelInsuranceServiceTax', 'productId', 'txn_amount', 'cscRequestId', 'created_at', 'updated_at', 'ipAddress', 'status', 'refundStart', 'otherData', 'userAgent', 'appVersion'
  ];
  public function agent()
  {
    return $this->belongsTo(Agents::class, 'agentUid', 'id');
  }
}
