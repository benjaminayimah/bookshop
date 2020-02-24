@extends('layouts.master')
@section('title')
    Log in!
@endsection
@section('body')
    <main>
        <section class="section section-shaped section-lg">
            <div class="shape shape-style-1" style="background-color:#000063">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-white pb-5">
                                <div class="text-muted text-center mb-3 mt-3">
                                    <small>Sign in</small>
                                </div>
                               <!-- <div class="btn-wrapper text-center">
                                    <a href="#" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon">
                                            <img src="{{ URL::to('img/icons/common/github.svg') }}">
                                        </span>
                                        <span class="btn-inner--text">Github</span>
                                    </a>
                                    <a href="#" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon">
                                            <img src="{{ URL::to('img/icons/common/google.svg') }}">
                                        </span>
                                        <span class="btn-inner--text">Google</span>
                                    </a>
                                </div>-->
                            </div>
                            <div class="card-body px-lg-5">
                               <!-- <div class="text-center text-muted mb-4">
                                    <small>Or sign in with credentials</small>
                                </div>-->
                                <form role="form" method="post" action="{{ route('loginuser') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" name="email" placeholder="Email" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="password" placeholder="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="rememberMe" id="customCheckLogin" type="checkbox">
                                        <label class="custom-control-label" for="customCheckLogin">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn epp-blue-bg my-4">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                               <!-- <a href="#" class="text-light">
                                    <small>Forgot password?</small>
                                </a>-->
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('register') }}" class="text-light">
                                    <small>Create new account</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection