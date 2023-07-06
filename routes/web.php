<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TdrController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\AgentsControllers;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardControllers;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WaitingListController;
use App\Http\Controllers\CancellationController;
use App\Http\Controllers\FullrefundsControllers;
use App\Http\Controllers\Partialrefundscontrollers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [UserAuthController::class, 'index'])->name('login');
Route::post('/user-login', [UserAuthController::class, 'user_login'])->name('user.login');
Route::get('/update-password', [UserAuthController::class, 'update_password'])->name('update.password');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

//route for get data for home graph
Route::group(['middleware' => ['auth']], function() {
    Route::post('booking-graph-data',[DashboardControllers::class, 'booking_graph_data'])->name('booking.graph.data');
    Route::post('cancellation-graph-data',[DashboardControllers::class, 'cancellation_graph_data'])->name('cancellation.graph.data');
    Route::get('/', [DashboardControllers::class, 'index'])->name('index_dashboard');
    Route::get('booking', [BookingController::class, 'index'])->name('index_booking');
    Route::get('full-refund', [FullrefundsControllers::class, 'index'])->name('index_fullrefund');
    Route::get('partial-Refund', [Partialrefundscontrollers::class, 'index'])->name('index_partialrefunds');
    Route::get('agents', [AgentsControllers::class, 'index'])->name('index_agents');
    Route::get('cancellation', [CancellationController::class, 'index'])->name('index_cancellation');
    Route::POST('cancellation/search', [CancellationController::class, 'index'])->name('search');
    Route::get('transaction', [TransactionController::class, 'index'])->name('index_transaction');
    Route::get('waiting-cancellation', [WaitingListController::class, 'index'])->name('index_waiting_cancellation');
    Route::get('tdr', [TdrController::class, 'index'])->name('tdr.index');
    // export routes
    Route::post('transection-export',[TransactionController::class, 'transection_export'])->name('transection.export');
    Route::post('booking-export',[BookingController::class, 'booking_export'])->name('booking.export');
    Route::post('full-refund-export',[FullrefundsControllers::class, 'full_refund_export'])->name('full.refund.export');
    Route::post('partial-Refund-export',[Partialrefundscontrollers::class, 'partial_Refund_export'])->name('partial.Refund.export');
    Route::post('cancellation-export',[CancellationController::class, 'cancellation_export'])->name('cancellation.export');
    Route::post('waiting-cancellation-export',[WaitingListController::class, 'waiting_cancellation_export'])->name('waiting.cancellation.export');
    Route::post('tdr-export',[TdrController::class, 'tdr_export'])->name('tdr.export');
    // view details
    Route::get('transection-view/{id}',[TransactionController::class, 'transection_view'])->name('transection.view');
    Route::get('booking-view/{id}',[BookingController::class, 'booking_view'])->name('booking.view');
    Route::get('cancellation-view/{id}',[CancellationController::class, 'cancellation_view'])->name('cancellation.view');
    Route::get('full-refund-view/{id}',[FullrefundsControllers::class, 'full_refund_view'])->name('full.refund.view');
    Route::get('partial-refund-view/{id}',[Partialrefundscontrollers::class, 'partial_refund_view'])->name('partial.refund.view');
    Route::get('tdr-view/{id}',[TdrController::class, 'tdr_view'])->name('tdr.view');
    Route::get('waiting-cancellation-view/{id}',[WaitingListController::class, 'waiting_cancellation_view'])->name('waiting.cancellation.view');
    Route::post('count-sate-city-wise',[DashboardControllers::class, 'count_state_city_wise'])->name('count.state.city.wise');
    Route::post('count-date-wise',[DashboardControllers::class, 'count_date_wise'])->name('count.date.wise');
    Route::get('count-list-statewise/{data}',[DashboardControllers::class, 'count_list_statewise'])->name('count.list.statewise');
    Route::get('/list-requests', function () {
        return view('list-requests');
    });
    Route::get('/list-requests', function () {
        return view('list-requests');
    });
    Route::get('/accepted-requests', function () {
        return view('accepted-requests');
    });
    Route::get('/list-rejected-requests', function () {
        return view('list-rejected-requests');
    });
    Route::get('/list-refunded-application', function () {
        return view('list-refunded-application');
    });
    Route::get('/refund', function () {
        return view('refund');
    });
    Route::get('/view', function () {
        return view('view');
    });
    Route::get('schedule-run', function () {

        Artisan::call('schedule:run');
    
        dd("schedule run successfully");
    
    });
});

// Route::get('refund', [RefundController::class, 'index'])->name('index_refund');
// Route::get('/tdr', function () {
//     return view('tdr');
// });
// Route::get('insert-tdr',[TdrController::class, 'insert_tdr'])->name('insert.tdr');
// Route::get('total-agents-list/{data}',[DashboardControllers::class, 'total_agents_list'])->name('total.agents.list');
// Route::get('active-agents-list/{data}',[DashboardControllers::class, 'active_agents_details'])->name('active.agents.list');


