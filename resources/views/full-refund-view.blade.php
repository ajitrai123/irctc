@extends('layouts.master')
@section('content')


<nav aria-label="breadcrumb background-light text-right">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://localhost/irctcnew/public/">Home</a></li>
        <li class="breadcrumb-item"><a href="http://localhost/irctcnew/public/full-refund">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Page </li>
    </ol>
</nav>
<div class="container-fluid mw-1200 py-30">
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                {{-- full refund details --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="mb-0">Full Refund Details</h6>
                        </div>
                        <div class="col-md-4">
                            <a href="http://localhost/irctcnew/public/full-refund" class="btn btn-sm m-0  btn-light">Back</a>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="box-body ">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Full Refund Id</label>
                                <h6>{{ $full_refund->id }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Booking Id</label>
                                <h6>{{ $booking->id }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Agent Id</label>
                                <h6>{{ $agent->agentUserId }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Client Transection Id </label>
                                <h6>{{ $payments->reqTxn }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">CSC Transection</label>
                                <h6>{{ $payments->csc_txn }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Product Id</label>
                                <h6>{{ $payments->productId }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">CSC Request Id</label>
                                <h6>{{ $booking->cscRequestId }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Response Status</label>
                                @if ($full_refund->status == 0)
                                <h6><span class="badge badge-warning px-2 py-1"><i class="bx bx-check-circle text-white"></i> {{ $full_refund->responseStatus }}</span> </h6>                              
                                @elseif ($full_refund->status == 1)
                                <h6><span class="badge badge-success px-2 py-1"><i class="bx bx-check-circle text-white"></i> {{ $full_refund->responseStatus }}</span> </h6>                              
                                @else
                                <h6><span class="badge badge-danger px-2 py-1"><i class="bx bx-check-circle text-white"></i> {{ $full_refund->responseStatus }}</span>  </h6>                             
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Response Message</label>
                                <h6>{{ $full_refund->responseMessage }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Response Date</label>
                                <h6>{{ date("d/m/Y", strtotime($full_refund->responseDate)); }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Booking details --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="mb-0">Booking Details</h6>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="box-body ">
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Booking Id</label>
                                <h6>{{ $booking->id }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Passenger Mobile</label>
                                <h6>{{ $booking->passengerMobile }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">From Station</label>
                                <h6>{{ $booking->fromStation }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">To Station</label>
                                <h6>{{ $booking->toStation }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Boarding Stationn Name</label>
                                <h6>{{ $booking->boardingStnName }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Journey Date</label>
                                <h6>{{ $booking->journeyDate }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Arrival Time</label>
                                <h6>{{ $booking->arrivalTime }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Departure Time</label>
                                <h6>{{ $booking->departureTime }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Total Passengers</label>
                                <h6>{{ $booking->totPassengers }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Date Of Booking</label>
                                <h6>{{ date("d/m/Y", strtotime($booking->dateOfBooking)); }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Boarding Date</label>
                                <h6>{{ date("d/m/Y", strtotime($booking->boardingDate)); }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Train Number</label>
                                <h6>{{ $booking->trainNumber }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Train Name</label>
                                <h6>{{ $booking->trainName }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Booked Class</label>
                                <h6>{{ $booking->journeyClass }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Journey Quota</label>
                                <h6>{{ $booking->journeyQuota }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">PNR Number</label>
                                <h6>{{ $booking->pnrNumber }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Duration</label>
                                <h6>{{ $booking->duration }} Hrs.</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Distance</label>
                                <h6>{{ $booking->distance }} km.</h6>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Transection details --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="mb-0">Transection Details</h6>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="box-body ">
                    <div class="row ">
                        {{-- <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Transection Status</label>
                                <h6>{{ $payments->txn_status }}</h6>
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Total Fare</label>
                                <h6>{{ $payments->totalFare }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">WP Service Charge</label>
                                <h6>{{ $payments->wpServiceCharge }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">WP Service Tax</label>
                                <h6>{{ $payments->wpServiceTax }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Insurance Charge</label>
                                <h6>{{ $payments->insuranceCharge }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Travel Agent Charge</label>
                                <h6>{{ $payments->travelAgentCharge }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">CSC Commission</label>
                                <h6>{{ $payments->cscCommission }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Wallet Amount</label>
                                <h6>{{ $payments->walletAmount }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Total Collectible Amount</label>
                                <h6>{{ $payments->totalCollectibleAmount }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Travel Insurance Service Tax</label>
                                <h6>{{ $payments->travelInsuranceServiceTax }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Transection Amount</label>
                                <h6>{{ $payments->txn_amount }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Transection date</label>
                                <h6>{{ date("d/m/Y", strtotime($payments->created_at)); }}</h6>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Status </label>
                                <h6>{{ $payments->status }}</h6>
                            </div>
                        </div> --}}
                    </div>
                </div>
                
                {{-- Passenger details --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="mb-0">Passenger Details</h6>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="box-body ">
                    @foreach ($passengers as $passenger)
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="view-font">
                                <label class="label-app">Passenger Name</label>
                                <h6>{{ $passenger->passengerName }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Age</label>
                                <h6>{{ $passenger->age }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Gender</label>
                                <h6>{{ $passenger->gender }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Berth No</label>
                                <h6>{{ $passenger->bookingBerthNo }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Status</label>
                                <h6>{{ $passenger->bookingStatus }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Coach</label>
                                <h6>{{ $passenger->bookingCoachId }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Current Berth</label>
                                <h6>{{ $passenger->currentBerthNo }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Current Coach</label>
                                <h6>{{ $passenger->currentCoachId }}</h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="view-font">
                                <label class="label-app">Current Status</label>
                                <h6>{{ $passenger->currentStatus }}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var panverified;
    var account;
    var ifsc;
    var physical;

    $("input[name=customRadioInline0]").click(function(){
         panverified = $("input[name=customRadioInline0]:checked").val();
         if(panverified == "0" || account == "0" || ifsc == "0" || physical == "0" )
        {
            $("#app_type").val('rejection');
            $("#app_type").attr('disabled',true);
            $('.section-hide').removeClass('d-none');

        }
        else{
            $("#app_type").val('selection');
            $('#app_type').removeAttr('disabled');
            $('.section-hide').addClass('d-none');
        }

    
    });

    $("input[name=customRadioInline1]").click(function(){
        account = $("input[name=customRadioInline1]:checked").val();
        if(panverified == "0" || account == "0" || ifsc == "0" || physical == "0" )
        {
            $("#app_type").val('rejection');
            $("#app_type").attr('disabled',true);
            $('.section-hide').removeClass('d-none');
            

        }
        else{
            $("#app_type").val('selection');
            $('#app_type').removeAttr('disabled');
            $('.section-hide').addClass('d-none');
        }
        
    });

    $("input[name=customRadioInline2]").click(function(){
        ifsc = $("input[name=customRadioInline2]:checked").val();
        if(panverified == "0" || account == "0" || ifsc == "0" || physical == "0" )
        {
            $("#app_type").val('rejection');
            $("#app_type").attr('disabled',true);
            $('.section-hide').removeClass('d-none');

        }
        else{
            $("#app_type").val('selection');
            $('#app_type').removeAttr('disabled');
            $('.section-hide').addClass('d-none');
        }
        
    });

    $("input[name=customRadioInline3]").click(function(){
        physical = $("input[name=customRadioInline3]:checked").val();
        if(panverified == "0" || account == "0" || ifsc == "0" || physical == "0" )
        {
            $("#app_type").val('rejection');
            $("#app_type").attr('disabled',true);
            $('.section-hide').removeClass('d-none');   

        }
        else{
            $("#app_type").val('selection');
            $('#app_type').removeAttr('disabled');
            $('.section-hide').addClass('d-none');
        }
    });
    // ---------------------------------------

</script>



@endsection