@extends('layouts.master')
@section('body')
    <main>
        <section>
            <div class="container" style="padding-top: 35px; position: relative">
                <a style="position: absolute; top:5px" class="epp-blue my-darkgrey" href="{{ route('get.customerAccOrders') }}"><strong><i class="zmdi zmdi-long-arrow-left"></i> Back</strong></a>
                <div class="row d-flex chkout-cont-wrap">
                    <div class="col-md-8 my-chk-4">
                        @include('includes.customerOrderLeft')
                    </div>
                    <div class="col-md-4 my-chk-4">
                        @include('includes.checkoutRight')
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ URL::to('js/my-checkout-js.js') }}"></script>
@stop