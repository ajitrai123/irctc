@extends('layouts.master')
@section('content')
            <nav aria-label="breadcrumb background-light text-right">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Report</a></li>
                  <li class="breadcrumb-item active" aria-current="page">TDR Report  </li>
                </ol>
              </nav>

            <div class="container-fluid mw-1200 py-30">
                <div class="box  mb-4">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-0">TDR Report</h6>
                            </div>
                           
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="box-body">
                        <div class="tab-content " id="myTabContent">
                            <div class="tab-pane fade show active" id="unresolved" role="tabpanel" aria-labelledby="unresolved-tab">
                                
                                <div class="row justify-content-end">
                                    
                                    <div class="col-md-3 mb-3">
                                        <input type="text" class="form-control " placeholder="Search by CSC ID">
                                    </div>
                                   
                                    <div class="col-md-2 mb-3">
                                        <input type="date" class="form-control " placeholder="Keyword search">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <input type="date" class="form-control " placeholder="Keyword search">
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <a href="new-ticket.html" type="button" class="btn  btn-light"><i class="bx bx-download"></i></a>

                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="">
                                            <tr>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Sl no</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">CSC Id</td>
                                               
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Agent ID</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Transaction ID</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Booking Date</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Journey Date</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">PNR Number</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">TDR Application Date</td>
                                                
                                                <td class="small font-weight-bold text-uppercase  " scope="col">TDR Reason</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Response</td>
                                                
                                                <!-- <td class="small font-weight-bold text-uppercase  " scope="col">Action</td> -->
                                               
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
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
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
                    {
                        data: 'totalFare',
                        name: 'totalFare'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });


            // Export button event handler
            $('#export-btn').on('click', function() {
                // Get the table data as an array of objects
                var data = table.rows().data().toArray();
                // Extract column names from DataTable object
                var columns = table.columns().header().toArray().map(function(column) {
                    return $(column).text();
                });

                // Convert the array of objects into an array of arrays, removing any HTML tags
                var rows = data.map(function(row) {
                    var rowValues = Object.values(row);
                    var cleanRow = rowValues.map(function(value) {
                        // Remove any HTML tags from the cell value if it's a string
                        if (typeof value === 'string') {
                            var cleanValue = value.replace(/<[^>]*>/g, '');
                            return cleanValue;
                        } else {
                            return value;
                        }
                    });
                    return cleanRow;
                });

                // Insert column names as the first row
                columns.pop();
                rows.unshift(columns);

                // Create a new workbook and worksheet
                var workbook = new ExcelJS.Workbook();
                var worksheet = workbook.addWorksheet('Sheet1');

                // Add the table data to the worksheet
                worksheet.addRows(rows);
                var today = new Date();
                var filename = 'cancellation-' + today.getDate() + '-' + today.getMonth() + '-' + today.getFullYear()+'.csv';
                // Save the workbook as an Excel file
                workbook.csv.writeBuffer().then(function(buffer) {
                    saveAs(new Blob([buffer], {
                        type: 'application/octet-stream'
                    }), filename);
                    // workbook.xlsx.writeBuffer().then(function(buffer) {
                    // saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'example.xlsx');
                });
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
            console.log(typeof(other) + ", " + typeof(from_date) + ", " + typeof(to_date));
            if (other.length != 0 || from_date.length != 0 || to_date.length != 0) {
                console.log(other + ", " + from_date + ", " + to_date);
                var fromDateObj = new Date(from_date);
                var toDateObj = new Date(to_date);
                var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (diffDays > 7) {
                    alert('Please select a date range within 7 days.');
                    return false;
                }
                $('#order_table').DataTable().destroy();
                load_data(other, from_date, to_date);
            } else {
                alert('Please provide a value in the input field to search.');
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
                alert('Please select a from date first.');
                return false;
            }
            console.log(typeof(other) + ", " + typeof(from_date) + ", " + typeof(to_date));
            if (other.length != 0 || from_date.length != 0 || to_date.length != 0) {
                console.log(other + ", " + from_date + ", " + to_date);
                var fromDateObj = new Date(from_date);
                var toDateObj = new Date(to_date);
                var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (diffDays > 7) {
                    alert('Please select a date range within 7 days.');
                    return false;
                }
                $('#order_table').DataTable().destroy();
                load_data(other, from_date, to_date);
            } else {
                alert('Please provide a value in the input field to search.');
                return false;
            }
        });
        $("#from_date").change(function() {
            var other = $('#other').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            console.log(typeof(other) + ", " + typeof(from_date) + ", " + typeof(to_date));
            if (other.length != 0 || from_date.length != 0 || to_date.length != 0) {
                console.log(other + ", " + from_date + ", " + to_date);
                var fromDateObj = new Date(from_date);
                var toDateObj = new Date(to_date);
                var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (diffDays > 7) {
                    alert('Please select a date range within 7 days.');
                    return false;
                }
                $('#order_table').DataTable().destroy();
                load_data(other, from_date, to_date);
            } else {
                alert('Please provide a value in the input field to search.');
                return false;
            }
        });

    });
</script>
@endsection            
       

