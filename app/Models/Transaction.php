<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
      'id', 'agentUid', 'bookingId', 'csc_txn',
      'reqTxn', 'txn_status', 'totalFare',
      'wpServiceCharge', 'wpServiceTax', 'insuranceCharge', 'travelAgentCharge',
      'cscCommission', 'walletAmount', 'totalCollectibleAmount',
      'travelInsuranceServiceTax', 'productId', 'txn_amount', 'cscRequestId', 'created_at', 'updated_at', 'ipAddress', 'status', 'refundStart', 'otherData', 'userAgent', 'appVersion'
    ];
    
}
