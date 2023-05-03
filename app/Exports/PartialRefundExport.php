<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PartialRefundExport implements FromCollection,WithHeadings
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
            'ID', 'AGENT ID','CSC TRANSACTION', 'BOOKINGID', 'CANCELLATIONID', 'PASSENGERUID', 'PASSENGERSERIALNO', 'RESPONSECODE', 'RESPONSESTATUS', 'RESPONSEDATA', 'RESPONSEMESSAGE', 'RESPONSESERVER', 'RESPONSEDATE', 'OTHERDATA', 'CREATED_AT', 'STATUS'
          ];
    }
    public function collection()
    {
        $query = DB::table('partial_refund')
                ->join('bookings', 'partial_refund.bookingId', '=', 'bookings.id') 
                ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
                ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
                ->select('partial_refund.id', 'agents.agentUserId', 'payments.csc_txn','partial_refund.bookingId', 'partial_refund.cancellationId', 'partial_refund.passengerUid', 'partial_refund.passengerSerialNo', 'partial_refund.responseCode', 'partial_refund.responseStatus', 'partial_refund.responseData', 'partial_refund.responseMessage', 'partial_refund.responseServer', 'partial_refund.responseDate', 'partial_refund.otherData', 'partial_refund.created_at', 'partial_refund.status');

                if (!empty($this->other)) {
                    $query->where('agents.cscId', 'like','%'. $this->other .'%')
                    ->orWhere('bookings.agentUid', 'like','%'. $this->other .'%')
                    ->orWhere('agents.agentUserId', 'like','%'. $this->other .'%')
                    ->orWhere('payments.csc_txn', 'like','%'. $this->other .'%')
                    ->orWhere('partial_refund.cancellationId', 'like','%'. $this->other .'%');
                }    
            
                if (!empty($this->start) && !empty($this->end)) {
                    $query->whereBetween('partial_refund.created_at', array($this->start, $this->end));
                }
        
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->responseDate=date("d/m/Y", strtotime($result[$key]->responseDate));
            // $result[$key]->boardingDate=date("d/m/Y", strtotime($result[$key]->boardingDate));
        }
        // dd($result);
        return $result;
    }
}
