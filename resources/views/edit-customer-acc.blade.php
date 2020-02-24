@extends('layouts.customerAccMaster')

@section('customerAccLeft')
    <div class="cus-acctright-list">
        <a href="{{ route('get.customerAccHome')  }}" style="font-size: 20px; text-decoration: underline"><i class="zmdi zmdi-chevron-left"></i> back</a>
        <div class="row my-cus-row">
            <div class="col-md-12">
                @if(isset($user))
                    @if ($key == 'edit-account')
                        <div>
                            <form method="post" action="{{ route('post.editcustAcct') }}">
                                @csrf
                                <div class="form-row details-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Full name *</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <label>Gender</label>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="genderRadio" class="custom-control-input" value="1" @if($user->gender == 'male') checked @endif id="customRadio2" type="radio">
                                    <label class="custom-control-label" for="customRadio2">
                                        <span>Male</span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="genderRadio" class="custom-control-input" value="2" @if($user->gender == 'female') checked @endif id="customRadio1" type="radio">
                                    <label class="custom-control-label" for="customRadio1">
                                        <span>Female</span>
                                    </label>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn no-border epp-dark-blue-bg next-btn">Submit form</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @elseif ($key == 'edit-pass')
                        <div>
                            <form method="post" action="{{ route('post.changepass') }}">
                                @csrf
                                <div class="form-row details-row">
                                    <div class="form-group col-md-6">
                                        <label for="currentpass">Current Password *</label>
                                        <input type="password" class="form-control" id="currentpass" name="currentPassword">
                                    </div>
                                </div>
                                <div class="form-row details-row">
                                    <div class="form-group col-md-6">
                                        <label for="newpass">New Password *</label>
                                        <input type="password" class="form-control" id="newpass" name="newPassword">
                                    </div>
                                </div>
                                <div class="form-row details-row">
                                    <div class="form-group col-md-6">
                                        <label for="confirmPass">Confirm Password *</label>
                                        <input type="password" class="form-control" id="confirmPass" name="newPassword_confirmation">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn no-border epp-dark-blue-bg next-btn">Submit form</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <h6>An Error occured</h6>
                    @endif
                    @endif
            </div>
        </div>
    </div>
@stop