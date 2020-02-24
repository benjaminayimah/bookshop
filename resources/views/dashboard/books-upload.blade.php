@extends('layouts.admin')
@section('pageTitle')
    Upload Books
@endsection
@section('titlemain')
    <li class="breadcrumb-item"><a href="{{ route('all.books') }}">Books</a></li>
@endsection
@section('second-card')
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="shadow border-r6">
                <div class="card-header border-r6 border-0 img-height">
                    <div class="row align-items-center" style="margin: 0">
                        <form method="post" id="book_uploadform" style="width: 100%;" action="{{ route('post.bookUpload') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row" style="display: flex; flex-wrap: wrap">
                                <div class="form-group col-md-6">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Title">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="category">Category:</label>
                                    <select name="category" id="category" class="form-control">
                                        <option selected value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="subcat">1st sub-category:</label>
                                    <select name="subCategory1" id="subcat" class="form-control">
                                        <option selected value="">1st sub-category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap">
                                <div class="form-group col-md-3">
                                    <label for="subcat2">2nd sub-category:</label>
                                    <select name="subCategory2" id="subcat2" class="form-control">
                                        <option selected value="">2nd sub-category</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="discount">Discount:</label>
                                    <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="publisher">Publisher:</label>
                                    <input type="text" value="{{ old('publisher') }}" class="form-control" id="publisher" name="publisher" placeholder="Publisher">
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap; padding-left: 25px; margin: 10px 0 15px 0">
                                <div class="col-md-4 custom-control custom-checkbox">
                                    <input class="custom-control-input" name="bestSeller" id="bestseller" type="checkbox">
                                    <label class="custom-control-label" for="bestseller">
                                        <span>Best Seller?</span>
                                    </label>
                                </div>
                                <div class="col-md-4 custom-control custom-checkbox">
                                    <input class="custom-control-input" name="featured" id="featured" type="checkbox">
                                    <label class="custom-control-label" for="featured">
                                        <span>Featured Book?</span>
                                    </label>
                                </div>
                                <div class="col-md-4 custom-control custom-checkbox">
                                    <input class="custom-control-input" name="new_arrival" id="new_arrival" type="checkbox">
                                    <label class="custom-control-label" for="new_arrival">
                                        <span>New Arrival?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap;">
                                <div class="col-md-4 form-group">
                                    <label for="isbn">ISBN:</label>
                                    <input name="isbn" value="{{ old('isbn') }}" class="form-control" id="isbn" placeholder="ISBN">
                                    <label>Author:</label>
                                    <input name="bookAuthor" value="{{ old('bookAuthor') }}" class="form-control" placeholder="Author" id="book_author">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="description">Book Description:</label>
                                    <textarea name="description" class="form-control" rows="4" id="description" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="img">Choose image:</label>
                                    <input type="file" id="img" name="bookImage" class="form-control">
                                </div>
                            </div>
                            <div class="form-row" style="padding-top: 10px; margin: 0">
                                <div class="form-group w-100">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if($latestBook)
        <div class="col-xl-4 ">
            <div class="card shadow img-height" style="border: none">
                <div class="card-header border-0" style="padding: 10px 20px">
                    <div class="row align-items-center">
                        <div style="padding-left: 15px">
                            <h4 class="mb-0">Recently added</h4>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div id="image_main_hold">
                        <div class="img-hold-wrap">

                            <div class="nav-item dropdown books-action-toggle">
                                <a href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right book-drpdown">
                                    <a href="{{ route('book.edit', ['book' => $latestBook->id ]) }}" class="bk-edit-toggle dropdown-item">
                                        <i class="zmdi zmdi-edit my-ftblue"></i>
                                        <span>{{ __('Edit') }}</span>
                                    </a>
                                    <a href="javascript: void (0)" class="no-border bookinp-del dropdown-item" data-name="{{ $latestBook->image }}" data-content="{{ $latestBook->title }}" data-id="{{ $latestBook->id  }}">
                                        <i class="zmdi zmdi-delete my-ft-danger"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="img-holder text-center" style=" position: relative">
                                <div id="recently_added" class="toggle-holder bk-preview" data-id="{{ $latestBook->id }}" data-toggle="over_{{ $latestBook->id }}">
                                    <img class="img-rounded" src="{{ route('get.bookImgs', ['filename' => $latestBook->image]) }}" alt="{{ $latestBook->title }}">
                                    <div class="desc-overlay" id="over_{{ $latestBook->id }}">
                                        <div class="bk-actions-holder">
                                            <a href="javascript: void (0)" class="bk-preview" data-id="{{ $latestBook->id }}"><span class="zmdi zmdi-search"></span></a>
                                        </div>
                                        <span class="dsc-span" id="span">{{ $latestBook->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-holder2">
                            <div style="color: rgb(50, 50, 93); font-size: 14px">
                                <h5 class="info-1 desc-sec-hide" style="margin: 0">{{ $latestBook->title }}</h5>
                            </div>
                            <div class="desc-sec-hide" style="font-size: 13px;">
                                <span>{{ $latestBook->category }}</span>
                                @if($latestBook->sub_category1)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $latestBook->sub_category1 }}</span>
                                    @endif
                                @if($latestBook->sub_category2)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $latestBook->sub_category2 }}</span>
                                @endif
                            </div>
                            <div class="lastest-pric-row">
                                @if($latestBook->discount)
                                    <span class="dark-black price-tag">GH₵ {{ $late_total_price }}</span>
                                    <span class="badge badge-info">{{ $latestBook->discount }}% off</span>
                                    <span class="discount-linethru">GH₵ {{ $late_init_price }}</span>
                                @else
                                    <span class="dark-black price-tag">GH₵ {{ $late_init_price }}</span>
                                @endif
                            </div>
                            <div>
                                @if($latestBook->new_arrivals == 1)
                                    <a href="javascript:void (0)" class="badge badge-success">NEW</a>
                                @endif
                                @if($latestBook->featured_books == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">FEATURED</a>
                                @endif
                                @if($latestBook->best_seller == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">BEST SELLER</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>




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
                                <span class="dark-black price-tag">GH₵ {{ number_format($book->price, 2) }}</span>
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
