@extends('layouts.vertical', ["page_title"=> "Category Attribute | List"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Category Attributes</a></li>
                        <li class="breadcrumb-item active">Table</li>
                    </ol>
                </div>
                <h4 class="page-title">Category Attribute</h4>
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
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Category code</th>
                                <th>SubCategory</th>
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Finish</th>
                                <th>Thickness</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($cat_attributes as $cat)
                            <tr>
                                <td>{{$cat->categoryCode}}</td>
                                <td>{{$cat->subCateg}}</td>
                                <td>{{$cat->type}}</td>
                                <td>{{$cat->brand}}</td>
                                <td>{{$cat->size}}</td>
                                <td>{{$cat->color}}</td>
                                <td>{{$cat->finish}}</td>
                                <td>{{$cat->thickness}}</td>
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
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<!-- end demo js-->
@endsection