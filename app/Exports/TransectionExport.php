<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransectionExport implements FromCollection,WithHeadings
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
            'ID', 'CSC ID', 'AGENT ID', 'BOOKING ID', 'CSC TXN', 'REQTXN', 'TXN_STATUS', 'TOTALFARE', 'WPSERVICECHARGE', 'WPSERVICETAX', 'INSURANCECHARGE', 'TRAVELAGENTCHARGE', 'CSCCOMMISSION', 'WALLETAMOUNT', 'TOTALCOLLECTIBLEAMOUNT', 'TRAVELINSURANCESERVICETAX', 'PRODUCTID', 'TXN_AMOUNT', 'CSCREQUESTID', 'CREATED_AT', 'IPADDRESS', 'STATUS', 'REFUNDSTART', 'OTHERDATA', 'USERAGENT', 'APPVERSION'
          ];
    }
    public function collection()
    {
        $query = DB::table('payments')
        ->join('agents', 'payments.agentUid', '=', 'agents.id')
        ->select('payments.id', 'agents.cscId','agents.agentUserId', 'payments.bookingId', 'payments.csc_txn', 'payments.reqTxn', 'payments.txn_status', 'payments.totalFare', 'payments.wpServiceCharge', 'payments.wpServiceTax', 'payments.insuranceCharge', 'payments.travelAgentCharge', 'payments.cscCommission', 'payments.walletAmount', 'payments.totalCollectibleAmount', 'payments.travelInsuranceServiceTax', 'payments.productId', 'payments.txn_amount', 'payments.cscRequestId', 'payments.created_at', 'payments.ipAddress', 'payments.status', 'payments.refundStart', 'payments.otherData', 'payments.userAgent', 'payments.appVersion' );

        if (!empty($this->other)) {
            $query->where('agents.agentUserId','like','%'. $this->other .'%')
            ->orWhere('agents.cscId','like','%'. $this->other .'%')
            ->orWhere('payments.csc_txn', 'like','%'. $this->other .'%')
            ->orWhere('payments.reqTxn','like','%'. $this->other .'%');
        }    
        
        if (!empty($this->start) && !empty($this->end)) {
            $query->whereBetween('created_at', array($this->start, $this->end));
        }
        $result = $query->get();
        foreach ($result as $key => $value) {
            $result[$key]->created_at=date("d/m/Y", strtotime($result[$key]->created_at));
        //     $result[$key]->dateOfBooking=date("d/m/Y", strtotime($result[$key]->dateOfBooking));
        //     $result[$key]->boardingDate=date("d/m/Y", strtotime($result[$key]->boardingDate));
        }
        // dd($result);
        return $result;
    }
}
