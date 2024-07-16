@extends('layouts.vertical', ["page_title"=> "Customer | Add"])
@section('css')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="{{url('admin/users')}}">Users</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <h4 class="page-title">Add User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row"><div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">User Form</h4>
                    @if(!empty($errors->all()))
                    <p class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                    </p>
                    @endif
                    <form role="form" class="parsley-examples" method="post" action="{{url('admin/users')}}">
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-4 col-form-label">Name<span class="text-danger">*</span></label>
                            <div class="col-7">
                                <input type="text" name="name" value="{{old('name')}}" required class="form-control" placeholder="Name" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hori-pass2" class="col-4 col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col-7">
                                <input type="text" name="email" value="{{old('email')}}" required placeholder="Email" class="form-control" id="hori-pass2" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="webSite" class="col-4 col-form-label">Is Admin?</label>
                            <div class="col-7">
                                <input type="checkbox" name="roles" value="Admin">
                            </div>
                        </div>

                        <div class="row mb-3 approver">
                            <label for="hori-pass2" class="col-4 col-form-label">Approver 1</label>
                            <div class="col-7">
                                <select name="approver1" class="userSelect form-control select2">
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 approver">
                            <label for="hori-pass2" class="col-4 col-form-label">Approver 2</label>
                            <div class="col-7">
                                <select name="approver2" class="userSelect form-control select2">
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-4 col-form-label">Password<span class="text-danger">*</span></label>
                            <div class="col-7">
                            <input type="password" name="password" required  class="form-control" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="webSite" class="col-4 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                            <div class="col-7">
                                <input type="password" name="password_confirmation" required  class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8 offset-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                <a href="{{url('admin/users')}}"><button type="button" class="btn btn-secondary waves-effect">Cancel</button></a>
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
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<!-- end demo js-->
<script>
$(".userSelect").select2({
    ajax: {
    url: "{{ url('admin/ajax/users') }}",
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
                    text: item.name+'('+item.email+')',
                    id: item.id
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
        placeholder: "By searching name,email",
        allowClear: false,
});
$('input[name="roles"]').change(function(){
    if ($(this).is(':checked')) {
        $('.approver').hide();
    }
    else{
        $('.approver').show();
    }
});
</script>
@endsection