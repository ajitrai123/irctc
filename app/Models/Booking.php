<?php

namespace App\Models;

use App\Models\Agents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
  use HasFactory;

  protected $fillable = [
    'agentUid',
    'booking_sess_id',
    'cscRequestId',
    'passengerMobile',
    'fromStation',
    'toStation',
    'boardingStnName',
    'resvnUptoStnName',
    'journeyDate',
    'arrivalTime',
    'departureTime',
    'totPassengers',
    'gst_number',
    'companyname',
    'pincode_gst',
    'address_gst',
    'reservationchoice',
    'coachno',
    'travel_insurance',
    'dateOfBooking',
    'boardingDate',
    'boardingStation',
    'trainName',
    'trainNumber',
    'arrival',
    'bookedClass',
    'destStation',
    'journeyClass',
    'journeyQuota',
    'pnrNumber',
    'reservationId',
    'reservedUpto',
    'duration',
    'distance',
    'created_at',
    'updated_at',
    'ipAddress',
    'userAgent',
    'appVersion'

  ];
  public function agent()
  {
    return $this->belongsTo(Agents::class, 'agentUid', 'id');
  }
  public function fullrefund()
  {
    return $this->hasMany(fullrefund::class, 'bookingId', 'id');
  }
  public function partialrefund()
  {
    return $this->hasMany(partialrefund::class, 'bookingId', 'id');
  }
}
