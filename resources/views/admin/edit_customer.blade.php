@extends('layouts.vertical', ["page_title"=> "Customer | Edit"])

@section('content')
@php
    $name = explode('. ',$customer->addressID);
    if(count($name) > 1)
    {
        $prefix = $name[0].".";
        $addressID = $name[1];
    }
    else
    {
        $prefix = null;
        $addressID = $customer->addressID;
    }

    $nameBilling = explode('. ',$customer->addressIDBilling);
    if(count($nameBilling) > 1)
    {
        $prefixBilling = $nameBilling[0].".";
        $addressIDBilling = $nameBilling[1];
    }
    else
    {
        $prefixBilling = null;
        $addressIDBilling = $customer->addressIDBilling;
    }
@endphp
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/customers')}}">Customers</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Customer</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row"><div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Customer Form</h4>
                    @if(!empty($errors->all()))
                    <p class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                    </p>
                    @endif
                    <form id="form" role="form" class="parsley-examples" method="post" action="{{url('admin/customers/'.$customer->id)}}">
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-3 col-form-label">Name<span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" name="name" value="{{old('name') ? old('name'):$customer->name }}" required class="form-control" placeholder="Name" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hori-pass1" class="col-3 col-form-label">Customer Code<span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" readonly name="customer_code" value="{{old('customer_code') ? old('customer_code'):$customer->customer_code }}" placeholder="Customer Code" required class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hori-pass2" class="col-3 col-form-label">Contact Number <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="number" name="phone" min="10" value="{{old('phone') ? old('phone'):$customer->phone }}" required placeholder="Contact Number" class="form-control" id="hori-pass2" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hori-pass2" class="col-3 col-form-label">Email</label>
                            <div class="col-8">
                                <input type="email" name="email" value="{{old('email') ? old('email'):$customer->email}}" placeholder="Email" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hori-pass2" class="col-3 col-form-label">Alt Phone <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="number" name="alt_phone" min="10" value="{{old('alt_phone')? old('alt_phone'):$customer->alt_phone}}" required placeholder="Alternate Contact Number" class="form-control" id="hori-pass2" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Description</label>
                            <div class="col-8">
                                <textarea class="form-control" name="description" rows="5" spellcheck="false">{{old('description') ? old('description'):$customer->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hori-pass2" class="col-3 col-form-label">GSTIN</label>
                            <div class="col-8">
                                <input type="text" name="gstin" value="{{old('gstin') ? old('gstin'):$customer->gstin}}" placeholder="GSTIN" class="form-control" id="hori-pass2" />
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="webSite" class="col-form-label">↓ Billing Address ↓</label>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address ID <span class="text-danger">*</span></label>
                            <div class="col-3">
                                <select class="form-control" name="prefixBilling">
                                    <option @if($prefixBilling == 'Mr.') selected @endif>Mr.</option>
                                    <option @if($prefixBilling == 'Ms.') selected @endif>Ms.</option>
                                    <option @if($prefixBilling == 'Dr.') selected @endif>Dr.</option>
                                    <option @if($prefixBilling == 'Adv.') selected @endif>Adv.</option>
                                    <option @if($prefixBilling == 'M/S.') selected @endif>M/S.</option>
                                </select>
                            </div>
                            
                            <div class="col-3">
                                <input type="text" required class="form-control" placeholder="Address ID" name="addressIDBilling" value="{{old('addressIDBilling')? old('addressIDBilling'):$addressIDBilling}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address 1 <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" required class="form-control" placeholder="Address 1" name="addressBilling" value="{{old('addressBilling')? old('addressBilling'):$customer->addressBilling}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address 2 <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" required class="form-control" placeholder="Address 2" name="address2Billing" value="{{old('address2Billing')? old('address2Billing'):$customer->address2Billing}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">City <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" name="placeBilling" value="{{old('placeBilling') ? old('placeBilling'):$customer->placeBilling}}" placeholder="City" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Zip code <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" required name="zip_codeBilling" value="{{old('zip_codeBilling') ? old('zip_codeBilling'):$customer->zip_codeBilling}}" placeholder="Zip code" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">State <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" name="stateBilling" value="{{old('stateBilling') ? old('stateBilling'):$customer->stateBilling}}" placeholder="StateBilling" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Country <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" value="India" name="countryBilling" value="{{old('countryBilling') ? old('countryBilling'):$customer->countryBilling}}" placeholder="Country" class="form-control" />
                            </div>
                        </div>


                        <div class="row mb-3"><div class="col-3">
                                <label for="webSite" class="col-form-label">↓ Shipping Address ↓</label>
                            </div>
                            <div class="col-6"><input type="checkbox" name="sepBilling" id="sepBilling">
                                <label for="webSite" class="col-form-label"> Same as Billing Address</label>
                            </div></div>

                            <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address ID <span class="text-danger">*</span></label>
                            <div class="col-3">
                                <select class="form-control" name="prefix">
                                    <option @if($prefix == 'Mr.') selected @endif>Mr.</option>
                                    <option @if($prefix == 'Ms.') selected @endif>Ms.</option>
                                    <option @if($prefix == 'Dr.') selected @endif>Dr.</option>
                                    <option @if($prefix == 'Adv.') selected @endif>Adv.</option>
                                    <option @if($prefix == 'M/S.') selected @endif>M/S.</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <input type="text" required class="form-control" name="addressID" placeholder="Address ID" value="{{old('addressID')? old('addressID'):$addressID}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address 1 <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" required class="form-control" placeholder="Address 1" name="address" value="{{old('address')? old('address'):$customer->address}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Address 2 <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" required class="form-control" name="address2" placeholder="Address 2" value="{{old('address2')? old('address2'):$customer->address2}}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">City</label>
                            <div class="col-8">
                            <input type="text" name="place" value="{{old('place') ? old('place'):$customer->place}}" required placeholder="City" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Zip code <span class="text-danger">*</span></label>
                            <div class="col-8">
                            <input type="text" required name="zip_code" value="{{old('zip_code') ? old('zip_code'):$customer->zip_code}}" placeholder="Zip code" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">State</label>
                            <div class="col-8">
                            <input type="text" name="state" value="{{old('state') ? old('state'):$customer->state}}" required placeholder="State" class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-3 col-form-label">Country</label>
                            <div class="col-8">
                            <input type="text" value="India" name="country" value="{{old('country') ? old('country'):$customer->country}}" required placeholder="Country" class="form-control" />
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col-8 offset-4">
                                <button id="myform" type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                <a href="{{url('admin/customers')}}"><button type="button" class="btn btn-secondary waves-effect">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
<!-- third party js -->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<!-- end demo js-->
<script>
    $(document).ready(function() {
        $('#sepBilling').change(function(){
            if($('#sepBilling').is(':checked'))
            {
                $('select[name=prefix').val($('select[name=prefixBilling').val());
                $('input[name=addressID').val($('input[name=addressIDBilling').val());
                $('input[name=address').val($('input[name=addressBilling').val());
                $('input[name=address2').val($('input[name=address2Billing').val());
                $('input[name=place').val($('input[name=placeBilling').val());
                $('input[name=zip_code').val($('input[name=zip_codeBilling').val());
                $('input[name=state').val($('input[name=stateBilling').val());
                $('input[name=country').val($('input[name=countryBilling').val());
            }
            else{                
            }
        });

        $("#myform").click(function(e) {
        //prevent Default functionality
            e.preventDefault();

            if($('input[name=phone').val() == $('input[name=alt_phone').val())
            {
                alert("Phone and Alt phone should not be same.");
                return false;
            }

            $('#form').submit();
        });
    });
</script>
@endsection