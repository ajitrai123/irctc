<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
