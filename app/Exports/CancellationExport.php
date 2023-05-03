<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CancellationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($start, $end,$other)
    {
        $this->start = $start;
        $this->end = $end;
        $this->other = $other;
    }
    public function headings():array{
        return[
            'ID', 'AGENT ID', 'CSC TRANSACTION', 'BOOKINGID', 'PASSENGERNAME', 'AGE', 'GENDER', 'PASSENGERNATIONALITY', 'BERTH_PREFERENCE', 'FOOD_CHOICE', 'FOODCHOICEENABLED', 'PASSENGERDOCTYPE', 'PASSENGERPASSPORTNO', 'PASSENGERDOB', 'CHILDBIRTHREQUIRED', 'BEDROLL', 'PASSENGERNETFARE', 'PASSENGERSERIALNO', 'BOOKINGBERTHNO', 'BOOKINGCOACHID', 'BOOKINGSTATUS', 'CURRENTBERTHNO', 'CURRENTCOACHID', 'CURRENTSTATUS', 'PSGNWLTYPE', 'CANCELLATIONID', 'CANCELLATIONDATE',  'REFUNDREQDATE', 'REFUNDAMOUNT', 'STATUS', 'CREATED_AT', 'USERAGENT', 'OTHERDATA'
          ];
        //   CSC ID	Cancellation Id	Cancellation Date	CSC REQUEST ID	CSC TRANSACTION	RESERVATION ID	PNR NUMBER	AGENT ID	TRAIN NAME	JOURNEY DATE	BOOKING DATE	TRAIN NO.	From Station	To Station	Boarding Station	CREATION DATE

        //   CSC TRANSACTION	CSC ID	CSC REQUEST ID	AGENT ID	JOURNEY DATE	BOOKING DATE	PRODUCT ID	RESPONSE STATUS	RESPONSE MESSAGE	CREATION DATE	MERCHANT TRANSACTION	MERCHANT REFERENCE	REFUND REFERENCE	MERCHANT ID

        //   CSC ID	CSC Transaction	Cancellation Id	Cancellation Date	CSC REQUEST ID	REQUEST TRANSACTION	AGENT ID	JOURNEY DATE	BOOKING DATE	From Station	To Station	Boarding Station	CREATION DATE	REFUND DATE	PRODUCT ID	WALLET AMOUNT	REFUND AMOUNT	PNR	Reservation ID

    }
    public function collection()
    {
        $query = DB::table('passengers')
        ->join('bookings', 'bookings.id', '=', 'passengers.bookingId')
        ->join('agents', 'agents.id', '=', 'bookings.agentUid')
        ->join('payments', function ($join) {
            $join->on('payments.bookingId', '=', 'bookings.id')
                ->on('payments.agentUid', '=', 'agents.id');
        })
        ->select('passengers.id','agents.cscId','payments.csc_txn','passengers.bookingId','passengers.passengerName','passengers.age','passengers.gender','passengers.passengerNationality','passengers.berth_preference','passengers.food_choice','passengers.foodChoiceEnabled','passengers.passengerDocType','passengers.passengerPassportNo','passengers.passengerDob','passengers.childBirthRequired','passengers.bedroll','passengers.passengerNetFare','passengers.passengerSerialNo','passengers.bookingBerthNo','passengers.bookingCoachId','passengers.bookingStatus','passengers.currentBerthNo','passengers.currentCoachId','passengers.currentStatus','passengers.psgnwlType','passengers.cancellationId','passengers.cancellationDate','passengers.refundReqDate','passengers.refundAmount','passengers.status','passengers.created_at','passengers.userAgent','passengers.otherData');

        if (!empty($this->other)) {
            $query->where('bookings.id', 'like','%'. $this->other .'%')
            ->orWhere('agents.cscId','like','%'. $this->other .'%')
            ->orWhere('agents.agentUserId','like','%'. $this->other .'%')
            ->orWhere('payments.csc_txn','like','%'. $this->other .'%')
            ->orWhere('bookings.pnrNumber','like','%'. $this->other .'%')
            ->orWhere('passengers.cancellationId', 'like','%'. $this->other .'%');
        }    
        if (!empty($this->start) && !empty($this->end)) {
            $query->whereBetween('bookings.created_at', array($this->start, $this->end));
        }
        
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->cancellationDate=date("d/m/Y", strtotime($result[$key]->cancellationDate));
            $result[$key]->refundReqDate=date("d/m/Y", strtotime($result[$key]->refundReqDate));
        }
        // dd($result);
        return $result;
    }
}
