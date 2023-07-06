<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\Agents;
use App\Models\Transaction;
use Illuminate\Http\Request;
// use Carbon\Carbon;

use App\Exports\TransectionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
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

    $query = DB::table('payments')
    ->join('agents', 'payments.agentUid', '=', 'agents.id')
    ->select('payments.*', 'agents.cscId', 'agents.agentUserId' );

    if (!empty($other)) {
        $query->where('agents.agentUserId','like','%'. $other .'%')
        ->orWhere('agents.cscId','like','%'. $other .'%')
        ->orWhere('payments.reqTxn','like','%'. $other .'%');
    }    
    if (!empty($state)) {
        $query->where('agents.stateId', $state);
    }
    if (!empty($city)) {
        $query->where('agents.cityId', $city);
    }
    if (!empty($from_date) && !empty($to_date)) {
        $query->whereBetween('created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
    }
    $received_data = $query->get();
        return Datatables::of($received_data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route("transection.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
                <i class="bx bx-low-vision"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        else
        {
        $received_data = DB::table('payments')
        ->join('agents', 'payments.agentUid', '=', 'agents.id')
        ->select('payments.*', 'agents.cscId', 'agents.agentUserId' )
        // ->where('payments.id', null) 
            ->get();
            return Datatables::of($received_data)->addIndexColumn()
            ->addColumn('action', function($row){
                // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                $btn = '<a href="'.route("transection.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
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
     return view('transaction',compact('all_state'));
    }
    public function transection_export(Request $request)
    {
        // Excel::download(new TransectionExport($request->from_date, $request->to_date), 'students.xlsx');
        // return response()->json([200]);
        // $result=Transaction::with('articles')->get();
        
        // dd($result);
        return Excel::download(new TransectionExport($request->from_date, $request->to_date,$request->other), 'transection.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function transection_view(Request $request){

        $payments = DB::table('payments')
        ->where('id',$request->id)
        ->first();
        $agent = DB::table('agents')
        ->where('id',$payments->agentUid)
        ->first();
        $booking = DB::table('bookings')
        ->where('id',$payments->bookingId)
        ->first();
        $passengers = DB::table('passengers')
        ->where('bookingId',$payments->bookingId)
        ->get();
        // dd($booking);
        return view('transection-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers]);
    }

}
