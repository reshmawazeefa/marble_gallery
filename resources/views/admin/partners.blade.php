@extends('layouts.vertical', ["page_title"=> "Partner | List"])

@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Partners</a></li>
                        <li class="breadcrumb-item active">Table</li>
                    </ol>
                </div>
                <h4 class="page-title">Partners</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <!-- <div class="text-sm-end mt-2 mt-sm-0">
                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>-->
                    </div><!-- end col-->
                    <div class="col-sm-8">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <a href="{{url('admin/partners/create')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add Partner</a>
                        </div>
                    </div>
                </div>
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Partner code</th>
                                <th>Contact number</th>
                                <th>Email</th>
                                <th>Prtner type</th>
                                <th>Alt phone</th>
                                <th>Designation</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($partners as $cust)
                            @php
                                $url = url('admin/partners/'.$cust->id);
                            @endphp
                            <tr>
                                <td>{{$cust->name}}</td>
                                <td>{{$cust->partner_code}}</td>
                                <td>{{$cust->phone}}</td>
                                <td>{{$cust->email}}</td>
                                <td>{{$cust->partner_type}}</td>
                                <td>{{$cust->alt_phone}}</td>
                                <td>{{$cust->designation}}</td>
                                <td>{{$cust->address}}</td>
                                <td>{{$cust->description}}</td>
                                <td><a class="btn btn-info" href="{{url('admin/partners/'.$cust->id.'/edit')}}"> <i class="mdi mdi-square-edit-outline"></i>Edit</a>
                                    <!--<a class="btn btn-danger" href="javascript:void(0);" onclick="open_deletemodal('{{$url}}')" class="action-icon delete-icon"><i class="mdi mdi-delete"></i>Delete</a>
                                --></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->
@endsection

@section('script')
<!-- third party js -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<!-- end demo js-->
@endsection