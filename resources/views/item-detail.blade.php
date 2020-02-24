@extends('layouts.master')
@section('title')
    Item detail | @if($item) {{ $item->title }} @else Item does not exist! @endif
@endsection

@section('body')
    <!--main-section-->
    <main>
        <section>
            <div class="container">
                @if($item)
                <?php
                    $disc = $item->discount;
                    if ($disc){
                        $rate = $item->discount;
                        $percent = $rate/100;
                        $discount_price = $percent * $item->price;
                        $total = $item->price - $discount_price;
                        $total_price = number_format($total, 2);

                    }
                    ?>
                <div class="item-detail-holder row" style="padding:60px 0">
                    <div class="col-md-6">
                        <div class="i-d-img">
                            <img class="rounded shadow" src="{{ route('get.bookImgs', [ 'filename' => $item->image])}}" alt="">
                        </div>
                    </div>
                    <style>
                        .item-detail-holder{ margin: 0; }
                        .i-d-img{ text-align: center;}
                        .i-d-head{ color: rgb(157, 157, 157); font-size: 14px}
                        .i-d-title{ font-size: 22px; color: rgb(50,50,50);font-weight: 600;}
                        .i-d-price{ display: flex}
                        .i-d-price div{ font-size: 22px; margin-right: 10px}
                        .this-cancel{color: rgb(157, 157, 157); text-decoration: line-through}
                        .i-d-desc{ color: rgb(127, 127, 127); font-size: 15px;}
                        .i-d-pub{ font-size: 15px}
                        .i-d-isbn{ font-size: 15px}
                        .rate-wrap i{ margin-right: 5px; color: #f0ca0e}
                        .rate-wrap span{ color: #ddd}
                        .i-d-btn-hold button{ margin-bottom: 10px}
                    </style>
                    <div class="col-md-6">
                        <div class="i-d-head">Item Detail</div>
                        <p>
                        <div class="i-d-title">{{ $item->title }}</div>
                        </p>
                        <div class="rate-wrap" style="display:flex">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                        </div>

                        <p>
                                <div class="i-d-price">
                                @if ($disc > 0)
                                <div class="epp-blue">GH₵ {{ $total_price }}</div>
                                 <div class="this-cancel">GH₵ {{ number_format($item->price, 2)}}</div>
                                @else
                                <div class="epp-blue">GH₵ {{ number_format($item->price, 2)}}</div>
                                @endif
                                </div>

                        </p>

                        <p>
                            @if($item->description)
                                <div class="i-d-desc">{{ $item->description }}</div>
                                @else
                                <div class="i-d-desc">Item description not available</div>
                                @endif

                        </p>
                        @if($item->publisher)
                        <p>
                        <div class="i-d-pub">Publisher: {{ $item->publisher}}</div>
                        </p>
                        @endif
                            @if($item->book_author)
                                <p>
                                <div class="i-d-pub">Author: {{ $item->book_author}}</div>
                                </p>
                            @endif
                        @if($item->isbn)
                        <p>
                        <div class="i-d-isbn">ISBN: {{ $item->isbn }}</div>
                        </p>
                        @endif
                        <div class="i-d-btn-hold">
                                <form id="i-d-form-{{ $item->id }}" onsubmit="return false;"  method="POST" style="position: relative">
                                        @csrf
                                <input id="itd_inp_{{ $item->id }}" type="hidden" name="itemId" value="{{ $item->id }}">
                                    <button class="btn btn-icon btn-round epp-blue-bg add-to-cart" data-load="itd-lazyload-{{ $item->id }}"  type="submit" data-target="itd_inp_{{ $item->id }}">
                                        <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                                        <span class="btn-inner--text">Add to cart</span>
                                    </button>
                                    <div class="itd-lazy-loader" id="itd-lazyload-{{ $item->id }}"></div>
                                </form>

                            <button class="btn-icon btn-round add-to-wishlist btn btn-neutral epp-blue" data-load="itd-lazyload-{{ $item->id }}" data-target="itd_inp_{{ $item->id }}"  type="button">
                                <span class="btn-inner--icon"><i class="ni ni-favourite-28"></i></span>
                                <span class="btn-inner--text">Add to wish list</span>
                            </button>
                            <button class="btn-icon btn-round  btn btn-neutral epp-blue" type="button">
                                <span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span>
                                <span class="btn-inner--text">Share</span>
                            </button>
                        </div>
                    </div>
                </div>
                @else
                <div>
                    Item does not exist!
                </div>
                @endif
            </div>
        </section>
    </main>
    <!-- -->
    <!--/main-section-->
@endsection
