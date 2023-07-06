<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('admin_assets/css/bootstrap.min.css')}}">
   {{-- datatables start --}}
    {{-- <link rel="stylesheet" href="{{asset('admin_assets/datatables/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/datatables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/datatables/css/dataTables.bootstrap4.min.css')}}"> --}}
    <link href="{{asset('admin_assets/datatable/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/css/style-19-06-23.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/datatable/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/datatable/searchPanes.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/datatable/select.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/datatable/buttons.dataTables.min.css')}}" rel="stylesheet" media="all">

    <script src="{{asset('admin_assets/datatable/jquery-3.5.1.js')}}" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
   {{-- datatables end--}}
  <link rel="stylesheet" href="{{asset('admin_assets/css/style.css')}}">

  <link href="{{asset('admin_assets/plugin/boxicons-2.0.9/css/boxicons.min.css')}}" rel='stylesheet'>
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('admin_assets/img/favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('admin_assets/img/favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('admin_assets/img/favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin_assets/img/favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('admin_assets/img/favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('admin_assets/img/favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('admin_assets/img/favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('admin_assets/img/favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin_assets/img/favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{asset('admin_assets/img/favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin_assets/img/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin_assets/img/favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin_assets/img/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('admin_assets/img/favicon/manifest.json')}}">
  <link href="{{asset('admin_assets/css/notify.min.css')}}" rel="stylesheet">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('admin_assets/img/favicon/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">
  <title>CSC e-Governance Services India Limited</title>
  <style>
      .dataTables_wrapper .dataTables_paginate {
      float: none !important;
      }
      .dataTables_wrapper .dataTables_paginate .paginate_button {
      margin-right: 5px;
      border:0;
      }
      div.dataTables_wrapper div.dataTables_paginate ul.pagination {
          justify-content: unset;
      }
      .dataTables_wrapper .dataTables_paginate .paginate_button {
          padding: 0px !important;
          margin: 0px !important;
      }   
      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
          border: 0;
      }
  </style>
</head>

<body>

    <section class="app">
        <!-- sidebar -->

        <!-- end sidebar -->
        


            
            
           


<!--login start here-->
   
<!-- Section: Design Block -->
<section class="background-radial-gradient background-dot-pattern overflow-hidden">

  
    <div class="container px-4 py-5 px-md-5  text-lg-start my-5">
      <div class="row gx-lg-5 justify-content-center mb-5">
        
  
        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
  
          <div class="card form-container card-with-shadow bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form>
               
                <h4>Please login to your account</h4>
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" id="form3Example3" class="form-control" />
                  
                </div>
  
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" class="form-control" />
                 
                </div>
  
                <!-- Checkbox -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex">
                      <!-- Checkbox -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                      </div>
                    </div>
      
                    <div class="col-md-6 d-flex justify-content-end">
                      <!-- Simple link -->
                      <a href="#!">Forgot password?</a>
                    </div>
                  </div>
  
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block gradient-custom-2 mb-4">
                  Log In
                </button>
  
                <!-- Register buttons -->
                <div class="text-center">
                  <p>or Log in with:</p>
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  <!-- Section: Design Block -->

              <!--login content end here-->
           
              <footer class="footer mt-auto py-3 white-background">
                <div class="container-fluid d-flex justify-content-between">
                   <div>
                    <span class="text-muted text-center">Place sticky footer content here.</span>
                   </div>
                   <div>
                    <span class=" text-center text-dark">csc e-governance services india limited</span>
                   </div>
                </div>
            </footer>
        </div>
    </section>



    {{-- <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="plugin/Chart.js/dist/Chart.min.js"></script>
    <script src="plugin/Chart.js/samples/utils.js"></script> --}}
    <script src="{{asset('admin_assets/datatable/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin_assets/datatable/jquery.validate.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/jquery-3.5.1.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin_assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/dataTables.searchPanes.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/dataTables.select.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin_assets/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin_assets/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin_assets/datatable/buttons.print.min.js')}}"></script>


    



    <script src="{{asset('admin_assets/js/select2.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugin/Chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugin/Chart.js/samples/utils.js')}}"></script>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<script src="{{asset('admin_assets/js/notify.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
	window.jsPDF = window.jspdf.jsPDF;
    	var docPDF = new jsPDF();
    function print(name){
        var elementHTML = document.querySelector("#printTable");
        elementHTML.querySelector("div div div button#noprint_btn").style.display = "none";
        docPDF.html(elementHTML, {
            callback: function(docPDF) {
            docPDF.save(name);
            },
            x: 15,
            y: 15,
            width: 170,
            windowWidth: 650
        });
	
    }

</script>    

    
    

</body>

</html>