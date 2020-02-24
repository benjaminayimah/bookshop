@extends('layouts.admin')
@section('pageTitle')
    Categories
@endsection
@section('titlemain')
    <li class="breadcrumb-item"><a href="{{ route('all.books') }}">Books</a></li>
@endsection

@section('second-card')
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Book Categories</h3>
                        </div>
                        <div class=" text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add new category</button>
                        </div>
                    </div>
                </div>
                <div class="category-pagination1">{{ $categories->links() }}</div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <tbody>
                        @if($categories)
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row" class="category-list navbar-nav card-collapse" id="" role="tablist" aria-multiselectable="true">
                                    <div class="">
                                        <li role="tab" id="categoryheading{{ $category->id }}" class="category-list">
                                            <a class="nav-link" href="#sub_list_{{ $category->id }}" data-id="sub_list_{{ $category->id }}" data-content="{{ $category->id }}" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="sub_list_{{ $category->id }}">
                                                {{ $category->category  }}
                                                <i class="zmdi zmdi-chevron-down"></i>
                                            </a>
                                        </li>
                                        <ul id="sub_list_{{ $category->id }}" class="collapse" role="tabpanel" aria-labelledby="categoryheading{{ $category->id }}">
                                        </ul>
                                    </div>
                                    <div class="list-inner-btn" id="inner_btn{{ $category->id }}">
                                        <button class="btn btn-success btn-round btn-sm category-edit" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-edit"></i> Edit</button>
                                        <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-danger btn-round btn-sm category-delete" data-content="{{ $category->category }}" data-id="{{ $category->id }}"><i class="zmdi zmdi-delete"></i> Delete</button>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                            @else
                            <div class="container" id="no_catfound">No Category Found!!!<span>Start by adding a new category</span><i class="zmdi zmdi-arrow-right-top"></i></div>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="category-pagination2">{{ $categories->links() }}</div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Social traffic</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Referral</th>
                            <th scope="col">Visitors</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                Facebook
                            </th>
                            <td>
                                1,480
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">60%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Facebook
                            </th>
                            <td>
                                5,480
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">70%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Google
                            </th>
                            <td>
                                4,807
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">80%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Instagram
                            </th>
                            <td>
                                3,678
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">75%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                twitter
                            </th>
                            <td>
                                2,645
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">30%</span>
                                    <div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('post.category') }}">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="category" placeholder="Add new book category">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add sub1 Modal -->
    <div class="modal fade" id="mysubModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add sub-category 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('post.subCat1') }}">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="form-group">
                                <label for="subcat1">Add a sub-category:</label>
                                <input type="text" class="form-control" id="subcat1" name="subCategory1" placeholder="Type a new sub-category">
                                <div id="sub_catHidden" class="hidden"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add sub22 Modal -->
    <div class="modal fade" id="mysubModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add 2nd sub-category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('post.subCat2') }}">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="form-group">
                                <label for="subcat2">Add a sub-category:</label>
                                <input type="text" class="form-control" id="subcat2" name="SubCategory2" placeholder="Type a new sub-category">
                                <div id="sub_cat2Hidden" class="hidden"></div>
                                <div id="at2Hidden" class="hidden"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit Modal -->
    <div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false">
                        <div class="">
                            <div class="form-group" id="cat_input"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="editCatBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- sub catEdit Modal -->
    <div class="modal fade" id="subcat1myEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcat1EditModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('post.editsub1') }}">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="form-group" id="subcat1cat_input"></div>
                            <div class="hidden" id="subcat1cat_input_hidden"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="subcat1editCatBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- sub catEdit Modal -->
    <div class="modal fade" id="subcat2myEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subcat1EditModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="zmdi zmdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('post.editsub2') }}">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="form-group" id="subcat2cat_input"></div>
                            <div class="hidden" id="subcat2cat_input_hidden"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="subcat1editCatBtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection