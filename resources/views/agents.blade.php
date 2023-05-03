@extends('layouts.master')
@section('content')

            <nav aria-label="breadcrumb background-light text-right">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Report</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Full-Refund Report </li>
                </ol>
              </nav>





            <div class="container-fluid mw-1200 py-30">
                <div class="box  mb-4">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-0">Agents Report</h6>
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
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Master Id</td>
                                               
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Agent User Id</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Csc Id</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Request Type</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Email</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Mobile</td>
                                                <td class="small font-weight-bold text-uppercase  " scope="col">First Name</td>
                                                
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Status</td>
                                                
                                                <td class="small font-weight-bold text-uppercase  " scope="col">Action</td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            

                                            @foreach ($agent_data as $list)

                    
                                                    <tr> 
                                                        <td>{{$list->id}}</td>
                                                        <td>{{$list->masterId}}</td>
                                                        <td>{{$list->agentUserId}}</td>
                                                        <td>{{$list->cscId}}</td>
                                                        <td>{{$list->requestType}}</td>
                                                        <td>{{$list->email}}</td>
                                                        <td>{{$list->mobile}}</td>
                                                        <td>{{$list->firstName}}</td>
                                                        <td>{{$list->status}}</td>
                                                        <td>
                                                   
                                                            <a href="{{ url('view') }}" type="button" class="btn btn-light btn-sm mb-1">
                                                                <i class="bx bx-low-vision"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                    
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
                                                    5436456456
                                                 </td>
                                                 <td>
                                                    <p class="mb-0 text-success font-weight-bold">12/12/23</p>
                                                 </td>
                                                 
                                                 <td>
                                                    <span class="badge badge-success px-2 py-1"><i class="bx bx-check-circle text-white"></i> Success</span>
                                                 </td>
                                                <td>
                                                   
                                                    <a href="{{ url('view') }}" type="button" class="btn btn-light btn-sm mb-1">
                                                        <i class="bx bx-low-vision"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
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
                                                    5436456456
                                                 </td>
                                                 <td>
                                                    <p class="mb-0 text-success font-weight-bold">12/12/23</p>
                                                 </td>
                                                 
                                                 <td>
                                                    <span class="badge badge-success px-2 py-1"><i class="bx bx-check-circle text-white"></i> Success</span>
                                                 </td>
                                                <td>
                                                   
                                                    <a href="{{ url('view') }}" type="button" class="btn btn-light btn-sm mb-1">
                                                        <i class="bx bx-low-vision"></i>
                                                    </a>
                                                </td>
                                            </tr> --}}
                                            
                                            
                                        </tbody>
                                    </table>
                                   
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                  </nav>
                            </div>
                          
                           
                        </div>
                    </div>
                </div>
               
                
               
            </div>

    
@endsection
    



