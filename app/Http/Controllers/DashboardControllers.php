<?php

namespace App\Http\Controllers;
use App\Models\Agents;
use DataTables;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Cancellation;
use App\Models\Payments;

use Illuminate\Http\Request;

class DashboardControllers extends Controller
{
    
    public function index()
    {
      $total_onboard_agent_current = Agents::where('created',Carbon::today())->count();
      $total_onboard_agent = Agents::count();
      $total_active_agent_cuurent = Booking::where('dateOfBooking',Carbon::today())->groupBy('agentUid')->count();
      $total_active_agent = Agents::count();
      $total_inactive_agent_current = $total_onboard_agent_current-$total_active_agent_cuurent;
      $total_inactive_agent = $total_onboard_agent-$total_active_agent;
      $total_booking_today = Booking::where('dateOfBooking',Carbon::today())->count();
      $total_cancelled_ticket_today = Cancellation::where('created_at',Carbon::today())->count();
      $total_faild_transection_today = Payments::where('created_at',Carbon::today())->count();
      $booking = Booking::select('id', 'created_at')
      ->whereYear('created_at', date('Y'))
      ->get()
      ->groupBy(function ($date) {
          return Carbon::parse($date->created_at)->format('m');
      });

      $booking_monthly_count = [];
      $booking_array = [];

      foreach ($booking as $key => $value) {
          $booking_monthly_count[(int)$key] = count($value);
      }

      $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

      for ($i = 1; $i <= 12; $i++) {
          if (!empty($booking_monthly_count[$i])) {
            array_push($booking_array, $booking_monthly_count[$i]);
          } else {
            array_push($booking_array, 0);
          }
          // $booking_array[$i]['month'] = $month[$i - 1]; // name of month 
      }
      $booking_array=json_encode($booking_array);

      // all cancellation data count for graph
      $cancellation = Cancellation::select('id', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $canellation_monthly_count = [];
        $cancellation_array = [];

        foreach ($cancellation as $key => $value) {
            $canellation_monthly_count[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
          if (!empty($cancellation_array[$i])) {
            array_push($cancellation_array, $cancellation_array[$i]);
          } else {
            array_push($cancellation_array, 0);
          }
          $cancellation_array[0]=5;
          $cancellation_array[1]=10;
        }
        $cancellation_array=json_encode($cancellation_array);

    return view('index', compact('total_onboard_agent','total_active_agent','total_inactive_agent','total_onboard_agent_current','total_active_agent_cuurent','total_inactive_agent_current','total_booking_today','total_cancelled_ticket_today','total_faild_transection_today','booking_array','cancellation_array'));
     }
     public function booking_graph_data(Request $request){
        $month= $request->month;
        $year=$request->year;
        if (!empty($month) && !empty($year)) {
          $booking = Booking::select('id', 'created_at')
          ->whereYear('created_at', $year)
          ->whereMonth('created_at', $month)
          ->get()
          ->groupBy(function ($date) {
              return Carbon::parse($date->created_at)->format('d');
          });
          $booking_daily_count = [];
          $booking_array = [];

          foreach ($booking as $key => $value) {
              $booking_daily_count[(int)$key] = count($value);
          }
          for ($i = 1; $i <= 31; $i++) {
              if (!empty($booking_daily_count[$i])) {
                array_push($booking_array, $booking_daily_count[$i]);
              } else {
                array_push($booking_array, 0);
              }
          }
          return response()->json(['data'=>$booking_array,'data_type'=>'month']);
        }else if (empty($month) && !empty($year)) {
          $booking = Booking::select('id', 'created_at')
          ->whereYear('created_at', $year)
          ->get()
          ->groupBy(function ($date) {
              return Carbon::parse($date->created_at)->format('m');
          });
          $booking_daily_count = [];
          $booking_array = [];

          foreach ($booking as $key => $value) {
              $booking_daily_count[(int)$key] = count($value);
          }
          for ($i = 1; $i <= 12; $i++) {
              if (!empty($booking_daily_count[$i])) {
                array_push($booking_array, $booking_daily_count[$i]);
              } else {
                array_push($booking_array, 0);
              }
          }
          return response()->json(['data'=>$booking_array,'data_type'=>'year']);
        }else if (!empty($month) && empty($year)) {
          $booking = Booking::select('id', 'created_at')
          ->whereYear('created_at', date('Y'))
          ->whereMonth('created_at', $month)
          ->get()
          ->groupBy(function ($date) {
              return Carbon::parse($date->created_at)->format('d');
          });
          $booking_daily_count = [];
          $booking_array = [];

          foreach ($booking as $key => $value) {
              $booking_daily_count[(int)$key] = count($value);
          }
          for ($i = 1; $i <= 31; $i++) {
              if (!empty($booking_daily_count[$i])) {
                array_push($booking_array, $booking_daily_count[$i]);
              } else {
                array_push($booking_array, 0);
              }
          }
          return response()->json(['data'=>$booking_array,'data_type'=>'month']);
        }else{
          return "Please select year or month first";
        }
     }
     public function cancellation_graph_data(Request $request){
      $month= $request->month;
      $year=$request->year;
      if (!empty($month) && !empty($year)) {
        $booking = Cancellation::select('id', 'created_at')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        $booking_daily_count = [];
        $booking_array = [];

        foreach ($booking as $key => $value) {
            $booking_daily_count[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 31; $i++) {
            if (!empty($booking_daily_count[$i])) {
              array_push($booking_array, $booking_daily_count[$i]);
            } else {
              array_push($booking_array, 0);
            }
        }
        return response()->json(['data'=>$booking_array,'data_type'=>'month']);
      }else if (empty($month) && !empty($year)) {
        $booking = Cancellation::select('id', 'created_at')
        ->whereYear('created_at', $year)
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        $booking_daily_count = [];
        $booking_array = [];

        foreach ($booking as $key => $value) {
            $booking_daily_count[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($booking_daily_count[$i])) {
              array_push($booking_array, $booking_daily_count[$i]);
            } else {
              array_push($booking_array, 0);
            }
        }
        return response()->json(['data'=>$booking_array,'data_type'=>'year']);
      }else if (!empty($month) && empty($year)) {
        $booking = Cancellation::select('id', 'created_at')
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', $month)
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        $booking_daily_count = [];
        $booking_array = [];

        foreach ($booking as $key => $value) {
            $booking_daily_count[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 31; $i++) {
            if (!empty($booking_daily_count[$i])) {
              array_push($booking_array, $booking_daily_count[$i]);
            } else {
              array_push($booking_array, 0);
            }
        }
        return response()->json(['data'=>$booking_array,'data_type'=>'month']);
      }else{
        return "Please select year or month first";
      }
   }
}
