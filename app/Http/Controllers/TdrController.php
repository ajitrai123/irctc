<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\Tdr;
use App\Models\Agents;
// use DB;
// use Carbon\Carbon;
use App\Models\Booking;
use App\Exports\TdrExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TdrController extends Controller
{
    function index(Request $request)
    {
   
        if (request()->ajax()) {
            if (!empty($request->other) || !empty($request->from_date) || !empty($request->to_date) || !empty($request->state) || !empty($request->city)) {

                $from_date = $request->input('from_date');
                $to_date   = $request->input('to_date');
                $other    = $request->input('other');
                $state   = $request->input('state');
                $city    = $request->input('city');

                $query = DB::table('tdr_history')
                ->join('bookings', 'tdr_history.bookingId', '=', 'bookings.id')
                ->join('agents', 'tdr_history.agentUid', '=', 'agents.id')
                ->join('tdr_list', 'tdr_history.tdr_reason', '=', 'tdr_list.id')
                ->join('passengers', 'tdr_history.passengers_id', '=', 'passengers.id')
                ->join('payments', 'tdr_history.bookingId', '=', 'payments.bookingId')
                ->select('tdr_history.*', 'agents.cscId', 'agents.agentUserId','bookings.pnrNumber','bookings.dateOfBooking','bookings.boardingDate','bookings.id as bookingId','payments.csc_txn','tdr_list.tdr_reason as reason_of_tdr');

                if (!empty($other)) {
                    $query->where('agents.cscId', 'like', '%' . $other . '%')
                        ->orWhere('agents.agentUserId', 'like', '%' . $other . '%')
                        ->orWhere('payments.csc_txn', 'like', '%' . $other . '%')
                        ->orWhere('bookings.pnrNumber', 'like', '%' . $other . '%');
                }
                if (!empty($state)) {
                    $query->where('agents.stateId', $state);
                }
                if (!empty($city)) {
                    $query->where('agents.cityId', $city);
                }
                if (!empty($from_date) && !empty($to_date)) {
                    $query->whereBetween('tdr_history.created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
                }

                $received_data = $query->get();

                return Datatables::of($received_data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a <a href="'.route("tdr.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                $received_data = DB::table('tdr_history')
                    ->join('bookings', 'tdr_history.bookingId', '=', 'bookings.id')
                    ->join('agents', 'tdr_history.agentUid', '=', 'agents.id')
                    ->join('tdr_list', 'tdr_history.tdr_reason', '=', 'tdr_list.id')
                    ->join('passengers', 'tdr_history.passengers_id', '=', 'passengers.id')
                    ->join('payments', 'tdr_history.bookingId', '=', 'payments.bookingId')
                    ->select('tdr_history.*', 'agents.cscId', 'agents.agentUserId','bookings.pnrNumber','bookings.dateOfBooking','bookings.boardingDate','payments.csc_txn','tdr_list.tdr_reason as reason_of_tdr')
                    // ->where('bookings.id', null) 
                    ->get();
                return Datatables::of($received_data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                        $btn = '<a href="'.route("tdr.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1">
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
        return view('tdr',compact('all_state'));
    }
    public function tdr_export(Request $request)
    {
        return Excel::download(new TdrExport($request->from_date, $request->to_date,$request->other), 'waiting-cancellation.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function tdr_view(Request $request){
        $tdr = DB::table('tdr_history')
        ->where('id',$request->id)
        ->first();
        $tdr_list = DB::table('tdr_list')
        ->where('id',$tdr->tdr_reason)
        ->first();
        $booking = DB::table('bookings')
        ->where('id',$tdr->bookingId)
        ->first();
        $payments = DB::table('payments')
        ->where('bookingId',$tdr->bookingId)
        ->first();
        $passengers = DB::table('passengers')
        ->where('bookingId',$tdr->bookingId)
        ->get();
        $agent = DB::table('agents')
        ->where('id',$tdr->agentUid)
        ->first();
        return view('tdr-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers,'tdr'=>$tdr,'tdr_list'=>$tdr_list]);
    }
}
