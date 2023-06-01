<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Booking;
// use DB;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingExport;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    function index(Request $request)
    {

        if (request()->ajax()) {
            if (!empty($request->other) || !empty($request->from_date) || !empty($request->to_date)) {

                $from_date = $request->input('from_date');
                // $to_date = Carbon::parse($request->input('to_date'))->addDay();
                $to_date   = $request->input('to_date');
                $other    = $request->input('other');

                $query = DB::table('bookings')
                    ->join('agents', 'bookings.agentUid', '=', 'agents.id')
                    ->join('payments', 'bookings.id', '=', 'payments.bookingId')
                    ->select('bookings.*', 'agents.cscId', 'agents.agentUserId', 'payments.csc_txn')
                    ->where('bookings.status', 6); //use 6 for get all data where status is 5 in enum column
                if (!empty($other)) {
                    $query->where('agents.cscId', 'like', '%' . $other . '%')
                        ->orWhere('agents.agentUserId', 'like', '%' . $other . '%')
                        ->orWhere('bookings.booking_sess_id', 'like', '%' . $other . '%')
                        ->orWhere('payments.csc_txn', 'like', '%' . $other . '%')
                        ->orWhere('bookings.pnrNumber', 'like', '%' . $other . '%');
                }
                if (!empty($from_date) && !empty($to_date)) {
                    $query->whereBetween('bookings.created_at', array($from_date, date('Y-m-d', strtotime($to_date. ' + 1 days'))));
                }

                $received_data = $query->get();

                return Datatables::of($received_data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="'.route("booking.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                $received_data = DB::table('bookings')
                    ->join('agents', 'bookings.agentUid', '=', 'agents.id')
                    ->join('payments', 'bookings.id', '=', 'payments.bookingId')
                    ->select('bookings.*', 'agents.cscId', 'agents.agentUserId', 'payments.csc_txn')
                    ->where('bookings.status', 6) //use 6 for get all data where status is 5 in enum column
                    ->get();
                return Datatables::of($received_data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="'.route("booking.view", ["id" => $row->id]).'" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i> </a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return datatables()->of($received_data)->make(true);
        }
        return view('booking');
    }
    public function booking_export(Request $request)
    {
        return Excel::download(new BookingExport($request->from_date, $request->to_date,$request->other), 'booking.csv', null, [\Maatwebsite\Excel\Excel::CSV]);

    }
    public function booking_view(Request $request){

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
        return view('booking-view', ['payments' => $payments, 'agent'=>$agent, 'booking'=>$booking, 'passengers'=>$passengers]);
    }
}
