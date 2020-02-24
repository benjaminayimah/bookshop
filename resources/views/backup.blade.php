<table class="table align-items-center table-flush">
    <tbody>
    @foreach($books as $book)
        <tr>
            <th scope="row" class="category-list">
                <img src="{{ route('get.bookImgs', ['filename' => $book->image]) }}" alt="{{ $book->title }}" style="height: 100px">
            </th>
            <td>
                Title: {{ $book->title }}
            </td>
            <td>
                Category: {{ $book->category }}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<div class="modal fade" id="modal_book_edit" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title">Edit Book</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="book_uploadform" style="width: 100%;" action="{{ route('post.bookUpload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-row" style="display: flex; flex-wrap: wrap">
                        <div class="form-group col-md-6">
                            <label for="title">Title:</label>
                            <div id="bke_title"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category">Category:</label>
                            <select name="category" id="bke_category" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="subcat">1st sub-category:</label>
                            <select name="subCategory1" id="bke_subcat1" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-row" style="display: flex; flex-wrap: wrap">
                        <div class="form-group col-md-3">
                            <label for="subcat2">2nd sub-category:</label>
                            <select name="subCategory2" id="bke_subcat2" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="price">Price:</label>
                            <div id="bke_price"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="discount">Discount:</label>
                            <div id="bke_disnt"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="publisher">Publisher:</label>
                            <div id="bke_publisher"></div>
                        </div>
                    </div>
                    <div class="form-row" style="display: flex; flex-wrap: wrap; padding-left: 25px; margin: 10px 0 15px 0">
                        <div id="bke_bst_seller" class="col-md-4 custom-control custom-checkbox">
                            <span id=""></span>
                            <label class="custom-control-label" for="bke_bst_sell">
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
                            <input name="isbn" class="form-control" id="isbn" placeholder="ISBN">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="description">Book Description:</label>
                            <textarea name="description" class="form-control" rows="2" id="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="img">Choose image:</label>
                            <input type="file" id="img" name="bookImage" class="form-control">
                        </div>
                    </div>
                    <div class="form-row" style="padding-top: 10px; margin: 0">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<th>
<div class="list-inner-btn" id="inner_btn{{ $category->id }}">
    <button class="btn btn-success btn-round btn-sm category-edit" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-edit"></i> Edit</button>
    <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-danger btn-round btn-sm category-delete" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-delete"></i> Delete</button>
</div>
</th>




@foreach($categories as $category)
    <tr>
        <th scope="row" class="category-list" data-toggle="inner_btn{{ $category->id }}">
            {{ $category->category }} <span class="zmdi zmdi-chevron-right"></span> <a href="javascript: void (0)" data-id="sub_list_{{ $category->id }}" data-content="{{ $category->category }}">View sub-category</a>
            <ul class="sub-categories" id="sub_list_{{ $category->id }}">
            </ul>

            <div class="list-inner-btn" id="inner_btn{{ $category->id }}">
                <button class="btn btn-success btn-round btn-sm category-edit" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-edit"></i> Edit</button>
                <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-danger btn-round btn-sm category-delete" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-delete"></i> Delete</button>
            </div>
        </th>
    </tr>
@endforeach

