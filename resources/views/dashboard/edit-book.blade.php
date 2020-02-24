@extends('layouts.admin')
@section('pageTitle')
    Edit
@endsection
@section('titlemain')
    <li class="breadcrumb-item"><a href="{{ route('all.books') }}">Books</a></li>
@endsection

@section('second-card')
    @if($thisBook != '')
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="shadow border-r6">
                <div class="card-header border-r6 border-0 img-height">
                    <div class="row align-items-center" style="margin: 0">
                        <form method="post" id="book_uploadform" style="width: 100%;" action="{{ route('post.editedBook') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row" style="display: flex; flex-wrap: wrap">
                                <div class="form-group col-md-6">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $thisBook->title }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="category">Category:</label>
                                    <select name="category" id="category" class="form-control">
                                        <option selected value="{{ $thisBook->cat_id }}" >{{ $thisBook->category }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="subcat">1st sub-category:</label>
                                    <select name="subCategory1" id="subcat" class="form-control">
                                        <option selected value="{{ $thisBook->sub_catid }}">{{ $thisBook->sub_category1 }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap">
                                <div class="form-group col-md-3">
                                    <label for="subcat2">2nd sub-category:</label>
                                    <select name="subCategory2" id="subcat2" class="form-control">
                                        <option selected value="{{ $thisBook->sub_catid2 }}">{{ $thisBook->sub_category2 }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $thisBook->price }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="discount">Discount:</label>
                                    <input type="number" class="form-control" id="discount" name="discount" value="{{ $thisBook->discount }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="publisher">Publisher:</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $thisBook->publisher }}">
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap; padding-left: 25px; margin: 10px 0 15px 0">
                                <div class="col-md-4 custom-control custom-checkbox">
                                    @if($thisBook->best_seller == true)
                                        <input class="custom-control-input" name="bestSeller" id="bestseller" type="checkbox" checked>
                                    @else
                                        <input class="custom-control-input" name="bestSeller" id="bestseller" type="checkbox">
                                    @endif
                                    <label class="custom-control-label" for="bestseller">
                                        <span>Best Seller?</span>
                                    </label>
                                </div>
                                <div class="col-md-4 custom-control custom-checkbox">
                                    @if($thisBook->featured_books == true)
                                        <input class="custom-control-input" name="featured" id="featured" type="checkbox" checked>
                                    @else
                                        <input class="custom-control-input" name="featured" id="featured" type="checkbox">
                                    @endif
                                    <label class="custom-control-label" for="featured">
                                        <span>Featured Book?</span>
                                    </label>
                                </div>
                                <div class="col-md-4 custom-control custom-checkbox">
                                    @if($thisBook->new_arrivals == true)
                                        <input class="custom-control-input" name="new_arrival" id="new_arrival" type="checkbox" checked>
                                    @else
                                        <input class="custom-control-input" name="new_arrival" id="new_arrival" type="checkbox">
                                    @endif

                                    <label class="custom-control-label" for="new_arrival">
                                        <span>New Arrival?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-row" style="display: flex; flex-wrap: wrap;">
                                <div class="col-md-4 form-group">
                                    <label for="isbn">ISBN:</label>
                                    <input name="isbn" class="form-control" id="isbn" value="{{ $thisBook->isbn }}">
                                    <label>Author:</label>
                                    <input name="bookAuthor" value="{{ $thisBook->book_author }}" class="form-control" id="book_author">
                                    <div class="hidden">
                                        <input class="hidden" type="hidden" name="bookid" value="{{ $thisBook->id }}">
                                        <input class="hidden" type="hidden" name="imgbookOld" value="{{ $thisBook->image }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="description">Book Description:</label>
                                    <textarea name="description" class="form-control" rows="4" id="description">{{ $thisBook->description }}</textarea>
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
        <div class="col-xl-4">
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
                                    <a href="{{ route('book.edit', ['book' => $thisBook->id ]) }}" class="bk-edit-toggle dropdown-item">
                                        <i class="zmdi zmdi-edit my-ftblue"></i>
                                        <span>{{ __('Edit') }}</span>
                                    </a>
                                    <a href="javascript: void (0)" class="no-border bookinp-del dropdown-item" data-name="{{ $thisBook->image }}" data-content="{{ $thisBook->title }}" data-id="{{ $thisBook->id  }}">
                                        <i class="zmdi zmdi-delete my-ft-danger"></i>
                                        <span>{{ __('Delete') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="img-holder text-center" style=" position: relative">
                                <div id="recently_added" class="toggle-holder bk-preview" data-id="{{ $thisBook->id }}" data-toggle="over_{{ $thisBook->id }}">
                                    <img class="img-rounded" src="{{ route('get.bookImgs', ['filename' => $thisBook->image]) }}" alt="{{ $thisBook->title }}" >
                                    <div class="desc-overlay" id="over_{{ $thisBook->id }}">
                                        <div class="bk-actions-holder">
                                            <a href="javascript: void (0)" class="bk-preview" data-id="{{ $thisBook->id }}"><span class="zmdi zmdi-search"></span></a>
                                        </div>
                                        <span class="dsc-span" id="span">{{ $thisBook->description }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="info-holder2">
                            <div style="color: rgb(50, 50, 93); font-size: 14px">
                                <h5 class="info-1 desc-sec-hide" style="margin: 0">{{ $thisBook->title }}</h5>
                            </div>
                            <div class="desc-sec-hide" style="font-size: 13px;">
                                <span>{{ $thisBook->category }}</span>
                                @if($thisBook->sub_category1)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $thisBook->sub_category1 }}</span>
                                @endif
                                @if($thisBook->sub_category2)
                                    <i class="zmdi zmdi-caret-right"></i>
                                    <span>{{ $thisBook->sub_category2 }}</span>
                                @endif
                            </div>
                            <div class="lastest-pric-row">
                                @if($thisBook->discount)
                                    <span class="dark-black price-tag">GH₵ {{ $total_price }}</span>
                                    <span class="badge badge-info">{{ $thisBook->discount }}% off</span>
                                    <span class="discount-linethru">GH₵ {{ $init_price }}</span>
                                @else
                                    <span class="dark-black price-tag">GH₵ {{ $init_price }}</span>
                                @endif
                            </div>
                            <div>
                                @if($thisBook->new_arrivals == 1)
                                    <a href="javascript:void (0)" class="badge badge-success">NEW</a>
                                @endif
                                @if($thisBook->featured_books == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">FEATURED</a>
                                @endif
                                @if($thisBook->best_seller == 1)
                                    <a href="javascript:void (0)" class="badge badge-warning">BEST SELLER</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @else
        <div style=" color: #ffffff"><h1>Item not found!!!</h1></div>
    @endif

    <!-- books holder -->
    <!--/books holder-->
@endsection
