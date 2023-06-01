<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use App\Models\fullrefund;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\FullRefundExport;
use Maatwebsite\Excel\Facades\Excel;

class FullrefundsControllers extends Controller
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

    $query = DB::table('full_refund')
        ->join('bookings', 'full_refund.bookingId', '=', 'bookings.id') 
        ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
        ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
        ->select('full_refund.*', 'bookings.agentUid','agents.cscId', 'agents.agentUserId','payments.csc_txn');

    if (!empty($other)) {
        $query->where('agents.cscId', 'like','%'. $other .'%')
        ->orWhere('bookings.agentUid', 'like','%'. $other .'%')
        ->orWhere('agents.agentUserId', 'like','%'. $other .'%')
        ->orWhere('payments.csc_txn', 'like','%'. $other .'%');
    }    
       
    if (!empty($from_date) && !empty($to_date)) {
        $query->whereBetween('full_refund.created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
    }
    $received_data = $query->get();

    return Datatables::of($received_data)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            $btn = '<a href="'.route("full.refund.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
  }
      else
      {
       $received_data = DB::table('full_refund')
        ->join('bookings', 'full_refund.bookingId', '=', 'bookings.id') 
        ->join('agents', 'bookings.agentUid', '=', 'agents.id')   
        ->join('payments', 'bookings.id', '=', 'payments.bookingId') 
        ->select('full_refund.*', 'bookings.agentUid','agents.cscId', 'agents.agentUserId','payments.csc_txn')
        ->get();
         return Datatables::of($received_data)->addIndexColumn()
         ->addColumn('action', function($row){
             // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
             $btn = '<a href="'.route("full.refund.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
             <i class="bx bx-low-vision"></i>
                </a>';
             return $btn;
         })
         ->rawColumns(['action'])
         ->make(true);
      }
      return datatables()->of($received_data)->make(true);
     }
     return view('full-refund');
    }

    public function full_refund_export(Request $request)
    {
        return Excel::download(new FullRefundExport($request->from_date, $request->to_date,$request->other), 'full-refund.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function full_refund_view(Request $request){

        
        $full_refund = DB::table('full_refund')
        ->where('id',$request->id)
        ->first();
        $booking = DB::table('bookings')
        ->where('id',$full_refund->bookingId)
        ->first();
        $payments = DB::table('payments')
        ->where('bookingId',$full_refund->bookingId)
        ->first();
        $passengers = DB::table('passengers')
        ->where('bookingId',$full_refund->bookingId)
        ->get();
        $agent = DB::table('agents')
        ->where('id',$booking->agentUid)
        ->first();
        
        // dd($booking);
        return view('full-refund-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers,'full_refund'=>$full_refund]);
    }
}
