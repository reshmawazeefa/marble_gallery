@extends('layouts.vertical', ["page_title"=> "Product Details"])

@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="{{url('admin/products')}}">Products</a></li>
                        <li class="breadcrumb-item active">Product Detail</li>
                    </ol>
                </div>
                <h4 class="page-title">Product Detail</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">
                    <div class="clearfix"></div>

                    <h4>{{$details->productName}}</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Product Code</td>
                                    <td>{{$details->productCode}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Tax Rate</td>
                                    <td>{{$details->taxRate}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Category</td>
                                    <td>@if($details->category) {{$details->category->categoryName}} @endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>subCategory</td>
                                    <td>{{$details->subCateg}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Type</td>
                                    <td>{{$details->type}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Brand</td>
                                    <td>{{$details->brand}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Size</td>
                                    <td>{{$details->size}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>InvUOM</td>
                                    <td>{{$details->invUOM}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>SaleUOM</td>
                                    <td>{{$details->saleUOM}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Color</td>
                                    <td>{{$details->color}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Finish</td>
                                    <td>{{$details->finish}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Thickness</td>
                                    <td>{{$details->thickness}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">13</th>
                                    <td>ConvFactor</td>
                                    <td>{{$details->conv_Factor}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">14</th>
                                    <td>SqftConvFactor</td>
                                    <td>{{$details->sqft_Conv}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">15</th>
                                    <td>Box Qty</td>
                                    <td>{{$details->boxQty}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <div class="col-xl-4 col-lg-5">
        <div class="card d-block">
            <div class="card-body">
                <div class="clearfix"></div>
                    <h4>IMAGE</h4>
                    <form action="{{url('admin/product/image')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="product_id" value="{{$details->id}}">
                        <input type="file" name="image" required id="photo">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
                        <a href="{{url('admin/products')}}"<button class="btn btn-secondary waves-effect" type="button">Cancel</button></a>
                    </form>
                    <div id="image-preview"><img width="200" id="imgPreview" src="{{request()->getSchemeAndHttpHost().'/assets/images/products/'.$details->image}}"></div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
@endsection

@section('script')
<!-- third party js -->
<script src="{{asset('assets/libs/dropzone/dropzone.min.js')}}"></script>
<!-- third party js ends -->
<script type="text/javascript">
$(document).ready(()=>{
    const photoInp = $("#photo");
    photoInp.change(function (e) {
        file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                $("#imgPreview")
                    .attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection