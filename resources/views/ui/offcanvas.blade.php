@extends('layouts.vertical', ["page_title"=> "Offcanvas"])

@section('css')
<!-- third party css -->
<link href="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UI</a></li>
                        <li class="breadcrumb-item active">Offcanvas</li>
                    </ol>
                </div>
                <h4 class="page-title">Offcanvas</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Offcanvas</h4>
                    <p class="text-muted">Push notifications to your visitors with a toast, a lightweight and easily customizable alert message.</p>

                    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        Link with href
                    </a>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        Button with data-bs-target
                    </button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                images, lists, etc.
                            </div>
                            <h5 class="mt-3">List</h5>
                            <ul class="ps-3">
                                <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                <li class="">Neque porro quisquam est, qui dolorem</li>
                                <li class="">Quis autem vel eum iure qui in ea</li>
                            </ul>

                            <ul class="ps-3">
                                <li class="">At vero eos et accusamus et iusto odio dignissimos</li>
                                <li class="">Et harum quidem rerum facilis</li>
                                <li class="">Temporibus autem quibusdam et aut officiis</li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Offcanvas Backdrop</h4>
                    <p class="text-muted">Scrolling the <code>&lt;body&gt;</code> element is disabled when an offcanvas and its backdrop are visible. Use the <code>data-bs-scroll</code> attribute to toggle <code>&lt;body&gt;</code> scrolling and <code>data-bs-backdrop</code> to toggle the backdrop.</p>

                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Enable body scrolling</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Enable backdrop (default)</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                images, lists, etc.
                            </div>
                            <h5 class="mt-3">List</h5>
                            <ul class="ps-3">
                                <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                <li class="">Neque porro quisquam est, qui dolorem</li>
                                <li class="">Quis autem vel eum iure qui in ea</li>
                            </ul>

                            <ul class="ps-3">
                                <li class="">At vero eos et accusamus et iusto odio dignissimos</li>
                                <li class="">Et harum quidem rerum facilis</li>
                                <li class="">Temporibus autem quibusdam et aut officiis</li>
                            </ul>
                        </div>
                    </div>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Offcanvas with backdrop</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                images, lists, etc.
                            </div>
                            <h5 class="mt-3">List</h5>
                            <ul class="ps-3">
                                <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                <li class="">Neque porro quisquam est, qui dolorem</li>
                                <li class="">Quis autem vel eum iure qui in ea</li>
                            </ul>

                            <ul class="ps-3">
                                <li class="">At vero eos et accusamus et iusto odio dignissimos</li>
                                <li class="">Et harum quidem rerum facilis</li>
                                <li class="">Temporibus autem quibusdam et aut officiis</li>
                            </ul>
                        </div>
                    </div>
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                images, lists, etc.
                            </div>
                            <h5 class="mt-3">List</h5>
                            <ul class="ps-3">
                                <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                <li class="">Neque porro quisquam est, qui dolorem</li>
                                <li class="">Quis autem vel eum iure qui in ea</li>
                            </ul>

                            <ul class="ps-3">
                                <li class="">At vero eos et accusamus et iusto odio dignissimos</li>
                                <li class="">Et harum quidem rerum facilis</li>
                                <li class="">Temporibus autem quibusdam et aut officiis</li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Offcanvas Placement</h4>
                    <p class="text-muted">Try the right and bottom examples out below.</p>

                    <ul>
                        <li><code>.offcanvas-start</code> places offcanvas on the left of the viewport (shown above)</li>
                        <li><code>.offcanvas-end</code> places offcanvas on the right of the viewport</li>
                        <li><code>.offcanvas-bottom</code> places offcanvas on the bottom of the viewport</li>
                    </ul>

                    <div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div>
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                    images, lists, etc.
                                </div>
                                <h5 class="mt-3">List</h5>
                                <ul class="ps-3">
                                    <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                    <li class="">Neque porro quisquam est, qui dolorem</li>
                                    <li class="">Quis autem vel eum iure qui in ea</li>
                                </ul>

                                <ul class="ps-3">
                                    <li class="">At vero eos et accusamus et iusto odio dignissimos</li>
                                    <li class="">Et harum quidem rerum facilis</li>
                                    <li class="">Temporibus autem quibusdam et aut officiis</li>
                                </ul>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Toggle bottom offcanvas</button>

                        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div>
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                                    images, lists, etc.
                                </div>
                                <h5 class="mt-3">List</h5>
                                <ul class="ps-3">
                                    <li class="">Nemo enim ipsam voluptatem quia aspernatur</li>
                                    <li class="">Neque porro quisquam est, qui dolorem</li>
                                    <li class="">Quis autem vel eum iure qui in ea</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

</div> <!-- container -->
@endsection

@section('script')
<!-- third party js -->
<script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>
<!-- end demo js-->
@endsection