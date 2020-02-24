@extends('layouts.master')

@section('title')
    {{ $category }}
@stop
@section('body')
    <main>
        <section class="my-default-section" >
            <div class="container my-default-container">
                <div class="my-default-section-head">
                    <h5>{{ $category }}</h5>
                </div>
                <div class="my-row">
                    <div class="my-flex">
                        @if (count($books) > 0)
                            @foreach($books as $book)
                                <?php
                                $disc = $book->discount;
                                if ($disc != null){
                                    $rate = $book->discount;
                                    $percent = $rate/100;
                                    $discount_price = $percent * $book->price;
                                    $total = $book->price - $discount_price;
                                    $total_price = number_format($total, 2);
                                }
                                ?>

                                <div class="col-2">
                                    <div class="book-inner-wrap">
                                        @if ($book->new_arrivals == true)
                                            <div class="new-tag"><span>New</span></div>
                                        @endif
                                        @if ($disc > 0)
                                            <span class="badge discount-tag">-{{ $book->discount }}%</span>
                                    @endif

                                    <!--       <i class="zmdi zmdi-favorite-outline favourite-tag"></i> -->

                                        <a href="{{ route('get.item.detail', ['itemId' => $book->id]) }}">
                                            <img class="itemimg" alt="item image" src="{{ route('get.bookImgs', [ 'filename' => $book->image])}}"/>
                                        </a>
                                        <div class="book-info">
                                            <div>{{ $book->title }}</div>
                                            @if ($disc > 0)
                                                <div class="price-holder">GH₵ {{ $total_price }}</div>
                                                <div class="price-canceled">GH₵ {{ number_format($book->price, 2)}}</div>
                                            @else
                                                <div class="price-holder">GH₵ {{ number_format($book->price, 2)}}</div>
                                                <div class="price-canceled" style="visibility: hidden">No discount</div>
                                            @endif
                                            <form id="featured-book-form-{{ $book->id }}" class="addTocartForm" onsubmit="return false;" method="POST">
                                                <input type="hidden" name="itemId" id="featured_inp_{{ $book->id }}" value="{{ $book->id }}">
                                                <button class="btn btn-icon epp-blue-bg add-to-cart add-to-cartbtn" data-load="ft-cart-lazyload-{{ $book->id }}" data-id="{{ $book->id }}" data-target="featured_inp_{{ $book->id }}" type="submit">
                                                    <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                                                    <span class="btn-inner--text my-hm-adtcart">Add to cart</span>
                                                </button>
                                            </form>
                                        </div>
                                        <small class="cart-added-status" id="cart_added_{{ $book->id }}"></small>
                                        <div class="cart-lazy-loader" id="ft-cart-lazyload-{{ $book->id }}"></div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <div style="padding: 20px">No item found under this category</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop