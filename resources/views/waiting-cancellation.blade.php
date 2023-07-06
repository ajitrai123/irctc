@extends('layouts.master')
@section('content')
<style>
    td:nth-child(7n) {  
    color:green;    
    }
    td:nth-child(8n) {  
    color:green;    
    }
</style>
<nav aria-label="breadcrumb background-light text-right">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page">Waiting List Cancellation Report </li>
    </ol>
</nav>
<div class="container-fluid mw-1200 py-30">
    <div class="box  mb-4">
        <div class="box-body">
            <div class="row">
                <div class="col-8">
                    <h6 class="mb-0">Waiting List Cancellation Report</h6>
                </div>
                <!-- <div class="col-4 text-right">
                                <button class="btn btn-dark " >Add SLA</button>
                            </div> -->
            </div>
        </div>
        <hr class="m-0">
        <div class="box-body">
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="unresolved" role="tabpanel" aria-labelledby="unresolved-tab">

                    <div class="row justify-content-start">

                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control " placeholder="Search by CSC ID" id="other"
                                name="other" value="">
                        </div>

                        <div class="col-md-2 mb-3 input-daterange">
                            <input type="text" class="form-control " placeholder="Start Date" id="from_date" name="from_date" value="" readonly />
                        </div>
                        <div class="col-md-2 mb-3 input-daterange">
                            <input type="text" class="form-control " placeholder="End Date" id="to_date"
                                name="to_date" value="" readonly />
                        </div>
                        <div class="col-md-2 mb-3 input-daterange">
                            <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                @foreach ($all_state as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3 input-daterange">
                            <select name="city" id="city" class="form-control">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="button" id="export-btn" class="btn btn-light"><i
                                    class="bx bx-download"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped booking_datatable">
                            <thead class="">
                                <tr>
                                    
                                    {{-- SL NO	CSC ID	AGENT ID	PNR NUMBER	TRANSACTION ID	RESERVATION ID	REFUND AMOUNT	CURRENT STATUS	CANCELLED DATE	STATUS --}}
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Sl no</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">CSC Id</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Booking Id</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Agent ID</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">PNR Number</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Transaction ID</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Reservation ID</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Refund Amount</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Current Status</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Cancelled Date</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Status</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function load_data(other = '', from_date = '', to_date = '', state = '', city = '') {
            var dataTable = $('#order_table').DataTable({
                buttons: [
                    'excelHtml5', 'copy', 'excel', 'csv'
                ],
                dom: 'rtp',
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("index_waiting_cancellation") }}',
                    data: {
                        other: other,
                        from_date: from_date,
                        to_date: to_date,
                        state: state,
                        city: city
                    }
                },
                drawCallback: function (settings) { 
                    // Here the response
                    var response = settings.json;
                    if (response.recordsTotal <= 0) {
                        $('#export-btn').prop('disabled', true);
                        $('#export-btn').css("background", "red");
                        $('#export-btn').css("color", "#fff");
                    }else{
                        $('#export-btn').prop('disabled', false);
                        $('#export-btn').css("background", "green")
                        $('#export-btn').css("color", "#fff");
                    }
                },
                // SL NO	CSC ID	AGENT ID	PNR NUMBER	TRANSACTION ID	RESERVATION ID	REFUND AMOUNT	CURRENT STATUS	CANCELLED DATE	STATUS
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'cscId',
                        name: 'cscId'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'agentUserId',
                        name: 'agentUserId'
                    },
                    {
                        data: 'pnrNumber',
                        name: 'pnrNumber'
                    },
                    {
                        data: 'reqTxn',
                        name: 'reqTxn'
                    },
                    {
                        data: 'reservationId',
                        name: 'reservationId'
                    },
                    {
                        data: 'refundAmount',
                        name: 'refundAmount'
                    },
                    {
                        data: 'currentStatus',
                        name: 'currentStatus'
                    },
                    {
                        data: 'cancellationDate',
                        "render": function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear();
                        }
                    },
                    {
                        data: 'status',
                        // name: 'status'
                        render : function(data, type, row) {
                            if (data==5) {
                                return '<span class="badge badge-success px-2 py-1"><i class="bx bx-check-circle text-white"></i> Success</span>'
                            }else{
                                return '<span class="badge badge-danger px-2 py-1"><i class="bx bx-check-circle text-white"></i> Failed</span>'
                            }
                            
                        } 
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        }
</script>
<script>
    $(document).ready(() => {
        $( "#from_date" ).datepicker({
            defaultDate: "+1d",
            changeMonth: true,
            changeYear: true,
            format: 'dd-mm-yyyy',endDate: '+0d',
            autoclose: true
        }).on('hide', function() {
            var selected = $(this).val();
            $( "#to_date" ).datepicker('setStartDate', selected);
        });
        $( "#to_date" ).datepicker({
            defaultDate: "+1d",
            changeMonth: true,
            changeYear: true,
            format: 'dd-mm-yyyy',endDate: '+0d',
            autoclose: true
        }).on('hide', function() {
            var selected = $(this).val();
            $( "#from_date" ).datepicker('setEndDate', selected);
        });

        load_data();

        $("#other").keyup(function() {
            var city = $('#city').val();
            var state = $('#state').val();
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");
            if (other.length != 0) {
                // $('#other').val('');
                // $('#from_date').val('');
                // $('#to_date').val('');
                sessionStorage.setItem("report_id", other);
                sessionStorage.setItem("report_date", '');
                $('#order_table').DataTable().destroy();
                load_data(other, from_date, to_date, state, city);
            } else {
                $('#order_table').DataTable().destroy();
                load_data();
                return false;
            }
        });
        $("#to_date").change(function() {
            var city = $('#city').val();
            var state = $('#state').val();
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");
            if (!from_date) {
		        $('.notify-container').empty();
                notify({
                    message: 'Please select a from date first.',
                    color: 'danger',
                    timeout: 2000
                });
                $('#to_date').val('');
            } else {
                if (from_date.length != 0 && to_date.length != 0) {
                    var fromDateObj = new Date(from_date);
                    var toDateObj = new Date(to_date);
                    var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    if (diffDays > 7) {
			            $('.notify-container').empty();
                        notify({
                            message: 'Please select a date range within 7 days.',
                            color: 'danger',
                            timeout: 2000
                        });
                        $('#from_date').val('');
                        $('#to_date').val('');
                        return false;
                    } else {
                        sessionStorage.setItem("report_date", from_date + '-' + to_date);
                        sessionStorage.setItem("report_id", '');
                        $('#order_table').DataTable().destroy();
                        load_data(other, from_date, to_date, state, city);
                    }
                } else {
			        $('.notify-container').empty();
                    notify({
                            message: 'Please select a valid date.',
                            color: 'danger',
                            timeout: 2000
                        });
                    return false;
                }
            }

        });
        $("#from_date").change(function() {
            var city = $('#city').val();
            var state = $('#state').val();
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");
            if (from_date.length != 0 && to_date.length != 0) {
                var fromDateObj = new Date(from_date);
                var toDateObj = new Date(to_date);
                var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (diffDays > 7) {
			        $('.notify-container').empty();
                    notify({
                            message: 'Please select a date range within 7 days.',
                            color: 'danger',
                            timeout: 2000
                        });
                    $('#from_date').val('');
                    $('#to_date').val('');
                    return false;
                } else {
                    sessionStorage.setItem("report_date", from_date + '-' + to_date);
                    sessionStorage.setItem("report_id", '');
                    $('#order_table').DataTable().destroy();
                    load_data(other, from_date, to_date, state, city);
                }
            }
        });

        // Export button event handler
        $('#export-btn').on('click', function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");

            if (other != '' || from_date != '') {
                $.ajax({
                    type:'POST',
                    url:'{{  route("waiting.cancellation.export")  }}',
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    data:{other:other,from_date:from_date,to_date:to_date},
                    success:function(result, status, xhr) {
                        var disposition = xhr.getResponseHeader('content-disposition');
                        var matches = /"([^"]*)"/.exec(disposition);
                        var file_date='';
                        if (to_date != '') {
                            file_date='-'+from_date+'-'+to_date;
                        }
                        var filename = (matches != null && matches[1] ? matches[1] : 'waiting-cancellation'+other+file_date+'.csv');

                        // The actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;

                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);
			$('.notify-container').empty();
                        notify({
                            message: 'Data is exported.',
                            color: 'success',
                            timeout: 2000
                        });
                    }
                });
            } else {
		$('.notify-container').empty();
                notify({
                    message: 'For exporting data please search by CSC ID or use date range filter.',
                    color: 'danger',
                    timeout: 2000
                });            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#state').on('change',function(){
            var state=this.value;
            var city = $('#city').val();
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");
            $.ajax({
                url: "{{ route('count.state.city.wise') }}",
                type: "POST",
                data: {_token: "{{ csrf_token() }}",state : state},
                dataType: "json",
                success: function(response){
                    if (response.status==200) {
                        $('#city option:gt(0)').remove();
                        $.each(response.data.all_city, function(key, value) {   
                            $('#city').append($("<option></option>").attr("value", value).text(value)); 
                        });
                        
                    }
                }
            });
            $('#order_table').DataTable().destroy();
            load_data(other, from_date, to_date,state,city);
        });
        $('#city').on('change',function(){
            var state=$('#state').val();
            var city=this.value;
            var other = $('#other').val();
            var from_date = $('#from_date').val().split("-").reverse().join("-");
            var to_date = $('#to_date').val().split("-").reverse().join("-");
            $('#order_table').DataTable().destroy();
            load_data(other, from_date, to_date, state, city);
            
        });
    });
</script>
@endsection
