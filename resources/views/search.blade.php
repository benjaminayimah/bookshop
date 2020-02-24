@extends('layouts.master')
@section('title')
    Search for {{ $key }}
@stop
@section('body')
    <main>
        <section class="my-section" >
            <div class="container" style="background-color:#fff;border-radius:5px">
                <div>
                    <h5>Search results for <i>"{{ $key }}"</i></h5>
                </div>
                <div class="my-row">
                    @if (count($books) > 0 )
                        <div class="my-flex book-main-row">
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
                        </div>
                    @endif
                    @if (count($category) > 0 )
                            <div class="my-flex book-main-row">
                                @foreach($category as $cat)
                                    <div class="col-md-2 mb-2">
                                        <a href="{{ route('get.bookfromCategory', ['name' => $cat->category, 'id' => $cat->id]) }}" style="padding: 7px 15px; display: block; background-color: #ddd; border-radius: 3px">{{ $cat->category }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @if (count($category) < 1 && count($books) < 1)
                            <div style="padding: 20px"><h6>No match for <i>"{{ $key }}"</i></h6></div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@stop