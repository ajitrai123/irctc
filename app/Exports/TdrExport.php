<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TdrExport implements FromCollection,WithHeadings
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
            'CSC ID', 'AGENT ID', 'TRANSACTION ID', 'BOOKING DATE', 'JOURNEY DATE','PNR NUMBER', 'TDR APPLICATION DATE', 'TDR REASON', 'RESPONSE'
          ];
    }
    								

    public function collection()
    {
        $query = DB::table('tdr_history')
        ->join('bookings', 'tdr_history.bookingId', '=', 'bookings.id')
        ->join('agents', 'tdr_history.agentUid', '=', 'agents.id')
        ->join('tdr_list', 'tdr_history.tdr_reason', '=', 'tdr_list.id')
        ->join('passengers', 'tdr_history.passengers_id', '=', 'passengers.id')
        ->join('payments', 'tdr_history.bookingId', '=', 'payments.bookingId')
        ->select('agents.cscId', 'agents.agentUserId', 'payments.csc_txn', 'bookings.dateOfBooking', 'bookings.boardingDate', 'bookings.pnrNumber', 'tdr_history.created_at', 'tdr_list.tdr_reason','tdr_history.tdr_response');

        if (!empty($this->other)) {
            $query->where('agents.cscId', 'like', '%' . $this->other . '%')
            ->orWhere('agents.agentUserId', 'like', '%' . $this->other . '%')
            ->orWhere('payments.csc_txn', 'like', '%' . $this->other . '%')
            ->orWhere('bookings.pnrNumber', 'like', '%' . $this->other . '%');
        }
        if (!empty($this->start) && !empty($this->end)) {
            $query->whereBetween('tdr_history.created_at', array($this->start, $this->end));
        }   
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->dateOfBooking=date("d/m/Y", strtotime($result[$key]->dateOfBooking));
            $result[$key]->boardingDate=date("d/m/Y", strtotime($result[$key]->boardingDate));
        }
        // dd($result);
        return $result;
    }
    
}
