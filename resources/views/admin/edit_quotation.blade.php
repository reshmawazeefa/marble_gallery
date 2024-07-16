@extends('layouts.vertical', ["page_title"=> "Quotation Edit"])

@section('css')
<!-- third party css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
<!-- third party css end -->

<!-- icons -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
<!-- newly added -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
<link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<!-- /newly added -->
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
                        <li class="breadcrumb-item"><a href="{{url('admin/quotations')}}">Quotations</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Quotation</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
            @if(!empty($errors->all()))
            <p class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
            </p>
            @endif
                <form method="post" class="parsley-examples" action="{{url('admin/quotations/'.$details->id.'/update')}}">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#addCustModal"><i class="mdi mdi-plus-circle me-1"></i>Add</a>
                                            <select required name="customer" class="customerSelect form-control select2">
                                                <option value="{{$details->customer->customer_code}}">{{$details->customer->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Referral(Engineer)</label>
                                            <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#addPartModal"><i class="mdi mdi-plus-circle me-1"></i>Add</a>
                                            <select name="partner1" class="engineerSelect form-control select2">
                                                @if($details->referral1)
                                                    <option value="{{$details->referral1->partner_code}}">{{$details->referral1->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Referral(Contractor)</label>
                                            <select required name="partner2" class="contractorSelect form-control select2">
                                                @if($details->referral2)
                                                    <option value="{{$details->referral2->partner_code}}">{{$details->referral2->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Referral(Sales Executive) <span class="text-danger">*</span></label>
                                            <select required name="partner3" class="agentSelect form-control select2">
                                                @if($details->referral3)
                                                    <option value="{{$details->referral3->partner_code}}">{{$details->referral3->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                            <input required type="date" name="date" value="{{$details->DocDate}}" class="form-control flatpickr-input active" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="date" class="form-label">Due Date <span class="text-danger">*</span></label>
                                            <input required type="date" name="DueDate" value="{{$details->DueDate}}" class="form-control flatpickr-input active">
                                        </div>
                                    </div>
                                    @php
                                        $docNum = $details->DocNo;
                                        $arr = explode('-',$docNum);
                                    @endphp
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Doc Number <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">{{$arr[0]}}</span>
                                                <input required readonly type="text" class="form-control" name="docNumber" value="{{$arr[1]}}" placeholder="Doc Number" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Price List <span class="text-danger">*</span></label>
                                            <select required id="price_list" name="priceList" class="form-control select">
                                                <option>Retail Price</option>
                                                <!--<option @if($details->PriceList == "Retail Price") selected @endif>Retail Price</option>
                                                <option @if($details->PriceList == "Distributor Price") selected @endif>Distributor Price</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="referral" class="form-label">Vehicle type <span class="text-danger">*</span></label>
                                            <select required name="vehicle_type" class="form-control select">
                                                <option @if($details->VehType == "Light") selected @endif>Light</option>
                                                <option @if($details->VehType == "Heavy") selected @endif>Heavy</option>
                                                <option @if($details->VehType == "Any vehicle") selected @endif>Any vehicle</option>
                                                <option @if($details->VehType == "N/A") selected @endif>N/A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="me-3">
                                            <label for="distance" class="form-label">Distance(in km)<span class="text-danger"> @if($details->VehType != "N/A") * @endif</span></label>
                                            <input type="number" value="{{$details->Distance}}" name="km" steps="0.5" class="form-control" @if($details->VehType != "N/A") required @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- <div class="col-lg-4">
                            <div class="text-lg-end">
                                <button type="button" class="btn btn-danger waves-effect waves-light mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Order</button>
                                <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                            </div>
                        </div>end col-->
                    </div>
                    <input type="hidden" id="count" value="@if(count($details->items) > 0) {{count($details->items) - 1}} @else 0 @endif">       <div class="new-table">
                        @if(count($details->items) > 0)
                        @foreach ($details->items as $i=>$val)
                        <?php $json = json_encode($val,true); ?>
                        <div class="ech-tr" id="tr_{{$i}}">
                            <div style="display:none">
                                <span class="taxable_{{$i}}">{{$val->PriceAfterDisc}}</span>
                                <span class="discwithouttax_{{$i}}">{{$val->UnitPrice * $val->Qty}}</span>
                                <span class="tax_{{$i}}">{{$val->TaxRate}}</span></td>
                                <span class="taxamount_{{$i}}">{{$val->TaxAmount}}</span>
                                <span class="netprice_{{$i}}">{{$val->LineTotal}}</span>
                                <input type="hidden" name="LineTotal[]" class="linetotal_{{$i}}">
                                <input type="hidden" name="line_id[]" value="{{$val->id}}">
                            </div>
                            <div class="echtr-inn">
                                <div class="row">
                                    <div class="colbor col-xl-1 col-lg-1 col-md-1 col-sm-2 col-2">
                                        <div class="ech-td">
                                            <span class="btn opentr-btn"></span>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-10">
                                        <div class="ech-td">
                                            <label class="td-label">Item(s)
                                                <span id="productname_{{$i}}" class="product-name">{{$val->products->productName}}</span></label>
                                            <div class="td-value">
                                            <select id="product_{{$i}}" required onChange="set_data({{$i}})" name="product[]" class="product_{{$i}} itemSelect form-control select2">
                                                <option value="{{$val->products->productCode}}">{{$val->products->productName}}</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Quantity</label>
                                            <div class="td-value">
                                            <input min="1" type="number" id="quantity_{{$i}}" required value="{{$val->Qty}}" class="quantity_{{$i}} form-control" onkeyup="price_calc_edit({{$i}})" name="quantity[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-6">
                                        <div class="ech-td"><label class="td-label">Disc Type</label>
                                            <div class="td-value">
                                            <select id="discounttype_{{$i}}" onChange="price_calc_edit({{$i}})" name="discount_type[]" class="form-control">
                                                <option @if($val->DiscType == 'Percentage') selected @endif value="Percentage">Percentage</option>
                                                <option @if($val->DiscType == 'Amount') selected @endif value="Amount">Amount</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Disc Value</label>
                                            <div class="td-value">
                                                <input type="number" @if($val->DiscType == 'Percentage') value="{{$val->LineDiscPrcnt}}" @else value="{{round($val->PerSqftDisc * (100+$val->TaxRate)/100)}}" @endif id="discvalue_{{$i}}" step="0.0001" value="0" class="form-control" onkeyup="price_calc_edit({{$i}})" name="disc_perct[]">
                                                <input type="hidden" id="LineDiscPrice_{{$i}}" name="LineDiscPrice[]" value="{{$val->LineDiscPrice}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Area</label>
                                            <div class="td-value">
                                            <input type="text" value="{{$val->area}}" name="area[]" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">UOM</label>
                                            <div class="td-value">
                                            <span class="uom_{{$i}}">{{$val->products->invUOM}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Blocked</label>
                                            <div class="td-value">
                                            <span class="Committed_{{$i}}">@if($val->products->stock) {{$val->products->stock->blockQty}} @endif</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Unit Price</label>
                                            <div class="td-value">
                                            <span class="unitprice_{{$i}}">{{$val->UnitPrice}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">On Hand</label>
                                            <div class="td-value">
                                            <input type="hidden" name="warehouse[]" value="VNGW0002">
                                            <input type="hidden" id="stockdet_{{$i}}" value="">
                                            <input type="hidden" id="stock_{{$i}}" value="{{$json}}">
                                            <span class="onhand_{{$i}}">{{$val->products->stock->onHand}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">After Disc Price/Sqft</label>
                                            <div class="td-value">
                                            <span style="display:none;" class="discount_{{$i}}"></span>
                                            <span class="sqftamtafterdisc_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">After Disc Price/Piece</label>
                                            <div class="td-value">
                                            <span style="display:none;" class="netunitprice_{{$i}}"></span>
                                            <span class="amtafterdisc_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Sqm</label>
                                            <div class="td-value">
                                            <span class="sqm_{{$i}}">{{$val->SqmtQty}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Sqft</label>
                                            <div class="td-value">
                                            <span class="sqft_{{$i}}"><span class="sqft_{{$i}}">{{$val->SqftQty}}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Price/Sqft</label>
                                            <div class="td-value">
                                            <span class="sqftprice_{{$i}}">@if(!$val->SqftQty) {{round($val->LineTotal,2)}} @else {{round($val->LineTotal / $val->SqftQty,2)}} @endif</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Line Total</label>
                                            <div class="td-value">
                                            <span class="linetotal_{{$i}}">{{$val->LineTotal}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div class="actn-td">
                                <a href="javascript:void(0);" class="action-icon add-item"></a>
                                <a href="javascript:void(0);" class="action-icon delete-item"></a>
                            </div>
                        </div>

                        @endforeach
                        @else
                        @for ($i = 0; $i < 1; $i++)
                        <div class="ech-tr" id="tr_{{$i}}">
                            <div style="display:none">
                                <span class="taxable_{{$i}}"></span>
                                <span class="discwithouttax_{{$i}}"></span>
                                <span class="tax_{{$i}}"></span>
                                <span class="taxamount_{{$i}}"></span>
                                <span class="netprice_{{$i}}"></span>
                                <input type="hidden" name="LineTotal[]" class="linetotal_{{$i}}">
                                <input type="hidden" name="line_id[]" value="-1">
                            </div>
                            <div class="echtr-inn">
                                <div class="row">
                                    <div class="colbor col-xl-1 col-lg-1 col-md-1 col-sm-2 col-2">
                                        <div class="ech-td">
                                            <span class="btn opentr-btn"></span>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-10">
                                        <div class="ech-td">
                                            <label class="td-label">Item(s)<span id="productname_{{$i}}" class="product-name"></span></label></label>
                                            <div class="td-value">
                                            <select id="product_{{$i}}" required onChange="set_data({{$i}})" name="product[]" class="product_{{$i}} itemSelect form-control select2">
                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Quantity</label>
                                            <div class="td-value">
                                            <input min="1" type="number" id="quantity_{{$i}}" required class="quantity_{{$i}} form-control" onkeyup="price_calc({{$i}})" name="quantity[]">
                                        
                                            </div>
                                        </div>
                                    </div>                                
                                    
                                    <div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-6">
                                        <div class="ech-td"><label class="td-label">Disc Type</label>
                                            <div class="td-value">
                                            <select id="discounttype_{{$i}}" onChange="price_calc({{$i}})" name="discount_type[]" class="form-control">
                                                <option value="Amount">Amount</option>
                                                <option value="Percentage">Percentage</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Disc Value</label>
                                            <div class="td-value">
                                                <input type="number" id="discvalue_{{$i}}" step="0.0001" value="0" class="form-control" onkeyup="price_calc({{$i}})" name="disc_perct[]">
                                                <input type="hidden" id="LineDiscPrice_{{$i}}" name="LineDiscPrice[]" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Area</label>
                                            <div class="td-value">
                                            <input type="text" name="area[]" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">UOM</label>
                                            <div class="td-value">
                                            <span class="uom_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Blocked</label>
                                            <div class="td-value">
                                            <span class="Committed_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Unit Price</label>
                                            <div class="td-value">
                                            <span class="unitprice_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">On Hand</label>
                                            <div class="td-value">
                                            <input type="hidden" name="warehouse[]" value="VNGW0002">
                                            <input type="hidden" id="stockdet_{{$i}}" value=""><span class="onhand_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">After Disc Price/Sqft</label>
                                            <div class="td-value">
                                            <span style="display:none;" class="discount_{{$i}}"></span>
                                            <span class="sqftamtafterdisc_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">After Disc Price/Piece</label>
                                            <div class="td-value">
                                            <span style="display:none;" class="netunitprice_{{$i}}"></span>
                                            <span class="amtafterdisc_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Sqft</label>
                                            <div class="td-value">
                                            <span class="sqft_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Sqm</label>
                                            <div class="td-value">
                                            <span class="sqm_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Price/Sqft</label>
                                            <div class="td-value">
                                            <span class="sqftprice_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">
                                        <div class="ech-td">
                                            <label class="td-label">Line Total</label>
                                            <div class="td-value">
                                            <span class="linetotal_{{$i}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                            <div class="actn-td">
                                <a href="javascript:void(0);" class="action-icon add-item"></a>
                                <a href="javascript:void(0);" class="action-icon delete-item"></a>
                            </div>
                        </div>
                        @endfor
                        @endif
                    </div>

                    <div class="specarea">
                        <input value="0" type="hidden" name="discount_amount">
                        <input value="0" type="hidden" name="tax_amount">
                        <input value="0" type="hidden" name="grand_total">
                        <!--<ul>
                            <li><h6>Total Quantity</h6></li>
                            <li><p id="tot_qty"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Total sqm</h6></li>
                            <li><p id="tot_sqm"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Total sqft</h6></li>
                            <li><p id="tot_sqft"></p></li>
                        </ul>-->
                        <ul>
                            <li><h6>Total Amount</h6></li>
                            <li><p id="total_amount"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Discount </h6></li>
                            <li><p id="discount_amount"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Tax</h6></li>
                            <li><p id="tax_amount"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Freight charges</h6></li>
                            <li><p id="freight"><input type="number" step="0.5" value="{{$details->FreightCharge}}" name="FreightCharge" onkeyup="calculate_footer();" id="freight_charge" class="form-control"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Loading charges</h6></li>
                            <li><p id="loading"><input type="number" value="{{$details->LoadingCharge}}" step="0.5" name="LoadingCharge" onkeyup="calculate_footer();" id="loading_charge" class="form-control"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Unloading charges</h6></li>
                            <li><p id="unloading"><input type="number" value="{{$details->UnloadingCharge}}" step="0.5" name="UnloadingCharge" onkeyup="calculate_footer();" id="unloading_charge" class="form-control"></p></li>
                        </ul>
                        <ul>
                            <li><h6>Grand Total</h6></li>
                            <li><p id="grand_total"></p></li>
                        </ul>
                    </div>
                    <div>&nbsp;</div>
                    <input placeholder="Remarks" type="text" value="{{$details->Remarks}}" name="remarks" class="form-control"> 
                    <div>&nbsp;</div>
                    <div class="col-sm-12">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    @include('includes.modal_popups')
</div> <!-- container -->
@endsection

@section('script')
<!-- third party js -->
<script src="{{asset('assets/js/jsmartable.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/quill/quill.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<!-- end demo js-->
<!-- demo app -->
<!-- end demo js-->
<script>
    $(document).ready(function() {
        $('#sepBilling').change(function(){
            if($('#sepBilling').is(':checked'))
            {
                $('select[name=prefixBilling').val($('select[name=prefix').val());
                $('input[name=addressIDBilling').val($('input[name=addressID').val());
                $('input[name=addressBilling').val($('input[name=address').val());
                $('input[name=address2Billing').val($('input[name=address2').val());
                $('input[name=placeBilling').val($('input[name=place').val());
                $('input[name=zip_codeBilling').val($('input[name=zip_code').val());
                $('input[name=stateBilling').val($('input[name=state').val());
                $('input[name=countryBilling').val($('input[name=country').val());
            }
            else{                
            }
        });
        $('select[name=vehicle_type]').change(function(){
            if(this.value == 'N/A')
            {
                $('input[name=km]').attr('required', false);
                $('label[for=distance] span[class=text-danger]').html('');
            }
            else{
                $('input[name=km]').attr('required', true);
                $('label[for=distance] span[class=text-danger]').html('*');
            }
        });

        $.ajax({
           type:'POST',
           url:"{{ url('admin/code') }}",
           data:{_token: "{{ csrf_token() }}",type:'partner'},
           success:function(data){
              $('#partner_code').val(data);
           }
        });
        $.ajax({
           type:'POST',
           url:"{{ url('admin/code') }}",
           data:{_token: "{{ csrf_token() }}",type:'customer'},
           success:function(data){
              $('#customer_code').val(data);
           }
        });

        //$(".itemSelect").select2();

        load_product();
        var c = parseInt($('#count').val())+1;

        for(i=0; i<c; i++)
        {
            set_data_edit(i);
        }

        //calculate_footer();

        $(".customerSelect").select2({
            ajax: {
            url: "{{ url('admin/ajax/customers') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.name+'('+item.phone+')',
                            id: item.customer_code
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,phone",
                allowClear: false,
        });

        $(".engineerSelect").select2({
            ajax: {
            url: "{{ url('admin/ajax/partners/engineer') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.name+'('+item.phone+')',
                            id: item.partner_code,
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,phone",
                allowClear: false,
        });

        $(".contractorSelect").select2({
            ajax: {
            url: "{{ url('admin/ajax/partners/contractor') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.name+'('+item.phone+')',
                            id: item.partner_code,
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,phone",
                allowClear: false,
        });

        $(".agentSelect").select2({
            ajax: {
            url: "{{ url('admin/ajax/partners/Sales Executive') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.name+'('+item.phone+')',
                            id: item.partner_code,
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,phone",
                allowClear: false,
        });
    });
    $(document ).on("click",".add-item",function()
    {
        var val = parseInt($("#count").val())+1;
        $("#count").val(val);
        var html = '<div class="ech-tr" id="tr_'+val+'">'
                            +'<div style="display:none">'
                                +'<span class="taxable_'+val+'"></span><span class="discwithouttax_'+val+'"></span><span class="tax_'+val+'"></span>'
                                +'<span class="taxamount_'+val+'"></span><span class="netprice_'+val+'"></span>'
                                +'<input type="hidden" name="line_id[]" value="-1">'
                                +'<input type="hidden" name="LineTotal[]" class="linetotal_'+val+'">'
                            +'</div>'
                            +'<div class="echtr-inn">'
                                +'<div class="row">'
                                    +'<div class="colbor col-xl-1 col-lg-1 col-md-1 col-sm-2 col-2">'
                                        +'<div class="ech-td">'
                                            +'<span class="btn opentr-btn"></span>'
                                        +'</div>'
                                    +'</div>'
                                    +'<div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-10">'
                                        +'<div class="ech-td">'
                                            +'<label class="td-label">Item(s)<span id="productname_'+val+'" class="product-name"></span></label></label>'
                                            +'<div class="td-value">'
                                            +'<select id="product_'+val+'" required onChange="set_data('+val+')" name="product[]" class="product_'+val+' itemSelect form-control select2">'
                                    +'</select>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>'
                                    +'<div class="colbor col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">'
                                        +'<div class="ech-td">'
                                            +'<label class="td-label">Quantity</label>'
                                            +'<div class="td-value">'
                                            +'<input min="1" type="number" id="quantity_'+val+'" required class="quantity_'+val+' form-control" onkeyup="price_calc('+val+')" name="quantity[]">'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-3 col-lg-4 col-md-4 col-sm-5 col-6">'
                                            +'<div class="ech-td"><label class="td-label">Disc Type</label>'
                                            +'<div class="td-value">'
                                            +'<select id="discounttype_'+val+'" onChange="price_calc('+val+')" name="discount_type[]" class="form-control">'
                                            +'<option value="Amount">Amount</option>'
                                            +'<option value="Percentage">Percentage</option>'
                                            +'</select>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Disc Value</label>'
                                            +'<div class="td-value">'
                                            +'<input type="number" id="discvalue_'+val+'" step="0.0001" value="0" class="form-control" onkeyup="price_calc('+val+')" name="disc_perct[]">'
                                            +'<input type="hidden" id="LineDiscPrice_'+val+'" name="LineDiscPrice[]" value="0">'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Area</label>'
                                            +'<div class="td-value">'
                                            +'<input type="text" name="area[]" class="form-control" value="">'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">UOM</label>'
                                            +'<div class="td-value">'
                                            +'<span class="uom_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Blocked</label>'
                                            +'<div class="td-value">'
                                            +'<span class="Committed_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Unit Price</label>'
                                            +'<div class="td-value">'
                                            +'<span class="unitprice_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">On Hand</label>'
                                            +'<div class="td-value">'
                                            +'<input type="hidden" name="warehouse[]" value="VNGW0002">'
                                            +'<input type="hidden" id="stockdet_'+val+'" value=""><span class="onhand_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">After Disc Price/Sqft</label>'
                                            +'<div class="td-value">'
                                            +'<span style="display:none;" class="discount_'+val+'"></span>'
                                            +'<span class="sqftamtafterdisc_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">After Disc Price/Piece</label>'
                                            +'<div class="td-value">'
                                            +'<span style="display:none;" class="netunitprice_'+val+'"></span>'
                                            +'<span class="amtafterdisc_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Sqft</label>'
                                            +'<div class="td-value">'
                                            +'<span class="sqft_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Sqm</label>'
                                            +'<div class="td-value">'
                                            +'<span class="sqm_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Price/Sqft</label>'
                                            +'<div class="td-value">'
                                            +'<span class="sqftprice_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'<div class="colbor col-xl-2 col-lg-2 col-md-2 col-sm-4 col-6">'
                                            +'<div class="ech-td">'
                                            +'<label class="td-label">Line Total</label>'
                                            +'<div class="td-value">'
                                            +'<span class="linetotal_'+val+'"></span>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'
                                            +'</div>'                
                                            +'<div class="actn-td">'
                                            +'<a href="javascript:void(0);" class="action-icon add-item"></a>'
                                            +'<a href="javascript:void(0);" class="action-icon delete-item"></a>'
                                            +'</div>'
                                            +'</div>';
        //$('.new-table .ech-tr:last').after(html);
        $(this).closest(".ech-tr").after(html);
        load_product();
    });

    $(document ).on("click",".delete-item",function() {
        if($('div .ech-tr').length == 1)
        {
            var val = parseInt($("#count").val())+1;
            $("#count").val(val);
            $(".add-item").click();
        }
        $(this).closest('.ech-tr').remove();
        calculate_footer();
    });

    function load_product()
    {       
        $(".itemSelect").select2({
            ajax: {
            url: "{{ url('admin/ajax/products') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.productName,
                            id: item.productCode
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,item code",
                allowClear: false,
        });
    }

    function load_warehouse(val)
    {
       var row = val.id;
       var result = row.split('_');
       var r = result[1];
       var product_id = '.product_'+r;
       var warehouse_id = '.warehouse_'+r;
       var productCode = $(product_id+' option:selected').val(); //alert(productCode);
       $(warehouse_id).select2({
            ajax: {
            url: "{{ url('admin/ajax/stock') }}",
            type: 'POST',
                    dataType: 'json',
                    delay: 250,
                data: function(params) {
                    return {
                        _token: "{{ csrf_token() }}",
                        q: params.term, // search term
                        productCode: productCode, // prod term
                        page: params.page || 1
                    };
                    },
            processResults: function (data,params) {
                params.current_page = params.current_page || 1;
                return {
                results:  $.map(data.data, function (item) {
                        return {
                            text: item.warehouse.whsName,
                            id: item.whsCode
                        }
                    }),
                        /*  pagination: {
                            more: (params.current_page * 30) < data.total
                        } */
                        pagination: data.pagination
                };
            },
                autoWidth: false,
            cache: true
            },
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: "By searching name,warehouse code",
                allowClear: false,
        });

        if($('#quantity_'+r).val() != 0)
        {            
            $('#quantity_'+r).val(0);

            price_calc(r);
        }
    }

    function set_data(r)
    {
        var product_id = '#product_'+r;
        var warehouse_id = '.warehouse_'+r;
        var stock_det = '#stockdet_'+r;
        var uom_id = '.uom_'+r;
        var onhand_id = '.onhand_'+r;
        var Committed_id = '.Committed_'+r;
        var unitprice_id = '.unitprice_'+r;
        var tax_id = '.tax_'+r;
        var discount_id = '.discount_'+r;
        var netunitprice_id = '.netunitprice_'+r;
        var sqftprice_id = '.sqftprice_'+r;
        var productname_id = '#productname_'+r;
        var whsCode = "VNGW0002";
        var productCode = $(product_id+' option:selected').val();
        var price_list = $('#price_list option:selected').val();
        $.ajax({
            url: "{{ url('admin/ajax/product_stock') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                whsCode: whsCode,
                productCode: productCode,
                price_list: price_list,
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                $(stock_det).val(JSON.stringify(data));
                var sqft_price = (data.price_list.price*((100+parseFloat(data.product.taxRate))/100)/data.product.sqft_Conv).toFixed(2);
                $(onhand_id).html(data.onHand);
                $(Committed_id).html(data.blockQty);
                $(uom_id).html(data.product.invUOM);
                $(unitprice_id).html(data.price_list.price);
                $(netunitprice_id).html(data.price_list.price);
                $(sqftprice_id).html(sqft_price);
                $(discount_id).html(0);
                $(tax_id).html(data.product.taxRate);
                $(productname_id).html(data.product.productName);
                price_calc(r);
            }
        });
    }    

    function set_data_edit(r)
    {
        var product_id = '#product_'+r;
        var warehouse_id = '.warehouse_'+r;
        var stock_det = '#stockdet_'+r;
        var stockd = '#stock_'+r;
        var uom_id = '.uom_'+r;
        var onhand_id = '.onhand_'+r;
        var Committed_id = '.Committed_'+r;
        var unitprice_id = '.unitprice_'+r;
        var tax_id = '.tax_'+r;
        var discount_id = '.discount_'+r;
        var netunitprice_id = '.netunitprice_'+r;
        var sqftprice_id = '.sqftprice_'+r;
        var productname_id = '#productname_'+r;
        var whsCode = "VNGW0002";
        var productCode = $(product_id+' option:selected').val();
        var price_list = $('#price_list option:selected').val();
        var stock = JSON.parse($(stockd).val());
        //console.log(stock);
        $.ajax({
            url: "{{ url('admin/ajax/product_stock') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                whsCode: whsCode,
                productCode: productCode,
                price_list: price_list,
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                $(stock_det).val(JSON.stringify(data));
                $(onhand_id).html(data.onHand);
                $(Committed_id).html(data.blockQty);
                $(uom_id).html(data.product.invUOM);
                var sqft_Conv = data.product.sqft_Conv;
                var sqft_price = (stock.UnitPrice*((100+parseFloat(stock.TaxRate))/100)/sqft_Conv).toFixed(2);
                $(unitprice_id).html(stock.UnitPrice);
                $(netunitprice_id).html(stock.UnitPrice);
                $(sqftprice_id).html(sqft_price);
                $(discount_id).html(0);
                $(tax_id).html(stock.TaxRate);
                $(productname_id).html(data.product.productName);
                price_calc_edit(r);
            }
        });       
        
    }

    function price_calc(r)
    {
        var stock_det = '#stockdet_'+r;
        var discvalue_id = '#discvalue_'+r;
        var taxable_id = '.taxable_'+r;
        var discwithouttax_id = '.discwithouttax_'+r;
        var netunitprice_id = '.netunitprice_'+r;
        var unitprice_id = '.unitprice_'+r;
        var quantity_id = '#quantity_'+r;
        var taxamount_id = '.taxamount_'+r;
        var linetotal_id = '.linetotal_'+r;
        var uom_id = '.uom_'+r;
        var netprice_id = '.netprice_'+r;
        var sqm_id = '.sqm_'+r;
        var sqft_id = '.sqft_'+r;
        var discount_id = '.discount_'+r;
        var discounttype_id = '#discounttype_'+r;
        var LineDiscPrice_id = '#LineDiscPrice_'+r;
        var stock_array = JSON.parse($(stock_det).val());
        var sqftprice_id = '.sqftprice_'+r;
        //console.log(stock_array);        
        var quantity = $(quantity_id).val();
        var taxRate = parseFloat(stock_array.product.taxRate);     
        var unitprice = parseFloat(stock_array.price_list.price)*(100+taxRate)/100;
        unitprice = parseFloat(unitprice.toFixed(2));
        var uom = stock_array.product.invUOM;
        var sqmConvFac = parseFloat(stock_array.product.conv_Factor);
        if(sqmConvFac == 0)
            sqmConvFac = 1;
        var sqm = quantity * sqmConvFac;
        var sqftConvFac = parseFloat(stock_array.product.sqft_Conv).toFixed(3);
        if(sqftConvFac == 0)
            sqftConvFac = 1;
        var sqft = quantity * sqftConvFac;
        var netprice =  unitprice * quantity;//parseFloat($(sqftprice_id).html()) * sqft;
        $(netprice_id).html(netprice.toFixed(2)); 
        var disc = parseFloat($(discvalue_id).val());
        var discount = 0;  var unitdiscount = 0;
        var price_without_tax = parseFloat(stock_array.price_list.price) * quantity;
        var discou_without_tax = 0;
        if(disc)
        {
            if($(discounttype_id).val() == 'Percentage')
            {
                var unitdiscount = stock_array.price_list.price * disc/100 ;
                discount = unitdiscount * quantity * (100+taxRate)/100;
            }
            else
            { 
                discou_without_tax = (disc/((100+taxRate)/100)) * sqftConvFac * quantity;
                price_without_tax = price_without_tax - discou_without_tax;
                discount = discou_without_tax * (100+taxRate)/100;
            }
            discount = (discount/quantity).toFixed(2);
            discount = parseFloat(discount) * quantity;
            netprice = netprice - discount;
        }
        var sqftamtafterdisc = netprice/(sqftConvFac * quantity);
        var sqftamtafterdisc_id = '.sqftamtafterdisc_'+r;
        $(sqftamtafterdisc_id).html(sqftamtafterdisc.toFixed(4));
        //netprice = parseFloat(sqftamtafterdisc.toFixed(2)) * parseFloat(sqft.toFixed(2));
        var amtafterdisc = netprice/quantity; 
        var amtafterdisc_id = '.amtafterdisc_'+r;
        $(amtafterdisc_id).html(amtafterdisc.toFixed(2));
        netprice = parseFloat(amtafterdisc.toFixed(2)) * quantity;
        //$(netprice_id).html(price_without_tax.toFixed(2));
        $(taxable_id).html(price_without_tax.toFixed(2)); 
        $(LineDiscPrice_id).val(discount.toFixed(2));   
        $(discwithouttax_id).html(discou_without_tax.toFixed(2));     
        $(discount_id).html(discount.toFixed(2));
        var netunitprice = stock_array.price_list.price;//unitprice - unitdiscount;
        $(netunitprice_id).html(netunitprice.toFixed(2));
        $(unitprice_id).html(unitprice.toFixed(2));
        var taxamount = netprice * taxRate/100;
        $(taxamount_id).html(taxamount.toFixed(2));
        var linetotal = netprice;
        $(linetotal_id).html(linetotal.toFixed(2));
        $(linetotal_id).val(linetotal.toFixed(2));
        $(uom_id).html(uom);

        $(sqm_id).html(sqm.toFixed(2));
        $(sqft_id).html(sqft.toFixed(2));
        
        calculate_footer();
    }

    function price_calc_edit(r)
    {
        var stock_det = '#stockdet_'+r;
        var stock = '#stock_'+r;
        var discvalue_id = '#discvalue_'+r;
        var taxable_id = '.taxable_'+r;
        var discwithouttax_id = '.discwithouttax_'+r;
        var netunitprice_id = '.netunitprice_'+r;
        var unitprice_id = '.unitprice_'+r;
        var quantity_id = '#quantity_'+r;
        var taxamount_id = '.taxamount_'+r;
        var linetotal_id = '.linetotal_'+r;
        var uom_id = '.uom_'+r;
        var netprice_id = '.netprice_'+r;
        var sqm_id = '.sqm_'+r;
        var sqft_id = '.sqft_'+r;
        var discount_id = '.discount_'+r;
        var discounttype_id = '#discounttype_'+r;
        var LineDiscPrice_id = '#LineDiscPrice_'+r;
        var stock = JSON.parse($(stock).val());
        var stock_array = JSON.parse($(stock_det).val());
        var sqftprice_id = '.sqftprice_'+r;
        console.log(stock);        
        var quantity = $(quantity_id).val();
        var taxRate = parseFloat(stock.TaxRate);     
        var unitprice = parseFloat(stock.UnitPrice)*(100+taxRate)/100;
        unitprice = parseFloat(unitprice.toFixed(2));
        var uom = stock_array.product.invUOM;
        var sqmConvFac = parseFloat(stock_array.product.conv_Factor);
        if(sqmConvFac == 0)
            sqmConvFac = 1;
        var sqm = quantity * sqmConvFac;
        var sqftConvFac = parseFloat(stock_array.product.sqft_Conv).toFixed(3);
        if(sqftConvFac == 0)
            sqftConvFac = 1;
        var sqft = quantity * sqftConvFac;
        var netprice =  unitprice * quantity;//parseFloat($(sqftprice_id).html()) * sqft;
        $(netprice_id).html(netprice.toFixed(2)); 
        var disc = parseFloat($(discvalue_id).val());
        var discount = 0;  var unitdiscount = 0;
        var price_without_tax = parseFloat(stock.UnitPrice) * quantity;
        var discou_without_tax = 0;
        if(disc)
        {
            if($(discounttype_id).val() == 'Percentage')
            {
                var unitdiscount = stock.UnitPrice * disc/100 ;
                discount = unitdiscount * quantity * (100+taxRate)/100;
            }
            else
            { 
                discou_without_tax = (disc/((100+taxRate)/100)) * sqftConvFac * quantity;
                price_without_tax = price_without_tax - discou_without_tax;
                discount = discou_without_tax * (100+taxRate)/100;
            }
            discount = (discount/quantity).toFixed(2);
            discount = parseFloat(discount) * quantity;
            netprice = netprice - discount;
        }
        var sqftamtafterdisc = netprice/(sqftConvFac * quantity);
        var sqftamtafterdisc_id = '.sqftamtafterdisc_'+r;
        $(sqftamtafterdisc_id).html(sqftamtafterdisc.toFixed(4));
        //netprice = parseFloat(sqftamtafterdisc.toFixed(2)) * parseFloat(sqft.toFixed(2));
        var amtafterdisc = netprice/quantity; 
        var amtafterdisc_id = '.amtafterdisc_'+r;
        $(amtafterdisc_id).html(amtafterdisc.toFixed(2));
        netprice = parseFloat(amtafterdisc.toFixed(2)) * quantity;
        //$(netprice_id).html(price_without_tax.toFixed(2));
        $(taxable_id).html(price_without_tax.toFixed(2)); 
        $(LineDiscPrice_id).val(discount.toFixed(2));   
        $(discwithouttax_id).html(discou_without_tax.toFixed(2));     
        $(discount_id).html(discount.toFixed(2));
        var netunitprice = parseFloat(stock.UnitPrice);//unitprice - unitdiscount;
        $(netunitprice_id).html(netunitprice.toFixed(2));
        $(unitprice_id).html(unitprice.toFixed(2));
        var taxamount = netprice * taxRate/100;
        $(taxamount_id).html(taxamount.toFixed(2));
        var linetotal = netprice;
        $(linetotal_id).html(linetotal.toFixed(2));
        $(linetotal_id).val(linetotal.toFixed(2));
        $(uom_id).html(uom);

        $(sqm_id).html(sqm.toFixed(2));
        $(sqft_id).html(sqft.toFixed(2));
        
        calculate_footer();
    }

    function calculate_footer()
    {
        var count = $('#count').val();
        let total = 0; let tot_qty = 0; let tot_sqm = 0; let tot_sqft = 0; let tot_disc = 0;let tax_amount = 0;
        let freight_charge = 0; let loading_charge = 0; let unloading_charge = 0;
        for(var i = 0; i <= count; i++)
        {
            /*var taxable_id = '.taxable_'+i;
            if($(taxable_id).html())
                total = total+parseFloat($(taxable_id).html());

            var discwithouttax_id = '.discwithouttax_'+i;
            if($(discwithouttax_id).html())
                total = total+parseFloat($(discwithouttax_id).html());*/

            var netprice_id = '.netprice_'+i;
            if($(netprice_id).html())
                total = total+parseFloat($(netprice_id).html());

            var quantity_id = '#quantity_'+i;
            if($(quantity_id).val())
                tot_qty = tot_qty + parseInt($(quantity_id).val());

            var sqm_id = '.sqm_'+i;
            if($(sqm_id).html())
                tot_sqm = tot_sqm + parseFloat($(sqm_id).html());

            var sqft_id = '.sqft_'+i;
            if($(sqft_id).html())
                tot_sqft = tot_sqft + parseFloat($(sqft_id).html()); 
            
            var discwithouttax_id = '.discwithouttax_'+i;
            /*if($(discwithouttax_id).html())
                tot_disc = tot_disc + parseFloat($(discwithouttax_id).html()); */
            var discount_id = '.discount_'+i;
            if($(discount_id).html())
                tot_disc = tot_disc + parseFloat($(discount_id).html());

            var taxable_id = '.taxable_'+i;
            var tax_id = '.tax_'+i;
            var taxable = 0; var netprice = 0;
            if($(taxable_id).html())
            {
                taxable = parseFloat($(taxable_id).html());
            }
            if($(tax_id).html())
            {
                var taxpercent = parseFloat($(tax_id).html());
                tax_amount = tax_amount + taxable * taxpercent/100;
            }

        }

        $('#tot_qty').html(tot_qty.toFixed(2));

        $('#tot_sqm').html(tot_sqm.toFixed(2));

        $('#tot_sqft').html(tot_sqft.toFixed(2));

        $('#total_amount').html(total.toFixed(2));

        $('#discount_amount').html(tot_disc.toFixed(2));

        $('input[name=discount_amount]').val(tot_disc.toFixed(2));

        $('#tax_amount').html(tax_amount.toFixed(2));

        if($('#freight_charge').val())
            freight_charge = parseFloat($('#freight_charge').val());

        if($('#loading_charge').val())
            loading_charge = parseFloat($('#loading_charge').val());

        if($('#unloading_charge').val())
            unloading_charge = parseFloat($('#unloading_charge').val());

        var grand_total = total-tot_disc+freight_charge+loading_charge+unloading_charge;
        $('#grand_total').html(grand_total.toFixed(0));
        $('input[name=tax_amount]').val(tax_amount.toFixed(2));
        $('input[name=grand_total]').val(grand_total.toFixed(2));

        //applydiscount(0);
    }

    function applydiscount(val=0)
    {
        var discount_amount = $('#total_amount').html() * val/100;
        //$('#discount_amount').html(discount_amount);
        var count = $('#count').val();
        var tax_amount = 0;
        for (let i = 0; i <= count; i++) 
        {
            var taxable_id = '.taxable_'+i;
            var netprice_id = '.netprice_'+i;
            var tax_id = '.tax_'+i;
            var taxable = 0; var netprice = 0;
            if($(taxable_id).html())
            {
                taxable = parseFloat($(taxable_id).html());
                netprice = taxable - taxable * val/100;
            }
            if($(tax_id).html())
            {
                var taxpercent = parseFloat($(tax_id).html());
                tax_amount = tax_amount + netprice * taxpercent/100;
            }
            $(netprice_id).html(netprice);
        }
        //$('#discount_amount').html(discount_amount.toFixed(2));
        $('#tax_amount').html(tax_amount.toFixed(2));
        var grand_total = $('#total_amount').html()-discount_amount+tax_amount;
        $('#grand_total').html(grand_total.toFixed(2));
        $('input[name=tax_amount]').val(tax_amount.toFixed(2));
        $('input[name=grand_total]').val(grand_total.toFixed(2));
    }

    $("#customer-form").submit(function(e){
        e.preventDefault();
        if($('input[name=phone').val() == $('input[name=alt_phone').val())
        {
            alert("Phone and Alt phone should not be same.");
            return false;
        }
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type:'POST',
            data: form.serialize(),
            success: function(data) {
                $('.alert').html('');
                $(".alert").css('display','block');
                if($.isEmptyObject(data.error)){
                    $('.alert').html(data.success);
                    $('#customer-form').trigger("reset");
                    $.ajax({
                        type:'POST',
                        url:"{{ url('admin/code') }}",
                        data:{_token: "{{ csrf_token() }}",type:'customer'},
                        success:function(data){
                            $('#customer_code').val(data);
                        }
                    });
                    setTimeout(function() {$('#addCustModal').modal('hide');}, 2000);
                }else{
                    $('.alert').html(data.error);
                }
            }
        });
    
    });

    $("#partner-form").submit(function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type:'POST',
            data: form.serialize(),
            success: function(data) {
                $('.alert-part').html('');
                $(".alert-part").css('display','block');
                if($.isEmptyObject(data.error)){
                    $('.alert-part').html(data.success);
                    $('#partner-form').trigger("reset");
                    $.ajax({
                        type:'POST',
                        url:"{{ url('admin/code') }}",
                        data:{_token: "{{ csrf_token() }}",type:'partner'},
                        success:function(data){
                            $('#partner_code').val(data);
                        }
                    });
                    setTimeout(function() {$('#addPartModal').modal('hide');}, 2000);
                }else{
                    $('.alert-part').html(data.error);
                }
            }
        });
    
    });

    $(document).on("click",".opentr-btn",function(){

        if($(this).closest('.ech-tr').hasClass('open-tr'))
        {         
            $(this).closest('.ech-tr').removeClass('open-tr');
        }
        else{
            $(this).closest('.ech-tr').addClass('open-tr');
        }           
    });
</script>
@endsection