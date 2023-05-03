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
        <div class="aside">
            <div class="logo-aside-div">
                <img class="logo-img" src="{{asset('admin_assets/img/icon.png')}}">
            </div>
            <ul class="asidenav">
                <li class="active">
                    <a href="{{ url('/') }}">
                        <i class='bx bxs-home'></i>
                        <span class="">HOME</span>
                        
                    </a>
                    <span class="aside-link-name">Home</span>
                </li>
                
                
                <li class="">
                    <a href="#">
                        <i class="bx bxs-receipt"></i>
                        <span class="">REQUEST</span>
                    </a>
                    <div class="aside-link-name">
                        <a href="{{url('list-requests')}}">List of Requests</a>
                        <a href="{{url('accepted-requests')}}">List of Accepted Requests</a>
                        <a href="{{url('list-rejected-requests')}}">List of Rejected Requests</a>
                    </div>
                </li>
               
                <li>
                    <a href="">
                        <i class='bx bxs-file'></i>
                        <span class="">REPORT</span>
                    </a>
                    <div class="aside-link-name">
                        <a href="{{ url('transaction') }}">Transaction </a>
                        <a href="{{ url ('booking')}} ">Booking  </a>
                        <a href="{{ url('cancellation')}} ">Cancellation  </a>
                        <a href="{{ url('full-refund')}} ">Full Refund</a>
                        {{-- <a href="{{ url('partial-Refund')}} ">partial-Refund</a> --}}
                        {{-- <a href="{{ url('agents')}} ">agent</a> --}}
                        <a href="{{ url('partial-Refund') }} ">Partial Refund  </a>
                        <a href="{{ url('tdr')}}">TDR  </a>
                        <a href="{{ url('waiting-cancellation')}}">Waiting List Cancellation  </a>
                    </div>
                </li>
               
               
                <li>
                    <a href="#">
                        <i class='bx bxs-user-circle'></i>
                        <span class="">USER</span>
                    </a>
                    <span class="aside-link-name">Login</span>
                </li>
            </ul>
        </div>

        <!-- end sidebar -->
        <div class="has-left-nav">
            <nav class="topnav">
                <a href="" class="d-inline-block  text-center">
                    <div class="container">
                        <div class="nav-abs">
                            <span><i class="las la-phone-alt"></i> 1800 121 3468</span>
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <span><i class="las la-envelope"></i> helpdesk-https://cscsafar.in</span>
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <img class="img-fluid" src="{{asset('admin_assets/img/G20_Logo.png')}}">
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <img class="img-fluid" src="{{asset('admin_assets/img/logo-black.png')}}">
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <img class="img-fluid" src="https://trainbooking.csccloud.in/assets/img/digiindia.png">
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <img class="img-fluid" src="https://trainbooking.csccloud.in/assets/img/csc-logo.png">
                            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                            <img class="img-fluid" src="https://trainbooking.csccloud.in/assets/img/irctc-logo.png">
                        </div>
                    </div>
                </a>
            </nav>
            <nav class="navbar navbar-expand-lg  white-background">
                <div class="container-fluid">
                    <a class="navbar-brand btn-user" href="#">
                        <img src="{{asset('admin_assets/img/logo-irctc.png')}}">
                    </a>
                    <button class="navbar-toggler text-primary" type="button" data-toggle="collapse"
                        data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon navbar-toggler-style bx bx-menu"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample07">
                        <ul class="navbar-nav ml-auto">
                           
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                    aria-expanded="false">

                                    <span class="firstlatter">M</span>
                                    <span class="font-weight-bold"> &nbsp; Maurya</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <!-- <a class="dropdown-item" href="#">Another action</a> -->
                                    <a class="dropdown-item" href="#">logout</a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
     

                 @yield('content')
         




            <div class="container-fluid mw-1200 py-30">
                <div class="row">
                   
                    
                </div>
                
               
            </div>
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


   

    {{-- <script src="{{asset('admin_assets/js/jquery-3.5.1.slim.min.js')}}"></script> --}}


    {{-- datatables js start --}}

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
    
    

</body>

</html>