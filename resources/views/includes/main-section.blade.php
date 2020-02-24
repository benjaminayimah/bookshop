<main>
    <div class="position-relative">
        <section class="section-shaped my-banner-sec">
            <div class="shape shape-style-1" style="background-color:rgb(244, 245, 247); position: fixed">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <!--banner begins-->
            <div class="container" style="background-color:#fff">
                <div class="row banner-row" style="height:auto; transition:0.2s all; border-bottom: 1px solid; border-color:rgb(240, 241, 243) !important; border-right:1px solid; border-left:1px solid">
                    <div class="banner-left" style="width:194px">
                        <div class="banner-left-list">
                            <div class="epp-blue">Categories</div>
                            @foreach($categories as $cat)
                            <li class="catdropdown">
                                <a class="catdropdown-toggle" href="{{ route('get.bookfromCategory', ['name' => $cat->category, 'id' => $cat->id]) }}"><i class="{{ $cat->icon }}"></i>{{ $cat->category }}
                                </a>
                                <ul class="catdropdown-menu">
                                    @foreach($subCat as $sub)
                                        @if ($cat->id == $sub->cat_id)
                                            <li class="subcatdropdown">
                                                <a href="" class="subcatdropdown-toggle">{{ $sub->sub_category1 }}</a>
                                                <ul class="subcatdropdown-menu">
                                                    @foreach($subCat2 as $sub2)
                                                        @if ($sub2->cat_id == $cat->id && $sub2->sub_catid == $sub->id)
                                                            <li><a href="">{{ $sub2->sub_category2 }}</a></li>
                                                        @endif
                                                        @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                            <li><a href="#"><i class="zmdi zmdi-more"></i>More Categories</a></li>
                        </div>
                    </div>
                    <div class="banner-main"  style="width:790px; margin:0;">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"><span>1</span></li>
                                <li data-target="#myCarousel" data-slide-to="1"><span>2</span></li>
                                <li data-target="#myCarousel" data-slide-to="2"><span>3</span></li>
                                <li data-target="#myCarousel" data-slide-to="3"><span>4</span></li>
                                <li data-target="#myCarousel" data-slide-to="4"><span>5</span></li>
                                <li data-target="#myCarousel" data-slide-to="5"><span>6</span></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-01.jpg') }}" alt="First slide"/>
                                </div>
                                <div class="carousel-item">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-02.jpg') }}" alt="Second slide"/>
                                </div>
                                <div class="carousel-item">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-03.jpg') }}" alt="Third slide"/>
                                </div>
                                <div class="carousel-item">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-04.jpg') }}" alt="Fourth slide"/>
                                </div>
                                <div class="carousel-item">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-05.jpg') }}" alt="Fifth slide"/>
                                </div>
                                 <div class="carousel-item">
                                    <img class="itemimg" style="width:100%" src="{{ URL::to('img/web-banner-06.jpg') }}" alt="Sixth slide"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-right" style="width:194px; padding: 0 5px">
                        <a href="http://www.eppbookservices.com/" target="new">
                            <img src="/img/ghana_books_ad-2.jpg" alt="ad content" style="height:100%; width:100%; border-radius: 5px" />
                        </a>
                    
                    </div>
                </div>
            </div>
        </section>
        <!-- 1st Hero Variation -->
    </div>

    <section class="my-section">
        <div class="container" style="background-color:transparent; display: none">
            <div class="featured-cont-head">
                <div class="col-8 d-flex">
                    <div>
                        <div class="badge badge-circle badge-primary mr-3">
                            <i class="ni ni-settings-gear-65"></i>
                        </div>
                    </div>
                    <div>
                        <h3>Featured Categories</h3>
                    </div>
                </div>
                <div class="col-4 head-val"><a href="{{ route('get.booktype', ['book-type' => 'featuredcategories']) }}" class="btn badge badge-pill view-all"><small>View all</small></a></div>
            </div>
            <div class="mg--30 my-flex featured-cat-row">
                <div class="col-3"><img src="{{ URL::to('img/featured-cat-01.jpg') }}" />
                    <div class="feature-cat-overlay">
                        <div>Management</div>
                    </div>
                </div>
                <div class="col-3"><img src="{{ URL::to('img/featured-cat-02.jpg') }}" />
                    <div class="feature-cat-overlay">
                        <div>Medicine</div>
                    </div>
                </div>
                <div class="col-3"><img src="{{ URL::to('img/featured-cat-03.jpg') }}" />
                    <div class="feature-cat-overlay">
                        <div>Engineering</div>
                    </div>
                </div>
                <div class="col-3"><img src="{{ URL::to('img/featured-cat-04.jpg') }}" />
                    <div class="feature-cat-overlay">
                        <div>Children's books</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-section" >
        <div class="container" style="background-color:#fff; box-shadow:0 0 2rem 0 rgba(136, 152, 170, .15);border-radius:5px">
            <div class="my-row">
                <div class="container-head hm-header-blue">
                    <div class="col-8 d-flex">
                        <div>
                            <div class="badge badge-circle badge-primary mr-3">
                                <i class="ni ni-settings-gear-65"></i>
                            </div>
                        </div>
                        <div>
                            <h3>Featured Books</h3>
                        </div>
                    </div>
                    <div class="col-4 head-val"><a href="{{ route('get.booktype', ['book-type' => 'featured']) }}" class="badge btn badge-pill view-all"><small>View all</small></a></div>
                </div>
                <div class="my-flex book-main-row">
                    <?php $ft_count = 0; ?>
                    @foreach($books as $book)
                    @if ($book->featured_books == true)
                                <?php if($ft_count == 6) break; ?>

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
                            <small class="cart-added-status cart_added_{{ $book->id }}"></small>
                            <div class="cart-lazy-loader" id="ft-cart-lazyload-{{ $book->id }}"></div>
                    </div>
                </div>
                                    <?php $ft_count++; ?>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- distractor row -->
    <section class="my-section" >
        <div class="container" style="background-color:#fff; box-shadow:0 0 2rem 0 rgba(136, 152, 170, .15);border-radius:5px">
            <div class="my-row row">
                <div class="col-md-6 distrator-col-left">
                    <img src="{{ URL::to('img/stationary-1.jpg') }}" style="width: 100%; border-radius: 4px">
                </div>
                <div class="col-md-6 distrator-col-right">
                    <img src="{{ URL::to('img/stationary-2.jpg') }}" style="width: 100%;border-radius: 4px">
                </div>
            </div>
        </div>
    </section>
    <!-- distractor ends -->

    <section class="my-section" >
        <div class="container" style="background-color:#fff; box-shadow:0 0 2rem 0 rgba(136, 152, 170, .15);border-radius:5px">
            <div class="my-row">
                <div class="container-head hm-header-blue">
                    <div class="col-8 d-flex">
                        <div>
                            <div class="badge badge-circle badge-primary mr-3">
                                <i class="ni ni-settings-gear-65"></i>
                            </div>
                        </div>
                        <div>
                            <h3>Best Sellers</h3>
                        </div>
                    </div>
                    <div class="col-4 head-val"><a href="{{ route('get.booktype', ['book-type' => 'bestseller']) }}" class="badge btn badge-pill view-all"><small>View all</small></a></div>
                </div>

                <div class="my-flex book-main-row">
                    <?php $bs_count = 0 ?>
                    @foreach($books as $book)
                        @if ($book->best_seller == true)
                            <?php if ($bs_count == 6 ) break; ?>
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
                                        <form id="bestseller-form-{{ $book->id }}" class="addTocartForm" onsubmit="return false;" method="POST">
                                            <input type="hidden" name="itemId" id="bestseller_inp_{{ $book->id }}" value="{{ $book->id }}">
                                            <button class="btn btn-icon epp-blue-bg add-to-cart add-to-cartbtn" data-load="bs-cart-lazyload-{{ $book->id }}" data-id="{{ $book->id }}" data-target="bestseller_inp_{{ $book->id }}" type="submit">
                                                <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                                                <span class="btn-inner--text my-hm-adtcart">Add to cart</span>
                                            </button>
                                        </form>
                                    </div>
                                    <small class="cart-added-status cart_added_{{ $book->id }}"></small>
                                    <div class="cart-lazy-loader" id="bs-cart-lazyload-{{ $book->id }}"></div>
                                </div>
                            </div>
                            <?php $bs_count++ ?>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </section>


    <!-- distractor row -->
    <section class="my-section" >
        <div class="container" style="background-color:#fff; box-shadow:0 0 2rem 0 rgba(136, 152, 170, .15);border-radius:5px">
            <div class="my-row row">
                <div class="col-md-6 distrator-col-left">
                    <img src="{{ URL::to('img/stationary-3.jpg') }}" style="width: 100%; border-radius: 4px">
                </div>
                <div class="col-md-6 distrator-col-right">
                    <img src="{{ URL::to('img/stationary-4.jpg') }}" style="width: 100%;border-radius: 4px">
                </div>
            </div>
        </div>
    </section>
    <!-- distractor ends -->

    <section class="my-section" >
        <div class="container" style="background-color:#fff; box-shadow:0 0 2rem 0 rgba(136, 152, 170, .15);border-radius:5px">
            <div class="my-row">
                <div class="container-head hm-header-blue">
                    <div class="col-8 d-flex">
                        <div>
                            <div class="badge badge-circle badge-primary mr-3">
                                <i class="ni ni-settings-gear-65"></i>
                            </div>
                        </div>
                        <div>
                            <h3>New Arivals</h3>
                        </div>
                    </div>
                    <div class="col-4 head-val"><a href="{{ route('get.booktype', ['book-type' => 'newarrivals']) }}" class="badge btn badge-pill view-all"><small>View all</small></a></div>
                </div>

                <div class="my-flex book-main-row">
                    <?php $na_count = 0 ?>
                    @foreach($books as $book)
                        @if ($book->new_arrivals == true)
                            <?php if ($na_count == 6) break; ?>

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
                                        <form id="newarrivals-form-{{ $book->id }}" class="addTocartForm" onsubmit="return false;" method="POST">
                                            <input type="hidden" name="itemId" id="newarrivals_inp_{{ $book->id }}" value="{{ $book->id }}">
                                            <button class="btn btn-icon epp-blue-bg add-to-cart add-to-cartbtn" data-load="nar-cart-lazyload-{{ $book->id }}" data-id="{{ $book->id }}" data-target="newarrivals_inp_{{ $book->id }}" type="submit">
                                                <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                                                <span class="btn-inner--text my-hm-adtcart">Add to cart</span>
                                            </button>
                                        </form>
                                    </div>
                                    <small class="cart-added-status cart_added_{{ $book->id }}"></small>
                                    <div class="cart-lazy-loader" id="nar-cart-lazyload-{{ $book->id }}"></div>
                                </div>
                            </div>
                            <?php $na_count++; ?>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="my-section" >
        <div class="container">
            <div id="newsleter_hold">
                <div><h6 class="epp-dark-blue">SUBSCRIBE TO OUR NEWSLETTER</h6></div>
                <p class="epp-dark-blue">
                    Learn about new offers and get more deals by subscribing to our newsletter
                <p>
                <form method="post" action="{{ route('post.newsletter') }}" id="newsletter_form">
                    @csrf
                    <div class="form-group no-margin">
                        <div class="input-group no-margin" id="newsletter_input_group">
                            <input class="form-control newsletter-input" name="email" placeholder="Enter your email">
                            <div class="input-group-prepend" style="background-color: #fff; border-top-right-radius: 30px; border-bottom-right-radius:30px">
                                <button type="submit" class="btn epp-red-bg newsletter-btn"><span id="dynamic_span"><i id="dynamic_i" class="fa fa-send-o"></i></span><span id="newslb">Submit</span></button>
                            </div>
                        </div>
                    </div>
                </form>
                </p>
            </div>
        </div>
    </section>
</main>

