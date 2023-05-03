@extends('layouts.master')
@section('content')

            <nav aria-label="breadcrumb background-light text-right">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Report</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Waiting List Cancellation Report  </li>
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
                                
                                <div class="row justify-content-end">
                                    
                                    <div class="col-md-3 mb-3">
                                        <input type="text" class="form-control " placeholder="Search by CSC ID" id="other" name="other" value=""> 
                                    </div>
                                    
                                    <div class="col-md-2 mb-3 input-daterange">
                                        <input type="date" class="form-control " placeholder="Keyword search" id="from_date" name="from_date" value="" readonly/>
                                    </div>
                                    <div class="col-md-2 mb-3 input-daterange">
                                        <input type="date" class="form-control " placeholder="Keyword search" id="to_date" name="to_date" value="" readonly/>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-light"  name="filter" id="filter" title="Search"><i class="bx bx-search"></i></button>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <button type="button" id="export-btn" class="btn btn-light"><i class="bx bx-download"></i></button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table  id="order_table" class="table table-striped booking_datatable">
                                        <thead class="">
                                            <tr>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Sl no</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">CSC Id</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Agent ID</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">PNR Number</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Transaction ID</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Reservation ID</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Refund Amount</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Current Status</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Cancelled Date</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Status</td>
                                                
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Action</td> 
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            {{-- <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <a href="ticket-detail.html" class="mb-0 font-weight-bold">12345432123</a>
                                                </td>
                                                <td>
                                                   098765432
                                                </td>
                                                <td>
                                                    098765432
                                                 </td>
                                                <td>
                                                    098765432
                                                 </td>
                                                 <td>
                                                    098765432
                                                 </td>
                                                 <td>
                                                    <p class="mb-0 text-success font-weight-bold">1250</p>
                                                 </td>
                                                 <td>
                                                    <p class="mb-0 text-success font-weight-bold">Approve</p>
                                                 </td>
                                                <td>
                                                    13/12/23
                                                 </td>
                                                 <td>
                                                    
                                                 <span class="badge badge-success px-2 py-1"><i class="bx bx-check-circle text-white"></i> Success</span>

                                                 </td>
                                                 
                                            </tr> --}}
                                            
                                           
                                            
                                            
                                        </tbody>
                                    </table>
                                   
                                </div>
                                {{-- <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                  </nav> --}}
                            </div>
                          
                           
                        </div>
                    </div>
                </div>  
            </div>

            <script>
                $(document).ready(function(){
                 $('.input-daterange').datepicker({
                  todayBtn:'linked',
                  format:'yyyy-mm-dd',
                  autoclose:true
                 });
                
                 load_data();
                
                 function load_data(other = '', from_date = '', to_date = '')
                 {
                      
                var table =  $('#order_table').DataTable({
                    buttons: [
                        // 'excelHtml5',    'copy', 'excel'      
                            ],
                      dom: 'Rrtp',
                   processing: true,
                   serverSide: true,
                   ajax: {
                    url:'{{ route("index_waiting_cancellation") }}',
                    data:{other:other, from_date:from_date, to_date:to_date}
                   },
                   columns: [
                          {data: 'id', name: 'id'},
                          {data: 'cscId', name: 'cscId'},
                          {data: 'agentUserId', name: 'agentUserId'},
                          {data: 'pnrNumber', name: 'pnrNumber'},
                          {data: 'reservationId', name: 'reservationId'},
                          {data: 'reservationId', name: 'reservationId'},
                          {data: 'refundAmount' , name: 'refundAmount'},
                          {data: 'currentStatus', name: 'currentStatus'},
                          {data: 'cancellationDate', name: 'cancellationDate'},
                          {data: 'status', name: 'status'},
                          {data: 'action', name: 'action', orderable: true, searchable: true},
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
                            rows.unshift(columns);

                            // Create a new workbook and worksheet
                            var workbook = new ExcelJS.Workbook();
                            var worksheet = workbook.addWorksheet('Sheet1');

                            // Add the table data to the worksheet
                            worksheet.addRows(rows);

                            // Save the workbook as an Excel file
                            workbook.csv.writeBuffer().then(function(buffer) {
                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'example.csv');
                                // workbook.xlsx.writeBuffer().then(function(buffer) {
                                // saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'example.xlsx');
                            });
                        });


                  
                
                    $('#filter').click(function(){
                        var other = $('#other').val();
                        var from_date = $('#from_date').val();
                        var to_date = $('#to_date').val();
                        console.log(typeof(other)+", "+typeof(from_date)+", "+typeof(to_date));
                        if(other.length != 0 || from_date.length != 0 || to_date.length != 0) {
                            console.log(other+", "+from_date+", "+to_date);
                            var fromDateObj = new Date(from_date);
                            var toDateObj = new Date(to_date);
                            var timeDiff = Math.abs(toDateObj.getTime() - fromDateObj.getTime());
                            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                            if(diffDays > 7) {
                            alert('Please select a date range within 7 days.');
                            return false;
                            }
                            $('#order_table').DataTable().destroy();
                                load_data(other, from_date, to_date);
                        }else{
                            alert('Please provide a value in the input field to search.');
                            return false;
                        }
                    });


                }
                
                 $('#refresh').click(function(){
                  $('#from_date').val('');
                  $('#to_date').val('');
                  $('#order_table').DataTable().destroy();
                  load_data();
                 });
                
                });
                </script> 
    
@endsection


