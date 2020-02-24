@extends('layouts.admin')
@section('pageTitle')
    All books
@endsection
@section('titlemain')
    <li class="breadcrumb-item"><a href="{{ route('all.books') }}">Books</a></li>
@endsection
@section('new-btn')
    <a href="{{ route('books.upload') }}" class="btn btn-sm btn-neutral">Add New</a>
@endsection
@section('second-card')

    <!-- books holder -->
    @if($books)
        <div class="row border-r6 shadow" style="margin: 15px 0">
            <div class="container-fluid" style="background-color: #fff; position: relative; border-radius: 6px; padding: 40px 25px !important; display: flex; flex-wrap: wrap">
                <div class="pagination-btn1">{{ $books->links() }}</div>
                @foreach($books as $book)
                    <div class="col-md-3" style=" position: relative; ">
                        <div class="img-hold-wrap">
                            <div class="nav-item dropdown books-action-toggle">
                                <a href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right book-drpdown">
                                    <a href="{{ route('book.edit', ['book' => $book->id ]) }}" class="bk-edit-toggle dropdown-item">
                                        <i class="zmdi zmdi-edit my-ftblue"></i>
                                        <span>{{ __('Edit') }}</span>
                                    </a>
                                    <a href="javascript: void (0)" class="no-border bookinp-del dropdown-item" data-name="{{ $book->image }}" data-content="{{ $book->title }}" data-id="{{ $book->id  }}">
                                        <i class="zmdi zmdi-delete my-ft-danger"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="img-holder text-center" style=" position: relative">
                                <div id="recently_added" class="toggle-holder bk-preview" data-id="{{ $book->id }}" data-toggle="over1_{{ $book->id }}">
                                    <img class="img-rounded" src="{{ route('get.bookImgs', ['filename' => $book->image]) }}" alt="{{ $book->title }}">
                                    <div class="desc-overlay" id="over1_{{ $book->id }}">
                                        <div class="bk-actions-holder">
                                            <a href="javascript: void (0)" class="bk-preview" data-id="{{ $book->id }}"><span class="zmdi zmdi-search"></span></a>
                                        </div>
                                        <span class="dsc-span" id="span">{{ $book->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-holder1">
                            <div style="color: rgb(50, 50, 93); font-size: 14px">
                                <h5 class="info-1 desc-sec-hide" style="margin: 0">{{ $book->title }}</h5>
                            </div>
                            <div class="desc-sec-hide" style="font-size: 13px;">
                                <span>{{ $book->category }}</span>
                                @if($book->sub_category1)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $book->sub_category1 }}</span>
                                @endif
                                @if($book->sub_category2)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $book->sub_category2 }}</span>
                                @endif
                            </div>
                            <div class="lastest-pric-row">
                            <?php
                            $disc = $book->discount;
                            if ($disc){
                                $rate = $book->discount;
                                $percent = $rate/100;
                                $discount_price = $percent * $book->price;
                                $total = $book->price - $discount_price;
                                $total_price = number_format($total, 2);

                            }
                            ?>
                                @if($book->discount > 0)
                                    <span class="dark-black price-tag">GH₵ {{ $total_price }}</span>
                                    <span class="badge badge-info">{{ $book->discount }}% off</span>
                                    <span class="discount-linethru">GH₵ {{ number_format($book->price, 2)  }}</span>
                                @else
                                    <span class="dark-black price-tag">GH₵ {{ number_format($book->price, 2)  }}</span>
                                @endif
                            </div>
                            <div>
                                @if($book->new_arrivals == 1)
                                    <a href="javascript:void (0)" class="badge badge-success">NEW</a>
                                @endif
                                @if($book->featured_books == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">FEATURED</a>
                                @endif
                                @if($book->best_seller == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">BEST SELLER</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="pagination-btn2">{{ $books->links() }}</div>
            </div>
        </div>
    @endif
    <!--/books holder-->

@endsection