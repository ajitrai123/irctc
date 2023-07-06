<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DbupdateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbupdate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $bookings_data=[
        //     'agentUid'=>1, 'booking_sess_id'=>'ABUA196HORLYEMMPGgGQIq8orslLjcRo1jP4pmlf', 'cscRequestId'=>null, 'passengerMobile'=>9711393536, 'fromStation'=>'NDLS', 'toStation'=>'TATA', 'boardingStnName'=>'', 'resvnUptoStnName'=>'', 'journeyDate'=>'2023-08-03', 'arrivalTime'=>'10:40', 'departureTime'=>'17:00', 'totPassengers'=>1, 'gst_number'=>'', 'companyname'=>'', 'pincode_gst'=>'', 'address_gst'=>'', 'reservationchoice'=>99, 'coachno'=>'', 'travel_insurance'=>'yes', 'dateOfBooking'=>'2023-07-04 14:55:50', 'boardingDate'=>'2023-08-03T17:00:00', 'boardingStation'=>'NDLS', 'trainName'=>'BBS RAJDHANI', 'trainNumber'=>22824, 'arrival'=>'10:40', 'bookedClass'=>'3A', 'destStation'=>'TATA', 'journeyClass'=>'3A', 'journeyQuota'=>'GN', 'pnrNumber'=>2351256095, 'reservationId'=>200000078038209, 'reservedUpto'=>'TATA', 'duration'=>'17:40', 'distance'=>1333, 'created_at'=>'2023-07-04 14:55:50', 'updated_at'=>'2023-07-04 14:55:50', 'ipAddress'=>'127.0.0.1', 'userAgent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'appVersion'=>3, 'status'=>8, 'otherData'=>'{"boardingDate":"2023-08-03T17:00:00","boardingStn":"NDLS","cateringCharge":400,"distance":1333,"fuelAmount":0.0,"insuredPsgnCount":1,"journeyDate":"2023-08-03T00:00:00","otpAuthenticationFlag":0,"reservationCharge":40,"serverId":"Server-0","serviceTax":102.6,"superfastCharge":45,"tatkalFare":0,"timeStamp":"2023-08-03T14:56:53.668","totalFare":2555,"trainName":"BBS RAJDHANI","trainOwner":0,"wpServiceCharge":30.0,"wpServiceTax":5.4,"arrivalTime":"10:40","avlForVikalp":false,"boardingStnName":"NEW DELHI","bookedQuota":"GENERAL","bookingDate":"2023-08-03T14:53:24","canSpouseFlag":false,"clientTransactionId":"50010010212280000254","complaintFlag":0,"departureTime":"17:00","destArrvDate":"2023-08-05T10:40:00","destStn":"TATA","fromStn":"NDLS","fromStnName":"NEW DELHI","gstCharge":{"cateringGst":18.7,"cgstRate":2.5,"gstRate":5.0,"gstinSuplier":"07AAAGM0289CA19","igstRate":5.0,"invoiceNumber":"PS22235125609211","irctcCgstCharge":2.7,"irctcIgstCharge":0.0,"irctcSgstCharge":0.0,"irctcUgstCharge":2.7,"prsCgstCharge":51.3,"prsIgstCharge":0.0,"prsSgstCharge":0.0,"prsSuplierState":"Delhi","prsSuplierStateCode":"7","prsUgstCharge":51.3,"sacCode":996421,"sgstRate":2.5,"suplierAddress":"Indian Railways New Delhi","taxableAmt":2052,"totalIrctcGst":5.4,"totalPRSGst":102.5999984741211,"ugstRate":2.5},"gstFlag":true,"informationMessage":["","","","","","","","","",""],"insuranceCharge":0.35,"journeyClass":"3A","journeyLap":0,"journeyQuota":"GN","lapNumber":0,"mahakalFlag":false,"mealChoiceEnable":false,"mealTransaction":{"bookingMode":0,"bookingSource":0,"mealBooked":false,"reservationId":0,"ticketId":0,"tktCanStatus":0},"mlJourneyType":0,"mlReservationStatus":0,"mlTimeDiff":0,"mlTransactionStatus":0,"mlUserId":0,"monthBkgTicket":3,"multiLapFlag":false,"numberOfAdults":1,"numberOfChilds":0,"numberOfpassenger":1,"pnrNumber":"2351256092","psgnDtlList":[{"bookingBerthCode":"LB","bookingBerthNo":"52","bookingCoachId":"B7","bookingStatus":"CNF","bookingStatusIndex":"1","childBerthFlag":"true","currentBerthChoice":"LB","currentBerthCode":"LB","currentBerthNo":"52","currentCoachId":"B7","currentStatus":"CNF","currentStatusIndex":"1","dropWaitlistFlag":"false","fareChargedPercentage":"0.0","foodChoice":"N","insuranceIssued":"Yes","passengerAge":"34","passengerBedrollChoice":"false","passengerBerthChoice":"LB","passengerConcession":"","passengerFoodChoice":"N","passengerGender":"M","passengerIcardFlag":"false","passengerName":"AMIT KUMAR SINHA","passengerNationality":"IN","passengerNetFare":"2555","passengerSerialNumber":"1","psgnwlType":"0","validationFlag":"N"}],"reasonIndex":1,"reasonType":"S","reservationId":"200000078038208","resvnUptoStn":"TATA","resvnUptoStnName":"TATANAGAR JN","rrHbFlag":"YY","sai":false,"scheduleArrivalFlag":true,"scheduleDepartureFlag":true,"sectorId":false,"serviceChargeTotal":35.4,"ticketType":"E-ticket","timeDiff":0,"timeTableFlag":0,"totalCollectibleAmount":2590.75,"totalRefundAmount":0.0,"tourismUrl":"https://www.irctctourism.com/tourism/pkgUser/Irctc/pacPage","trainNumber":"22824","travelnsuranceRefundAmount":0.0}'
        // ];
        // $bookings_query_insert = DB::connection('mysql')->table('bookings')->insert($bookings_data);
        // $agents_data=[
        //     'masterId'=>'WCSC00000', 
        //     'agentUserId'=>'WCSC00018',
        //     'cscId'=>'500100100018', 
        //     'requestType'=>'',
        //     'email'=>'agent1@gmail.com', 
        //     'mobile'=>9000000007, 
        //     'firstName'=>'Agent', 
        //     'middleName'=>'00', 
        //     'lastName'=>'1', 
        //     'dob'=>'1994-08-04', 
        //     'address'=>'Shop 101, 7/62, Sec-5, Rajendar Nagar, GZB', 
        //     'office_address'=>'Shop 101, 7/62, Sec-5, Rajendar Nagar, GZB', 
        //     'cityId'=>'GHAZIABAD', 
        //     'stateId'=>'UTTAR PRADESH', 
        //     'countryId'=>'INDIA', 
        //     'pincode'=>201005, 
        //     'officePinCode'=>201005, 
        //     'panNumber'=>'ABCTY1234D', 
        //     'gender'=>'M', 
        //     'status'=>'1', 
        //     'created'=>'2023-07-04 16:58:17',
        //     'updated'=>'2023-07-04 16:58:17',
        // ];
        // $agents_query_insert = DB::connection('mysql')->table('agents')->insert($agents_data);
        // Log::info("Cron is working fine! ".$agents_query_insert);
        // $data=DB::connection('mysql2')->table("agents")->get()->toArray();
        // foreach ($data as $d) {
        //     Log::debug($d);
        //     // $query_insert = DB::connection('mysql')->table('agents')->insert($d);
        // }
        // $query_insert = DB::connection('mysql')->table('agents')->insert($data);
        Log::info("Cron is working fine!");
        // Log::debug($data);
    }
}
