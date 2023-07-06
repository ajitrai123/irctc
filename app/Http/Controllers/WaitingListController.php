<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Agents;
// use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WaitingCancellationExport;

class WaitingListController extends Controller
{
    function index(Request $request)
    {
   
     if(request()->ajax())
     {
      if(!empty($request->other) || !empty($request->from_date) || !empty($request->to_date) || !empty($request->state) || !empty($request->city))
      {
        $from_date = $request->input('from_date');
        //   $to_date = Carbon::parse($request->input('to_date'))->addDay();
        $to_date   = $request->input('to_date');
        $other    = $request->input('other');
        $state   = $request->input('state');
        $city    = $request->input('city');

        $query = DB::table('bookings')
        ->join('passengers', 'bookings.id', '=', 'passengers.bookingId')
        ->join('payments', 'bookings.id', '=', 'payments.bookingId')
        ->join('agents', 'bookings.agentUid', '=', 'agents.id')
         ->select('bookings.*', 'passengers.refundAmount', 'passengers.cancellationDate', 'passengers.currentStatus', 'passengers.cancellationDate', 'agents.cscId', 'agents.agentUserId' ,'payments.reqTxn');

    if (!empty($other)) {
        $query->where('agents.agentUserId', 'like','%'. $other .'%')
        ->orWhere('agents.cscId', 'like','%'. $other .'%')
        ->orWhere('bookings.pnrNumber', 'like','%'. $other .'%')
        ->orWhere('payments.reqTxn','like','%'. $other .'%');
    } 
    if (!empty($state)) {
        $query->where('agents.stateId', $state);
    }
    if (!empty($city)) {
        $query->where('agents.cityId', $city);
    }
    if (!empty($from_date) && !empty($to_date)) {
        $query->whereBetween('passengers.cancellationDate', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
    }   
       
    $received_data = $query->get();

    return Datatables::of($received_data)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            $btn = '<a href="'.route("waiting.cancellation.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
  }
      else
      {
       $received_data = DB::table('bookings') 
       ->join('passengers', 'bookings.id', '=', 'passengers.bookingId')
       ->join('payments', 'bookings.id', '=', 'payments.bookingId')
       ->join('agents', 'bookings.agentUid', '=', 'agents.id')
            ->select('bookings.*', 'passengers.refundAmount', 'passengers.cancellationDate', 'passengers.currentStatus', 'passengers.cancellationDate', 'agents.cscId', 'agents.agentUserId','payments.reqTxn' );
            // ->where('bookings.id', null) ;
         return Datatables::of($received_data)->addIndexColumn()
         ->addColumn('action', function($row){
             // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
             $btn = '<a href="'.route("waiting.cancellation.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
             <i class="bx bx-low-vision"></i>
                </a>';
             return $btn;
         })
         ->rawColumns(['action'])
         ->make(true);
      }
      return datatables()->of($received_data)->make(true);
     }
     $all_state = Agents::groupBy('stateId')->pluck('stateId');
     return view('waiting-cancellation',compact('all_state'));
    }
    public function waiting_cancellation_export(Request $request)
    {
        return Excel::download(new WaitingCancellationExport($request->from_date, $request->to_date,$request->other), 'waiting-cancellation.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function waiting_cancellation_view(Request $request){

        $booking = DB::table('bookings')
        ->where('id',$request->id)
        ->first();
        $payments = DB::table('payments')
        ->where('bookingId',$booking->id)
        ->first();
        $agent = DB::table('agents')
        ->where('id',$booking->agentUid)
        ->first();
        $passengers = DB::table('passengers')
        ->where('bookingId',$booking->id)
        ->get();
        // dd($booking);
        return view('waiting-cancellation-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers]);
    }
}
