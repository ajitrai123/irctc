<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use Illuminate\Http\Request;
use App\Models\partialrefund;
use App\Exports\PartialRefundExport;
use Maatwebsite\Excel\Facades\Excel;

class Partialrefundscontrollers extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->other) || !empty($request->from_date) || !empty($request->to_date))
            {

                $from_date = $request->input('from_date');
                //   $to_date = Carbon::parse($request->input('to_date'))->addDay();
                $to_date   = $request->input('to_date');
                $other    = $request->input('other');
            

                $query = DB::table('partial_refund')
                ->join('bookings', 'partial_refund.bookingId', '=', 'bookings.id') 
                ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
                ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
                ->select('partial_refund.*', 'bookings.agentUid','agents.cscId', 'agents.agentUserId','payments.csc_txn','bookings.trainNumber');

                if (!empty($other)) {
                    $query->where('agents.cscId', 'like','%'. $other .'%')
                    ->orWhere('bookings.agentUid', 'like','%'. $other .'%')
                    ->orWhere('agents.agentUserId', 'like','%'. $other .'%')
                    ->orWhere('payments.csc_txn', 'like','%'. $other .'%')
                    ->orWhere('partial_refund.cancellationId', 'like','%'. $other .'%');
                }    
            
                if (!empty($from_date) && !empty($to_date)) {
                    $query->whereBetween('partial_refund.created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
                }
                $received_data = $query->get();

                return Datatables::of($received_data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route("partial.refund.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }else
            {
             
                $query = DB::table('partial_refund')
                ->join('bookings', 'partial_refund.bookingId', '=', 'bookings.id') 
                ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
                ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
                ->join('passengers', 'partial_refund.bookingId', '=', 'passengers.bookingId') 
                ->select('partial_refund.*', 'bookings.agentUid','agents.cscId', 'agents.agentUserId','payments.csc_txn','bookings.trainNumber');  //,'passengers.refundAmount' 
            
                $received_data = $query->get();
                // return $received_data;
                return Datatables::of($received_data)->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a href="'.route("partial.refund.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
                        <i class="bx bx-low-vision"></i>
                            </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                }
            return datatables()->of($received_data)->make(true);
        }
        return view('Partial-Refund');
    }
    public function partial_Refund_export(Request $request)
    {
        return Excel::download(new PartialRefundExport($request->from_date, $request->to_date,$request->other), 'partial-refund-Export.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function full_refund_export(Request $request)
    {
        return Excel::download(new FullRefundExport($request->from_date, $request->to_date,$request->other), 'full-refund.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function partial_refund_view(Request $request){
        $partial_refund = DB::table('partial_refund')
        ->where('id',$request->id)
        ->first();
        $booking = DB::table('bookings')
        ->where('id',$partial_refund->bookingId)
        ->first();
        $payments = DB::table('payments')
        ->where('bookingId',$partial_refund->bookingId)
        ->first();
        $passengers = DB::table('passengers')
        ->where('bookingId',$partial_refund->bookingId)
        ->get();
        $agent = DB::table('agents')
        ->where('id',$booking->agentUid)
        ->first();
        return view('partial-refund-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers,'partial_refund'=>$partial_refund]);
    }
}
