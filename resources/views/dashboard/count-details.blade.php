@extends('layouts.master')
@section('content')
    <section class="container-fluid mw-1200 py-30">
        <div class="box  mb-4">
            <div class="box-body">
                <div class="row">
                    <div class="col-8">
                        <h6 class="mb-0">{{ $title }}</h6>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th class="small font-weight-bold text-uppercase  " scope="col">State</th>
                            <th class="small font-weight-bold text-uppercase  " scope="col">Total</th>
                        </thead>
                        <tbody>
                            @foreach ($count_list_statewise as $cls)
                            <tr> 
                                <td>{{ $cls->stateId }}</td>
                                <td>{{ $cls->total }}</td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{$dataTable->table()}} --}}
            </div>
        </div>
    </section>
    {{-- {{$dataTable->scripts()}} --}}
@endsection
{{-- @push('scripts')
    {{$dataTable->scripts()}}
@endpush --}}
