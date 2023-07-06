<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Agents;
// use Carbon\Carbon;
use App\Models\Cancellation;
use Illuminate\Http\Request;
use App\Exports\CancellationExport;
use Maatwebsite\Excel\Facades\Excel;


class CancellationController extends Controller
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

    $query = DB::table('passengers')
    ->join('bookings', 'bookings.id', '=', 'passengers.bookingId')
    ->join('agents', 'agents.id', '=', 'bookings.agentUid')
    ->join('payments', function ($join) {
        $join->on('payments.bookingId', '=', 'bookings.id')
             ->on('payments.agentUid', '=', 'agents.id');
    })
    ->whereNotNull('passengers.cancellationId')
    ->select('passengers.*', 'bookings.pnrNumber','bookings.id as bookingId', 'bookings.dateOfBooking', 'agents.cscId', 'agents.agentUserId', 'payments.csc_txn');

    if (!empty($other)) {
        $query->where('bookings.id', 'like','%'. $other .'%')
        ->orWhere('agents.cscId','like','%'. $other .'%')
        ->orWhere('agents.agentUserId','like','%'. $other .'%')
        ->orWhere('payments.csc_txn','like','%'. $other .'%')
        ->orWhere('bookings.pnrNumber','like','%'. $other .'%')
        ->orWhere('passengers.cancellationId', 'like','%'. $other .'%');
    }  
    if (!empty($state)) {
        $query->where('agents.stateId', $state);
    }
    if (!empty($city)) {
        $query->where('agents.cityId', $city);
    }  
    if (!empty($from_date) && !empty($to_date)) {
        $query->whereBetween('bookings.created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
    }
    $received_data = $query->get();

    return Datatables::of($received_data)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            $btn = '<a href="'.route("cancellation.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
  }
      else
      {
       $received_data = DB::table('passengers')
       ->join('bookings', 'bookings.id', '=', 'passengers.bookingId')
       ->join('agents', 'agents.id', '=', 'bookings.agentUid')
       ->join('payments', function ($join) {
           $join->on('payments.bookingId', '=', 'bookings.id')
                ->on('payments.agentUid', '=', 'agents.id');
       })
       ->select('passengers.*', 'bookings.pnrNumber', 'bookings.dateOfBooking', 'agents.cscId', 'agents.agentUserId', 'payments.csc_txn')
       ->whereNotNull('passengers.cancellationId')
    //    ->where('bookings.id', null) 
       ->get();
         return Datatables::of($received_data)->addIndexColumn()
         ->addColumn('action', function($row){
             // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
             $btn = '<a href="'.route("cancellation.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
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
     return view('cancellation',compact('all_state'));
    }
    public function cancellation_export(Request $request)
    {
        return Excel::download(new CancellationExport($request->from_date, $request->to_date,$request->other), 'cancellation.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function cancellation_view(Request $request){

        $passenger = DB::table('passengers')
        ->where('id',$request->id)
        ->first();
        $booking = DB::table('bookings')
        ->where('id',$passenger->bookingId)
        ->first();
        $payments = DB::table('payments')
        ->where('bookingId',$passenger->bookingId)
        ->first();
        $agent = DB::table('agents')
        ->where('id',$booking->agentUid)
        ->first();
        
        // dd($booking);
        return view('cancellation-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passenger'=>$passenger]);
    }
}
