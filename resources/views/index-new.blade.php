@extends('layouts.master')
@section('content')
<div class="container-fluid mw-1200 py-30">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="row filter-dropdowns">
                        <div class="col-md-3 mb-3">
                            <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                @foreach ($all_state as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <select name="city" id="city" class="form-control">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" id="total_start_date" placeholder="Start Date" readonly style="cursor:pointer;background-color: #fff;" />
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group date" id="datepicker2">
                                <input type="text" class="form-control" id="total_end_date" placeholder="End Date" readonly style="cursor:pointer;background-color: #fff;" />
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12939.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text" id="total_onboard_agent">{{ $total_onboard_agent }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Total Agents</h6>
                        <!-- <h3>4123</h3> -->
                        {{-- <p class="mb-0">Last 7 dayes</p> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12939.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text"  id="total_active_agent">{{ $total_active_agent }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Active Agents</h6>
                        <!-- <h3>4123</h3> -->
                        {{-- <p class="mb-0">Last 7 dayes</p> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12939.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text" id="total_onboard_agent_current">{{ $total_onboard_agent_current }}</span>
                        </h6>
                        <h6 class="fbox-i-text">New Register Agents</h6>
                        {{-- <h6 class="fbox-i-text">Registered Agents</h6> --}}
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last day</p>
                    </div>
                </div>
                <!-- division -->
                <div class="col-md-12">
                    <div class="fbox fbox-primary-2 mb-20">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12940.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text">1234</span>
                        </h6>
                        <h6 class="fbox-i-text">New Application</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12940.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text">1234</span>
                        </h6>
                        <h6 class="fbox-i-text">Accepted Application</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12940.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text">1234</span>
                        </h6>
                        <h6 class="fbox-i-text">Refunded Application</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
                <!-- division -->
                <div class="col-md-12">
                    <div class="fbox fbox-primary-2 mb-20">

                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12938.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text" id="total_booking_today">{{ @$total_booking_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Booked Tickets </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12938.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text" id="total_cancelled_ticket_today">{{ @$total_cancelled_ticket_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Cancelled Tickets </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(public/admin_assets/img/dm/Group-12938.svg);">
                        <img class="fbox-background" src="public/admin_assets/img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="public/admin_assets/img/icon/Resolved.svg">
                            </span>
                            <span class="fbox-icon-text" id="total_refund_today">{{ @$total_refund_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Refund </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Last Day / Live Day</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="box">
                        <div class="box-head">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="box-title">Ticket Booking Trend </h6>
                                </div>
                                <div class="col-md-6 d-flex" id="chart1">
                                    <select class="form-control box-head-select" id="chart1_month_btn" data-label="Ticket Booking Trend">
                                        <option selected value="">Month</option>
                                    </select>
                                    <select class="form-control box-head-select ml-1" id="chart1_year_btn" data-label="Ticket Booking Trend">
                                        <option selected value="">Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-body" id="chart1-container">
                            <canvas id="eight-month-chart" class="chart_view" height="130"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-20">
                    <div class="box">
                        <div class="box-head">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="box-title">Ticket Cancellation Trend </h6>
                                </div>
                                <div class="col-md-6 d-flex" id="chart2">
                                    <select class="form-control box-head-select" id="chart2_month_btn" data-label="Ticket Cancellation Trend">
                                        <option selected value="">Month</option>
                                    </select>
                                    <select class="form-control box-head-select ml-1" id="chart2_year_btn" data-label="Ticket Cancellation Trend">
                                        <option selected value="">Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-body" id="chart2-container">
                            <canvas id="seven-day-chart" class="chart_view" height="130"></canvas>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
    (() => {
        let year_satart = 1940;
        let year_end = (new Date).getFullYear(); // current year

        let option = '';
        option = '<option value="">Year</option>'; // first option

        for (let i = year_satart; i <= year_end; i++) {
            let selected = (i === year_end ? ' selected' : '');
            option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
        }

        document.getElementById("chart2_year_btn").innerHTML = option;
        document.getElementById("chart1_year_btn").innerHTML = option;
    })();
</script>
<script>
    (() => {
        let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        let month_selected = (new Date).getMonth(); // current month
        let option = '';
        let month_value = '';
        option = '<option value="">Month</option>'; // first option

        for (let i = 0; i < months.length; i++) {
            let month_number = (i + 1);
            month_value = month_number;
            let selected = (i === month_selected ? ' selected' : '');
            option += '<option value="' + month_value + '"' + selected + '> ' + months[i] + ' </option>';
        }
        document.getElementById("chart1_month_btn").innerHTML = option;
        document.getElementById("chart2_month_btn").innerHTML = option;
    })();
</script>
<script>
    function makechart(chartid, data_array, chartby, label) {
        if (chartby == "year") {
            var label_array = ["Jan", "Feb", "March", "April", "may", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
        }
        if (chartby == "month") {
            var now = new Date();
            var no_of_day = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
            var label_array = Array.from({ length: no_of_day }, (_, index) => index + 1);
            // data_array = Array.from({length: no_of_day}, (_, index) => index + 1);

        }
        if (chartby == "week") {
            var label_array = ["Sun", "Tues", "Wed", "Thrus", "Fri", "Sat"];
            data_array = [1, 2, 3, 4, 5, 6, 7];
        }
        var makechartvar = {
            type: 'line',
            data: {

                labels: label_array,
                datasets: [
                    {
                        type: 'line',
                        label: label,
                        backgroundColor: "rgb(255 206 91/ 10%)",
                        borderColor: "rgb(255 206 91)",
                        borderWidth: 2,
                        pointBackgroundColor: 'rgb(255 206 91)',
                        pointBorderColor: 'rgb(255, 255, 255)',
                        pointBorderWidth: 2,
                        pointRadius: 0,
                        fill: true,
                        //  data: New_Application,
                        data: data_array
                    },
                ]
            },
            options: {
                plugins: {
                    datalabels: {
                        display: false
                    }
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    labels: {
                        usePointStyle: true,
                        boxWidth: 4,

                    }
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        beginAtZero: false,
                        ticks: {
                            autoSkip: false
                        },
                        stacked: true,
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            fontSize: 10,
                        }
                    }],
                    yAxes: [{
                        stacked: false,
                        barPercentage: 0.3,
                        gridLines: {
                            color: 'rgb(247, 250, 252)',
                            borderDash: [5, 2],
                            zeroLineColor: 'rgb(247, 250, 252)',
                        },
                        ticks: {

                            fontSize: 11,
                        }
                    }]
                }
            }
        };

        window.myDoughnut = new Chart(chartid, makechartvar);
    }

    window.onload = function () {
        // booking chart
        var chartid1 = document.getElementById('eight-month-chart').getContext('2d');
        var booking_array = JSON.parse('{{ $booking_array }}'); //php array json to javascript array
        makechart(chartid1, booking_array, "year", "Ticket Booking Trend")

        // cancellation chart
        var chartid2 = document.getElementById('seven-day-chart').getContext('2d');
        var cancellation_array = JSON.parse('{{ $cancellation_array }}'); //php json to javascript array
        makechart(chartid2, cancellation_array, "year", "Ticket Cancellation  Trend");
        $('#chart1_month_btn').on('change', function () {
            var month = $(this).val();
            var year = $('#chart1_year_btn').val();
            var label = $('#chart1_year_btn').data("label");
            $.ajax({
                type: 'POST',
                url: '{{ route("booking.graph.data") }}',
                data: { month: month, year: year, _token: '{{ csrf_token() }}', label: label },
                success: function (res) {
                    $('#eight-month-chart').remove(); // this is my <canvas> element
                    $('#chart1-container').append('<canvas id="eight-month-chart" class="chart_view" height="130"></canvas>');
                    var chartid1 = document.getElementById('eight-month-chart').getContext('2d');
                    makechart(chartid1, res.data, res.data_type, label);
                }
            });
        });
        $('#chart1_year_btn').on('change', function () {
            $('#chart1_month_btn').val('')
            var year = $(this).val();
            var label = $('#chart1_year_btn').data("label");
            $.ajax({
                type: 'POST',
                url: '{{ route("booking.graph.data") }}',
                data: { month: '', year: year, _token: '{{ csrf_token() }}', label: label },
                success: function (res) {
                    $('#eight-month-chart').remove(); // this is my <canvas> element
                    $('#chart1-container').append('<canvas id="eight-month-chart" class="chart_view" height="130"></canvas>');
                    var chartid1 = document.getElementById('eight-month-chart').getContext('2d');
                    makechart(chartid1, res.data, res.data_type, label);
                }
            });
        });
        $('#chart2_month_btn').on('change', function () {
            var month = $(this).val();
            var year = $('#chart2_year_btn').val();
            var label = $('#chart2_year_btn').data("label");
            $.ajax({
                type: 'POST',
                url: '{{ route("cancellation.graph.data") }}',
                data: { month: month, year: year, _token: '{{ csrf_token() }}', label: label },
                success: function (res) {
                    $('#seven-day-chart').remove(); // this is my <canvas> element
                    $('#chart2-container').append('<canvas id="seven-day-chart" class="chart_view" height="130"></canvas>');
                    var chartid1 = document.getElementById('seven-day-chart').getContext('2d');
                    makechart(chartid1, res.data, res.data_type, label);
                }
            });
        });
        $('#chart2_year_btn').on('change', function () {
            $('#chart2_month_btn').val('')
            var year = $(this).val();
            var label = $('#chart2_year_btn').data("label");
            $.ajax({
                type: 'POST',
                url: '{{ route("cancellation.graph.data") }}',
                data: { month: '', year: year, _token: '{{ csrf_token() }}', label: label },
                success: function (res) {
                    $('#seven-day-chart').remove(); // this is my <canvas> element
                    $('#chart2-container').append('<canvas id="seven-day-chart" class="chart_view" height="130"></canvas>');
                    var chartid1 = document.getElementById('seven-day-chart').getContext('2d');
                    makechart(chartid1, res.data, res.data_type, label);
                }
            });
        });
    };
</script>
<script>
    $('#state').on('change', function () {
        var state = this.value;
        $.ajax({
            url: "{{ route('count.state.city.wise') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", state: state },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    $('#city option:gt(0)').remove();
                    $.each(response.data.all_city, function (key, value) {
                        $('#city').append($("<option></option>").attr("value", value).text(value));
                    });
                    document.getElementById("total_active_agent").innerHTML = response.data.total_active_agent;
                    document.getElementById("total_booking_today").innerHTML = response.data.total_booking_today;
                    document.getElementById("total_cancelled_ticket_today").innerHTML = response.data.total_cancelled_ticket_today;
                    document.getElementById("total_onboard_agent").innerHTML = response.data.total_onboard_agent;
                    document.getElementById("total_onboard_agent_current").innerHTML = response.data.total_onboard_agent_current;
                }
            }
        });
    });
    $('#city').on('change', function () {
        var state = $('#state').val();
        var city = this.value
        $.ajax({
            url: "{{ route('count.state.city.wise') }}",
            type: "POST",
            data: { _token: "{{ csrf_token() }}", state: state, city: city },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    document.getElementById("total_active_agent").innerHTML = response.data.total_active_agent;
                    document.getElementById("total_booking_today").innerHTML = response.data.total_booking_today;
                    document.getElementById("total_cancelled_ticket_today").innerHTML = response.data.total_cancelled_ticket_today;
                    document.getElementById("total_onboard_agent").innerHTML = response.data.total_onboard_agent;
                    document.getElementById("total_onboard_agent_current").innerHTML = response.data.total_onboard_agent_current;
                }
            }
        });
    });
    
</script>
<script>
    $(function(){
        $('.date input').datepicker();
    });
</script>
<script>
    $(function(){
        $('#datepicker2 input').on('change',function() {
            var start_date = $('#datepicker input').val();
            var end_date = this.value
            
            if (start_date==null || start_date=='' || start_date==undefined) {
                alert('Please select start date first');
            }else{
                $.ajax({
                    url: "{{ route('count.date.wise') }}",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}", start_date: start_date, end_date: end_date },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 200) {
                            document.getElementById("total_active_agent").innerHTML = response.data.total_active_agent;
                            document.getElementById("total_onboard_agent").innerHTML = response.data.total_onboard_agent;
                        }
                    }
                });
            }
        });
    });
    $(function(){
        $('#datepicker input').on('change',function() {
            var start_date = this.value            
            $.ajax({
                url: "{{ route('count.date.wise') }}",
                type: "POST",
                data: { _token: "{{ csrf_token() }}", start_date: start_date},
                dataType: "json",
                success: function (response) {
                    if (response.status == 200) {
                        document.getElementById("total_active_agent").innerHTML = response.data.total_active_agent;
                        document.getElementById("total_onboard_agent").innerHTML = response.data.total_onboard_agent;
                    }
                }
            });
        });
    });

</script>
@endsection