<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class WaitingCancellationExport implements FromCollection,WithHeadings
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
            'AGENT ID', 'CSC TRANSACTION', 'RESERVATION ID', 'AMOUNT COLLECTED', 'CANCELLATION ID', 'CANCELLED DATE', 'CASH DEDUCTED', 'CURRENT STATUS', 'PNR', 'REFUND AMOUNT', 'STATUS'
          ];
    }
    								

    public function collection()
    {
        $query = DB::table('bookings')
        ->join('passengers', 'bookings.id', '=', 'passengers.bookingId')
        ->join('payments', 'bookings.id', '=', 'payments.bookingId')
        ->join('agents', 'bookings.agentUid', '=', 'agents.id')
            ->select('agents.agentUserId', 'payments.csc_txn', 'bookings.reservationId', 'bookings.cscRequestId', 'bookings.passengerMobile', 'passengers.cancellationDate', 'bookings.toStation', 'bookings.pnrNumber', 'bookings.resvnUptoStnName', 'bookings.status');

        if (!empty($this->other)) {
            $query->where('agents.agentUserId', 'like','%'. $this->other .'%')
            ->orWhere('agents.cscId', 'like','%'. $this->other .'%')
            ->orWhere('bookings.pnrNumber', 'like','%'. $this->other .'%')
            ->orWhere('payments.reqTxn','like','%'. $this->other .'%');
        } 
        if (!empty($this->start) && !empty($this->end)) {
            $query->whereBetween('passengers.cancellationDate', array($this->start, $this->end));
        }   
                
        $result = $query->get();
        foreach ($result as $key => $value) {
        //     $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->cancellationDate=date("d/m/Y", strtotime($result[$key]->cancellationDate));
        //     $result[$key]->boardingDate=date("d/m/Y", strtotime($result[$key]->boardingDate));
        }
        // dd($result);
        return $result;
    }
    
}
