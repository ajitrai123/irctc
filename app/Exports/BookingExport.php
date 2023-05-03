<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingExport implements FromCollection,WithHeadings
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
            'CSC ID', 'CSC REQUEST ID', 'CSC TRANSACTION', 'RESERVATION ID', 'PNR NUMBER', 'AGENT ID', 'TRAIN NAME', 'JOURNEY DATE', 'BOOKING DATE', 'TRAIN NO.', 'From STATION', 'TO STATION', 'BOARDING STATION', 'CREATION DATE'
          ];
    }

    public function collection()
    {
        $query = DB::table('bookings')
        ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
        ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
            ->select('agents.cscId', 'bookings.cscRequestId', 'payments.csc_txn','bookings.reservationId', 'bookings.pnrNumber', 'agents.agentUserId', 'bookings.trainName', 'bookings.journeyDate', 'bookings.dateOfBooking', 'bookings.trainNumber', 'bookings.fromStation', 'bookings.toStation', 'bookings.boardingStation', 'bookings.created_at')
            ->where('bookings.status', 6); //use 6 for get all data where status is 5 in enum column
        if (!empty($this->other)) {
            $query->where('agents.cscId','like','%'. $this->other .'%')
            ->orWhere('agents.agentUserId','like','%'. $this->other .'%')
            ->orWhere('bookings.booking_sess_id','like','%'. $this->other .'%')
            ->orWhere('payments.csc_txn','like','%'. $this->other .'%')
            ->orWhere('bookings.pnrNumber','like','%'. $this->other .'%');
        }   
        if (!empty($this->start) && !empty($this->end)) {
            $query->whereBetween('bookings.created_at', array($this->start, $this->end));
        } 
        
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->dateOfBooking=date("d/m/Y", strtotime($result[$key]->dateOfBooking));
            $result[$key]->journeyDate=date("d/m/Y", strtotime($result[$key]->journeyDate));
        }
        // dd($result);
        return $result;
    }
}
