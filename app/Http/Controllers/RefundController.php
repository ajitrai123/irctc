<?php

namespace App\Http\Controllers;
use App\Models\Refund;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;



class RefundController extends Controller
{
//     function index(Request $request)
//     {
   
//      if(request()->ajax())
//      {
//       if(!empty($request->other) || !empty($request->from_date) || !empty($request->to_date))
//       {
//       $from_date = $request->input('from_date');
//       $to_date = Carbon::parse($request->input('to_date'))->addDay();
//       //   $to_date   = $request->input('to_date');
//       $other    = $request->input('other');

//     $query = DB::table('partial_refund')
//     ->join('passengers', 'bookings.id', '=', 'passengers.bookingId')
//     ->select('bookings.*', 'passengers.refundAmount', 'passengers.cancellationDate', 'passengers.currentStatus', 'passengers.cancellationDate');
//     if (!empty($from_date) && !empty($to_date)) {
//         $query->whereBetween('created_at', array($from_date, $to_date));
//     }

//     if (!empty($other)) {
//         $query->where('agentUid', $other)
//         ->orWhere('cscRequestId', $other)
//         ->orWhere('pnrNumber', $other);
//     }    
       
//     $received_data = $query->get();

//     return Datatables::of($received_data)
//         ->addIndexColumn()
//         ->addColumn('action', function($row) {
//             $btn = '<a href=" '. url('view') .  '" type="button" class="btn btn-light btn-sm mb-1"><i class="bx bx-low-vision"></i></a>';
//             return $btn;
//         })
//         ->rawColumns(['action'])
//         ->make(true);
//   }
//       else
//       {
//        $received_data = DB::table('partial_refund') 
//        ->join('passengers', 'bookings.id', '=', 'passengers.bookingId')
//             ->select('bookings.*', 'passengers.refundAmount', 'passengers.cancellationDate', 'passengers.currentStatus', 'passengers.cancellationDate');
//          return Datatables::of($received_data)->addIndexColumn()
//          ->addColumn('action', function($row){
//              // '<a href="' . route('latestnews_show', $data->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a> 
//              $btn = '<a href=" '. url('view') .  '" type="button" class="btn btn-light btn-sm mb-1">
//              <i class="bx bx-low-vision"></i>
//                 </a>';
//              return $btn;
//          })
//          ->rawColumns(['action'])
//          ->make(true);
//       }
//       return datatables()->of($received_data)->make(true);
//      }
//      return view('refund');
//     }
}
