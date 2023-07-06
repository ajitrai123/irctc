<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\Agents;
use App\Models\Booking;
use App\Models\Payments;
use App\Models\Cancellation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\AgentsDataTable;
use Illuminate\Support\Facades\Auth;

class DashboardControllers extends Controller
{

  public function index()
  {
    if(Auth::check()){
      $last_date=date('Y-m-d', strtotime('-1 day',strtotime(Carbon::today())));
      // Total Agent Count
      $total_onboard_agent = Agents::count();
      // Total Active Agents Count
      $today_bookings_agent_id = Booking::groupBy('agentUid')->pluck('agentUid');
      $total_active_agent = Agents::whereIn('id', $today_bookings_agent_id)->count();
      // New registered Agents
      $total_onboard_agent_current = Agents::whereDate('created', Carbon::today())->count();
      // Booking tickets last day
      $total_booking_today = Booking::whereDate('created_at', '>=',  $last_date)->count();
      // Cancel tickets last day
      $total_cancelled_ticket_today = Booking::whereDate('created_at', '>=', $last_date)->where('status',7)->count();
      // Refund last day
      $total_refund_today = Booking::with(['fullrefund','partialrefund'])->whereDate('created_at', '>=', $last_date)->where('status',8)->count();

      // $total_cancelled_ticket_today_ids = Booking::with(['fullrefund','partialrefund'])->whereDate('created_at', '>=', $last_date)->where('status','7')->count();
      // echo $total_cancelled_ticket_today_ids;
      // die();


      $total_active_agent_cuurent = Booking::where('dateOfBooking',Carbon::today())->groupBy('agentUid')->count();
      
      $all_state = Agents::groupBy('stateId')->pluck('stateId');
      
      
      // $total_inactive_agent_current = $total_onboard_agent_current-$total_active_agent_cuurent;
      // $total_inactive_agent = $total_onboard_agent-$total_active_agent;
      
      
      $total_faild_transection_today = Booking::whereDate('created_at', $last_date)->where('status',3)->count();
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
      $booking_array = json_encode($booking_array);
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
        $cancellation_array[0] = 5;
        $cancellation_array[1] = 10;
      }
      $cancellation_array = json_encode($cancellation_array);
      
      return view('index-new', compact('total_onboard_agent', 'total_active_agent', 'total_onboard_agent_current', 'total_booking_today', 'total_cancelled_ticket_today', 'total_faild_transection_today', 'booking_array', 'cancellation_array', 'all_state','last_date','total_active_agent_cuurent','total_refund_today'));
    }
    return redirect("login")->withError('You are not allowed to access');
    
  }
  public function booking_graph_data(Request $request)
  {
    $month = $request->month;
    $year = $request->year;
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
      return response()->json(['data' => $booking_array, 'data_type' => 'month']);
    } else if (empty($month) && !empty($year)) {
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
      return response()->json(['data' => $booking_array, 'data_type' => 'year']);
    } else if (!empty($month) && empty($year)) {
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
      return response()->json(['data' => $booking_array, 'data_type' => 'month']);
    } else {
      return "Please select year or month first";
    }
  }
  public function cancellation_graph_data(Request $request)
  {
    $month = $request->month;
    $year = $request->year;
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
      return response()->json(['data' => $booking_array, 'data_type' => 'month']);
    } else if (empty($month) && !empty($year)) {
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
      return response()->json(['data' => $booking_array, 'data_type' => 'year']);
    } else if (!empty($month) && empty($year)) {
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
      return response()->json(['data' => $booking_array, 'data_type' => 'month']);
    } else {
      return "Please select year or month first";
    }
  }
  // state and city wise counting
  public function count_state_city_wise(Request $request){
    $state=$request->state;
    $city=$request->city;
    if (isset($request->state) && !empty($request->state)) {
      if (isset($request->city) && !empty($request->city)) {
        $total_onboard_agent_current = Agents::where('created', Carbon::today())->where('stateId',$request->state)->where('cityId',$request->city)->count();
        $total_onboard_agent = Agents::where('stateId',$request->state)->where('cityId',$request->city)->count();
        $total_active_agent = Agents::where('stateId',$request->state)->where('cityId',$request->city)->count();
        $total_booking_today = Booking::with('agent')->where('dateOfBooking', Carbon::today())->whereHas('agent', function ($query) use($state,$city) { $query->where('stateId','=', $state)->where('cityId','=', $city);})->count();
        $total_cancelled_ticket_today = Booking::with('agent')->where('created_at', Carbon::today())->whereHas('agent', function ($query) use($state,$city) { $query->where('stateId','=', $state)->where('cityId','=', $city);})->count();
        $total_faild_transection_today = Payments::with('agent')->where('created_at', Carbon::today())->whereHas('agent', function ($query) use($state,$city) { $query->where('stateId','=', $state)->where('cityId','=', $city);})->count();
        $data=[
          'total_onboard_agent_current'=>$total_onboard_agent_current,
          'total_onboard_agent'=>$total_onboard_agent,
          'total_active_agent'=>$total_active_agent,
          'total_booking_today'=>$total_booking_today,
          'total_cancelled_ticket_today'=>$total_cancelled_ticket_today,
          'total_faild_transection_today'=>$total_faild_transection_today
        ];
        return response()->json(['data' => $data, 'status' => 200,'msg'=>'All Data of '.$request->city.' of '.$request->state ],200);
      }else{
        $all_city = Agents::where('stateId',$request->state)->groupBy('cityId')->pluck('cityId');
        $total_onboard_agent_current = Agents::where('created', Carbon::today())->where('stateId',$request->state)->count();
        $total_onboard_agent = Agents::where('stateId',$request->state)->count();
        $total_active_agent = Agents::where('stateId',$request->state)->count();
        $total_booking_today = Booking::with('agent')->where('dateOfBooking', Carbon::today())->whereHas('agent', function ($query) use($state) { $query->where('stateId','=', $state);})->count();
        $total_cancelled_ticket_today = Booking::with('agent')->where('created_at', Carbon::today())->whereHas('agent', function ($query) use($state) { $query->where('stateId','=', $state);})->count();
        $total_faild_transection_today = Payments::with('agent')->where('created_at', Carbon::today())->whereHas('agent', function ($query) use($state) { $query->where('stateId','=', $state);})->count();
        $data=[
          'total_onboard_agent_current'=>$total_onboard_agent_current,
          'total_onboard_agent'=>$total_onboard_agent,
          'total_active_agent'=>$total_active_agent,
          'total_booking_today'=>$total_booking_today,
          'total_cancelled_ticket_today'=>$total_cancelled_ticket_today,
          'total_faild_transection_today'=>$total_faild_transection_today,
          'all_city'=>$all_city
        ];
        return response()->json(['data' => $data, 'status' => 200,'msg'=>'All Data of '.$request->state],200);
      }
    }else{
      return response()->json(['data' => [], 'status' => 200,'msg'=>'Please Select State'],300);
    }
  }
  public function count_list_statewise(Request $request)
  {
    $title = ucwords(str_replace('-', ' ', $request->data));
    $last_date=date('Y-m-d', strtotime('-1 day',strtotime(Carbon::today())));
    if ($request->data=="total-agents") {
      $count_list_statewise=Agents::select('stateId', Agents::raw('count(*) as total'))
    ->groupBy('stateId')->get();

    }elseif($request->data=="active-agents"){
      $today_bookings_agent_id = Booking::groupBy('agentUid')->pluck('agentUid');
      $count_list_statewise=Agents::whereIn('id', $today_bookings_agent_id)->select('stateId', Agents::raw('count(*) as total'))->groupBy('stateId')->get();

    }elseif($request->data=="new-register-agents"){
      $count_list_statewise=Agents::whereDate('created', Carbon::today())->select('stateId', Agents::raw('count(*) as total'))->groupBy('stateId')->get();

    }elseif($request->data=="booking-tickets"){
      $count_list_statewise = Booking::join('agents', 'agents.id', '=', 'bookings.agentUid')->whereDate('created_at', $last_date)->select('stateId',DB::raw("count(agents.stateId) as total"))->groupBy('stateId')->get();

    }elseif($request->data=="cancelled-tickets"){
      $count_list_statewise = Booking::join('agents', 'agents.id', '=', 'bookings.agentUid')->where('bookings.status',7)->whereDate('created_at', $last_date)->select('stateId',DB::raw("count(agents.stateId) as total"))->groupBy('stateId')->get();

    }elseif($request->data=="faild-transections"){
      $count_list_statewise = Booking::join('agents', 'agents.id', '=', 'bookings.agentUid')->where('bookings.status',3)->whereDate('created_at', $last_date)->select('stateId',DB::raw("count(agents.stateId) as total"))->groupBy('stateId')->get();
    }else{
      $count_list_statewise=Agents::select('stateId', Agents::raw('count(*) as total'))->groupBy('stateId')->get();
    }
    
    return view('dashboard.count-details',compact('title','count_list_statewise'));
  }
  // Date Wise Counting
  public function count_date_wise(Request $request){
    $start_date=$request->start_date;
    $end_date=$request->end_date;
    if (isset($request->start_date) && !empty($request->start_date)) {
      if (isset($request->end_date) && !empty($request->end_date)) {
        $total_onboard_agent = Agents::whereBetween('created', [$start_date, $end_date])->count();
        $total_active_agent = Agents::whereBetween('created', [$start_date, $end_date])->count();
        $data=[
          'total_onboard_agent'=>$total_onboard_agent,
          'total_active_agent'=>$total_active_agent
        ];
        return response()->json(['data' => $data, 'status' => 200,'msg'=>'All Data from'.$request->start_date.' to '.$request->end_date ],200);
      }else{
        $end_date=date('Y-m-d', strtotime(strtotime(Carbon::today())));
        $total_onboard_agent = Agents::whereBetween('created', [$start_date, $end_date])->count();
        $total_active_agent = Agents::whereBetween('created', [$start_date, $end_date])->count();
        $data=[
          'total_onboard_agent'=>$total_onboard_agent,
          'total_active_agent'=>$total_active_agent
        ];
        return response()->json(['data' => $data, 'status' => 200,'msg'=>'All Data from '.$request->start_date.' to today'],200);
      }
    }else{
      return response()->json(['data' => [], 'status' => 300,'msg'=>'Please Select start date'],300);
    }
  }
  // public function total_agents_list(AgentsDataTable $dataTable,Request $request)
  // {
  //   $title = ucwords(str_replace('-', ' ', $request->data));
  //   return $dataTable->render('dashboard.count-details',compact('title'));
  // }
  // public function active_agents_details(AgentsDataTable $dataTable,Request $request)
  // {
  //   $title = ucwords(str_replace('-', ' ', $request->data));
  //   return $dataTable->render('dashboard.count-details',compact('title'));
  // }
}
