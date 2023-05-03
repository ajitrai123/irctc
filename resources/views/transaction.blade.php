@extends('layouts.master')
@section('content')
<style>
    td:nth-child(5n) {  
  color:green;    
}
</style>
<nav aria-label="breadcrumb background-light text-right">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaction Report </li>
    </ol>
</nav>
<div class="container-fluid mw-1200 py-30">
    <div class="box  mb-4">
        <div class="box-body">
            <div class="row">
                <div class="col-8">
                    <h6 class="mb-0">Transaction Report </h6>
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

                    <div class="row justify-content-end">

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
                        {{-- <div class="col-sm-2">
                            <button type="submit" class="btn btn-light" name="filter" id="filter" title="Search"><i
                                    class="bx bx-search"></i></button>
                        </div> --}}
                        <div class="col-md-1 mb-3">
                            <button type="button" id="export-btn" class="btn btn-light"><i
                                    class="bx bx-download"></i></button>
                                    {{-- <a href="{{ route('transection.export') }}" class="btn btn-primary">
                                        Export Data
                                   </a> --}}
                            {{-- <button type="button" id="export-btn1" class="btn btn-light"><i class="bx bx-download"></i></button> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped booking_datatable">
                            <thead class="">
                                <tr>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Sl no</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">CSC Id</th>

                                    <th class="small font-weight-bold text-uppercase  " scope="col">Agent ID</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Transaction ID</th>

                                    <th class="small font-weight-bold text-uppercase  " scope="col">Client Transaction
                                        Amount</th>
                                    {{-- <th class="small font-weight-bold text-uppercase  " scope="col">Client Transaction
                                        Totel Fare</th> --}}
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Creation</th>
                                    <th class="small font-weight-bold text-uppercase  " scope="col">Action</th>

                                    {{-- SL NO	CSC ID	AGENT ID	TRANSACTION ID	CLIENT TRANSACTION AMOUNT	CREATION	ACTION --}}
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
    $(document).ready(function(){
        $( "#from_date" ).datepicker({
            defaultDate: "+1d",
            changeMonth: true,
            changeYear: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('hide', function() {
            var selected = $(this).val();
            $( "#to_date" ).datepicker('setStartDate', selected);
        });
        $( "#to_date" ).datepicker({
            defaultDate: "+1d",
            changeMonth: true,
            changeYear: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        }).on('hide', function() {
            var selected = $(this).val();
            $( "#from_date" ).datepicker('setEndDate', selected);
        });   
        load_data();
        function load_data(other = '', from_date = '', to_date = '') {

            var table = $('#order_table').DataTable({
                buttons: [
                    // 'excelHtml5',    'copy', 'excel'      
                ],
                dom: 'Rrtp',
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("index_transaction") }}',
                    data: {
                        other: other,
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'cscId',
                        name: 'cscId'
                    },
                    {
                        data: 'agentUserId',
                        name: 'agentUserId'
                    },
                    {
                        data: 'reqTxn',
                        name: 'reqTxn'
                    },
                    {
                        data: 'txn_amount',
                        name: 'txn_amount'
                    },
                    //   {data: 'totalFare', name: 'totalFare'},
                    {
                        data: 'created_at',
                        "render": function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear();
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
        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#order_table').DataTable().destroy();
            load_data();
        });
        $("#other").keyup(function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (other.length != 0) {
                // $('#other').val('');
                // $('#from_date').val('');
                // $('#to_date').val('');
                sessionStorage.setItem("report_id", other);
                sessionStorage.setItem("report_date", '');
                $('#order_table').DataTable().destroy();
                load_data(other, from_date, to_date);
            } else {
                $('#order_table').DataTable().destroy();
                load_data();
                return false;
            }
        });
        $("#to_date").change(function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (!from_date) {
                notify({
                    message: 'Please select a from date first.',
                    color: 'danger',
                    timeout: 5000
                });
                $('#to_date').val('');
            } else {
                if (from_date.length != 0 && to_date.length != 0) {
                    var fromDateObj = new Date(from_date);
                    var toDateObj = new Date(to_date);
                    var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    if (diffDays > 7) {
                        notify({
                            message: 'Please select a date range within 7 days.',
                            color: 'danger',
                            timeout: 5000
                        });
                        return false;
                    } else {
                        sessionStorage.setItem("report_date", from_date + '-' + to_date);
                        sessionStorage.setItem("report_id", '');
                        $('#order_table').DataTable().destroy();
                        load_data(other, from_date, to_date);
                    }
                } else {
                    notify({
                            message: 'Please select a valid date.',
                            color: 'danger',
                            timeout: 5000
                        });
                    return false;
                }
            }

        });
        $("#from_date").change(function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date.length != 0 && to_date.length != 0) {
                var fromDateObj = new Date(from_date);
                var toDateObj = new Date(to_date);
                var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (diffDays > 7) {
                    notify({
                            message: 'Please select a date range within 7 days.',
                            color: 'danger',
                            timeout: 5000
                        });
                    return false;
                } else {
                    $('#order_table').DataTable().destroy();
                    load_data(other, from_date, to_date);
                }
            }
        });
        // $('#export-btn1').on('click', function() {
        //     var other = $('#other').val();
        //     var from_date = $('#from_date').val();
        //     var to_date = $('#to_date').val();
        //     $.ajax({
        //         type:'POST',
        //         url:'{{  route("transection.export")  }}',
        //         headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //         data:{other:other,from_date:from_date,to_date:to_date},
        //         success:function(result, status, xhr) {
        //             var disposition = xhr.getResponseHeader('content-disposition');
        //             var matches = /"([^"]*)"/.exec(disposition);
        //             var filename = (matches != null && matches[1] ? matches[1] : 'transection.csv');

        //             // The actual download
        //             var blob = new Blob([result], {
        //                 type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        //             });
        //             var link = document.createElement('a');
        //             link.href = window.URL.createObjectURL(blob);
        //             link.download = filename;

        //             document.body.appendChild(link);

        //             link.click();
        //             document.body.removeChild(link);
        //             notify({
        //                 message: 'Data is exported.',
        //                 color: 'success',
        //                 timeout: 5000
        //             });
        //         }
        //     });
        // });
        // Export button event handler
        $('#export-btn').on('click', function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (other != '' || from_date != '') {
                $.ajax({
                    type:'POST',
                    url:'{{  route("transection.export")  }}',
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
                        var filename = (matches != null && matches[1] ? matches[1] : 'transection'+other+file_date+'.csv');

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
                        notify({
                            message: 'Data is exported.',
                            color: 'success',
                            timeout: 5000
                        });
                    }
                });
                // var table = $('#order_table').DataTable();
                // // Get the table data as an array of objects
                // var data = table.rows().data().toArray();
                // // Extract column names from DataTable object
                // var columns = table.columns().header().toArray().map(function(column) {
                //     return $(column).text();
                // });

                // // Convert the array of objects into an array of arrays, removing any HTML tags
                // var rows = data.map(function(row) {
                //     var rowValues = Object.values(row);
                //     var cleanRow = rowValues.map(function(value) {
                //         // Remove any HTML tags from the cell value if it's a string
                //         if (typeof value === 'string') {
                //             var cleanValue = value.replace(/<[^>]*>/g, '');
                //             return cleanValue;
                //         } else {
                //             return value;
                //         }
                //     });
                //     return cleanRow;
                // });

                // // Insert column names as the first row
                // columns.pop();
                // rows.unshift(columns);

                // // Create a new workbook and worksheet
                // var workbook = new ExcelJS.Workbook();
                // var worksheet = workbook.addWorksheet('Sheet1');

                // // Add the table data to the worksheet
                // worksheet.addRows(rows);
                // var today = new Date();
                // var report_id = sessionStorage.getItem("report_id");
                // var report_date = sessionStorage.getItem("report_date");
                // var filename = 'transection-' + report_id + '-' + report_date + '.csv';
                // // Save the workbook as an Excel file
                // workbook.csv.writeBuffer().then(function(buffer) {
                //     saveAs(new Blob([buffer], {
                //         type: 'application/octet-stream'
                //     }), filename);
                //     sessionStorage.setItem("report_date", '');
                //     sessionStorage.setItem("report_id", '');
                //     // workbook.xlsx.writeBuffer().then(function(buffer) {
                //     // saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'example.xlsx');
                // });
            } else {
                notify({
                    message: 'For exporting data please search by CSC ID or use date range filter.',
                    color: 'danger',
                    timeout: 5000
                });            }
        });
         
    });
      
</script>

@endsection