@extends('layouts.customerAccMaster')

@section('customerAccLeft')
    <div class="cus-acctright-list">
        <a href="{{ route('get.customerAccHome', ['key' => ''])  }}" style="font-size: 20px; text-decoration: underline"><i class="zmdi zmdi-chevron-left"></i> back</a>
        <div class="row my-cus-row">
            <div class="col-md-12">
                @if ($hasAddress == 0)
                    <div style="padding: 0 40px">
                        @include('includes.addressForm')
                    </div>
                    @else
                    <div style="padding: 0 40px">
                        <form method="post" action="{{ route('post.address') }}">
                            @csrf
                            <div class="form-row details-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Full name *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $address->name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $address->email }}">
                                </div>
                            </div>
                            <div class="form-row details-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone number *</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="{{ $address->phone }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="altnumber">Alternative number</label>
                                    <input type="number" class="form-control" id="altnumber" name="alternativePhone" value="{{ $address->alt_phone }}">
                                </div>
                            </div>
                            <div class="form-row details-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address *</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $address->address }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Apartment">Apartment</label>
                                    <input type="text" class="form-control" id="apartment" name="apartment" value="{{ $address->apartment }}">
                                </div>
                            </div>
                            <div class="form-row details-row">
                                <div class="form-group col-md-6">
                                    <label for="city">Town/City *</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">Country *</label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{ $address->country }}">
                                </div>
                            </div>
                            <div class="form-row details-row">
                                <div class="form-group col-md-12">
                                    <label for="address">Additional information</label>
                                    <textarea type="text" class="form-control" rows="3" id="additional" name="additionalInfo">{{ $address->additional_info }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn no-border epp-dark-blue-bg next-btn">Submit form</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop