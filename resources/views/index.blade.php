@extends('layouts.master')
@section('content')
<div class="container-fluid mw-1200 py-30">
    <div class="row">
        <div class="col-md-7">
            <div class="row">

                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(img/dm/Group-12939.svg);">
                        <img class="fbox-background" src="img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_onboard_agent }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Total Onboarded Agents</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20" style="background-image: url(img/dm/Group-12940.svg);">
                        <img class="fbox-background" src="img/icon/resolved design.svg">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_active_agent }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Active Agents</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20"
                        style="background-image: url({{asset('admin_assets/img/dm/Group-12938.svg')}});">
                        <img class="fbox-background" src="{{asset('admin_assets/img/icon/resolved design.svg')}}">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_inactive_agent }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Inactive Agents</h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary mb-20">
                        <img class="fbox-background" src="{{asset('admin_assets/img/icon/resolved design.svg')}}">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_booking_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Booked Tickets </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-danger mb-20">
                        <img class="fbox-background" src="{{asset('admin_assets/img/icon/resolved design.svg')}}">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_cancelled_ticket_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Cancelled Tickets </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fbox fbox-primary-2 mb-20"
                        style="background-image: url({{asset('admin_assets/img/dm/Group-12938.svg')}});">
                        <img class="fbox-background" src="{{asset('admin_assets/img/icon/resolved design.svg')}}">
                        <h6 class="mb-2">
                            <span class="fbox-icon">
                                <img class="w-100" src="{{asset('admin_assets/img/icon/Resolved.svg')}}">
                            </span>
                            <span class="fbox-icon-text">{{ $total_faild_transection_today }}</span>
                        </h6>
                        <h6 class="fbox-i-text">Failed Transactions </h6>
                        <!-- <h3>4123</h3> -->
                        <p class="mb-0">Current Date</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="fbox fbox-primary-2 mb-20">

                        <img class="fbox-background" src="{{asset('admin_assets/img/icon/resolved design.svg')}}">
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
                                    <select class="form-control box-head-select" id="chart1_month_btn">
                                        <option selected value="">Month</option>
                                        <option value='1'>Janaury</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select>
                                    <select class="form-control box-head-select ml-1" id="chart1_year_btn">
                                        <option selected value="">Year</option>
                                        <option value="1940">1940</option>
                                        <option value="1941">1941</option>
                                        <option value="1942">1942</option>
                                        <option value="1943">1943</option>
                                        <option value="1944">1944</option>
                                        <option value="1945">1945</option>
                                        <option value="1946">1946</option>
                                        <option value="1947">1947</option>
                                        <option value="1948">1948</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                        <option value="1954">1954</option>
                                        <option value="1955">1955</option>
                                        <option value="1956">1956</option>
                                        <option value="1957">1957</option>
                                        <option value="1958">1958</option>
                                        <option value="1959">1959</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
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
                                    <select class="form-control box-head-select" id="chart2_month_btn">
                                        <option selected value="">Month</option>
                                        <option value='1'>Janaury</option>
                                        <option value='2'>February</option>
                                        <option value='3'>March</option>
                                        <option value='4'>April</option>
                                        <option value='5'>May</option>
                                        <option value='6'>June</option>
                                        <option value='7'>July</option>
                                        <option value='8'>August</option>
                                        <option value='9'>September</option>
                                        <option value='10'>October</option>
                                        <option value='11'>November</option>
                                        <option value='12'>December</option>
                                    </select>
                                    <select class="form-control box-head-select ml-1" id="chart2_year_btn">
                                        <option selected value="">Year</option>
                                        <option value="1940">1940</option>
                                        <option value="1941">1941</option>
                                        <option value="1942">1942</option>
                                        <option value="1943">1943</option>
                                        <option value="1944">1944</option>
                                        <option value="1945">1945</option>
                                        <option value="1946">1946</option>
                                        <option value="1947">1947</option>
                                        <option value="1948">1948</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                        <option value="1954">1954</option>
                                        <option value="1955">1955</option>
                                        <option value="1956">1956</option>
                                        <option value="1957">1957</option>
                                        <option value="1958">1958</option>
                                        <option value="1959">1959</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
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

</div>
</section>
<script>
    // let data =
        //     '[{"day": "Sun", "total_booking": "10",  "pending_ticket": "20" }, {"day": "Mon", "total_booking": "20", "genral_ticket": "20", "transaction_ticket": "30", "pending_ticket": "30" }, {"day": "Thu", "total_booking": "10", "genral_ticket": "10", "transaction_ticket": "20", "pending_ticket": "20" }, {"day": "Wed", "total_booking": "15", "genral_ticket": "15", "transaction_ticket": "40", "pending_ticket": "40" }, {"day": "Thu", "total_booking": "20", "genral_ticket": "20", "transaction_ticket": "30", "pending_ticket": "30" }, {"day": "fri", "total_booking": "10", "genral_ticket": "10", "transaction_ticket": "20", "pending_ticket": "20" }]';
        // data = JSON.parse(data);
        // var day = [];
        // var total_booking = [];
        // var genral_ticket = [];
        // var transaction_ticket = [];
        // var pending_ticket = [];
        // for (var i in data) {
        //     if (i < 7) {
        //         day.push(data[i].day);
        //         total_booking.push(data[i].total_booking);
        //         genral_ticket.push(data[i].genral_ticket);
        //         transaction_ticket.push(data[i].transaction_ticket);
        //         pending_ticket.push(data[i].pending_ticket);
        //     }
        // }


        // var dconfig7 = {
        //     type: 'line',
        //     data: {
        //         labels: day,
        //         datasets: [{
        //                 type: 'line',
        //                 label: 'Total Booking',
        //                 backgroundColor: 'rgb(108 158 254 / 0%)',
        //                 borderColor: "rgb(255 206 91)",
        //                 borderWidth: 2,
        //                 pointBackgroundColor: 'rgb(255 206 91)',
        //                 pointBorderColor: 'rgb(255, 255, 255)',
        //                 pointBorderWidth: 0,
        //                 pointRadius: 0,
        //                 fill: true,
        //                 data: total_booking,
        //             },
        //             {
        //                 type: 'line',
        //                 label: 'Panding Merchant',
        //                 backgroundColor: 'rgb(108 158 254 / 10%)',
        //                 borderColor: "rgb(108 158 254)",
        //                 borderWidth: 2,
        //                 pointBackgroundColor: 'rgb(108 158 254)',
        //                 pointBorderColor: 'rgb(255, 255, 255)',
        //                 pointBorderWidth: 0,
        //                 pointRadius: 0,
        //                 fill: true,
        //                 data: pending_ticket,
        //             }
        //         ]
        //     },
        //     options: {
        //         legend: {
        //             display: false,
        //         },
        //         tooltips: {
        //             mode: 'index',
        //             intersect: false
        //         },
        //         responsive: true,
        //         scales: {
        //             xAxes: [{
        //                 beginAtZero: false,
        //                 ticks: {
        //                     autoSkip: false
        //                 },
        //                 stacked: true,
        //                 gridLines: {
        //                     display: false,
        //                     drawBorder: false,
        //                 },
        //                 ticks: {
        //                     fontFamily: "Lexend",
        //                     fontSize: 10,
        //                 }
        //             }],
        //             yAxes: [{
        //                 stacked: false,
        //                 barPercentage: 0.3,
        //                 gridLines: {
        //                     color: 'rgb(247, 250, 252)',
        //                     borderDash: [5, 2],
        //                     zeroLineColor: 'rgb(247, 250, 252)',
        //                 },
        //                 ticks: {
        //                     fontFamily: "Lexend",
        //                     fontSize: 11,
        //                 }
        //             }]
        //         }
        //     }
        // };
       
        function makechart(chartid,data_array,chartby){
            if (chartby== "year") {
                var label_array=["Jan", "Feb", "March", "April", "may","June","July","Aug","Sept","Oct","Nov","Dec" ];     
            } 
            if (chartby== "month") {
                var now = new Date();
                var no_of_day= new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
                var label_array = Array.from({length: no_of_day}, (_, index) => index + 1);
                // data_array = Array.from({length: no_of_day}, (_, index) => index + 1);
                        
            } 
            if (chartby== "week") {
                var label_array=["Sun", "Tues", "Wed", "Thrus", "Fri","Sat"]; 
                data_array=[1,2,3,4,5,6,7];
            } 
            var makechartvar = {
                type: 'line',
                data: {
                    
                    labels: label_array,
                    datasets: [
                        {
                            type: 'line',
                            label: 'Accepted update application',
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
            makechart(chartid1,booking_array,"year")

            // cancellation chart
            var chartid2 = document.getElementById('seven-day-chart').getContext('2d');
            var cancellation_array = JSON.parse('{{ $cancellation_array }}'); //php json to javascript array
            makechart(chartid2,cancellation_array,"year");
            $('#chart1_month_btn').on('change',function() {
                var month = $(this).val();
                var year = $('#chart1_year_btn').val();
                $.ajax({
                    type:'POST',
                    url:'{{ route("booking.graph.data") }}',
                    data:{month:month,year:year,_token:'{{ csrf_token() }}'},
                    success:function(res) {
                        $('#eight-month-chart').remove(); // this is my <canvas> element
                        $('#chart1-container').append('<canvas id="eight-month-chart" class="chart_view" height="130"></canvas>');
                        var chartid1 = document.getElementById('eight-month-chart').getContext('2d');
                        makechart(chartid1,res.data,res.data_type);
                    }
                });
            });
            $('#chart1_year_btn').on('change',function() {
                $('#chart1_month_btn').val('')
                var year = $(this).val();
                $.ajax({
                    type:'POST',
                    url:'{{ route("booking.graph.data") }}',
                    data:{month:'',year:year,_token:'{{ csrf_token() }}'},
                    success:function(res) {
                        $('#eight-month-chart').remove(); // this is my <canvas> element
                        $('#chart1-container').append('<canvas id="eight-month-chart" class="chart_view" height="130"></canvas>');
                        var chartid1 = document.getElementById('eight-month-chart').getContext('2d');
                        makechart(chartid1,res.data,res.data_type);
                    }
                });
            });
            $('#chart2_month_btn').on('change',function() {
                var month = $(this).val();
                var year = $('#chart1_year_btn').val();
                $.ajax({
                    type:'POST',
                    url:'{{ route("cancellation.graph.data") }}',
                    data:{month:month,year:year,_token:'{{ csrf_token() }}'},
                    success:function(res) {
                        $('#seven-day-chart').remove(); // this is my <canvas> element
                        $('#chart2-container').append('<canvas id="seven-day-chart" class="chart_view" height="130"></canvas>');
                        var chartid1 = document.getElementById('seven-day-chart').getContext('2d');
                        makechart(chartid1,res.data,res.data_type);
                    }
                });
            });
            $('#chart2_year_btn').on('change',function() {
                $('#chart2_month_btn').val('')
                var year = $(this).val();
                $.ajax({
                    type:'POST',
                    url:'{{ route("cancellation.graph.data") }}',
                    data:{month:'',year:year,_token:'{{ csrf_token() }}'},
                    success:function(res) {
                        $('#seven-day-chart').remove(); // this is my <canvas> element
                        $('#chart2-container').append('<canvas id="seven-day-chart" class="chart_view" height="130"></canvas>');
                        var chartid1 = document.getElementById('seven-day-chart').getContext('2d');
                        makechart(chartid1,res.data,res.data_type);
                    }
                });
            });
        };
</script>
@endsection