<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FullRefundExport implements FromCollection,WithHeadings
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
            'ID', 'AGENT ID','CSC TRANSACTION', 'BOOKINGID', 'RESPONSECODE', 'RESPONSESTATUS', 'RESPONSEDATA', 'RESPONSEMESSAGE', 'RESPONSESERVER', 'RESPONSEDATE', 'IRCTC_ERRORMSG', 'OTHERDATA', 'CREATED_AT', 'STATUS'
          ];
    }
    public function collection()
    {
        $query = DB::table('full_refund')
            ->join('bookings', 'full_refund.bookingId', '=', 'bookings.id') 
            ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
            ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
            ->select('full_refund.id', 'agents.agentUserId','payments.csc_txn', 'full_refund.bookingId', 'full_refund.responseCode', 'full_refund.responseStatus', 'full_refund.responseData', 'full_refund.responseMessage', 'full_refund.responseServer', 'full_refund.responseDate', 'full_refund.irctc_errorMsg', 'full_refund.otherData', 'full_refund.created_at', 'full_refund.status');

        if (!empty($this->other)) {
            $query->where('agents.cscId', 'like','%'. $this->other .'%')
            ->orWhere('bookings.agentUid', 'like','%'. $this->other .'%')
            ->orWhere('agents.agentUserId', 'like','%'. $this->other .'%')
            ->orWhere('payments.csc_txn', 'like','%'. $this->other .'%');
        }    
        
        if (!empty($this->start) && !empty($this->end )) {
            $query->whereBetween('full_refund.created_at', array($this->start, $this->end ));
        }
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
            $result[$key]->responseDate=date("d/m/Y", strtotime($result[$key]->responseDate));
        //     $result[$key]->boardingDate=date("d/m/Y", strtotime($result[$key]->boardingDate));
        }
        // dd($result);
        return $result;
    }
}
