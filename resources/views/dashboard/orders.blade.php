@extends('layouts.admin')
@section('pageTitle')
    Orders
@endsection
@section('titlemain')

@endsection

@section('second-card')
    <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Orders</h3>
                        </div>
                        <div class=" text-right">
                            <button type="button" class="btn btn-primary btn-sm">Generate invoice</button>
                        </div>
                    </div>
                </div>
                <div class="category-pagination1">{{ $orders->links() }}</div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <tbody>
                        <tr>
                            <th>Order ID</th>
                            <th>Date ordered</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{ route('get.checkout', ['orderid' => $order->order_id]) }}" >{{ $order->order_id }}</a></td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <span class="badge badge-pill badge-warning">added to cart</span>
                                            @elseif ($order->status == 1)
                                            <span class="badge badge-pill badge-info">active order</span>
                                            @elseif($order->status == 2)
                                            <span class="badge badge-pill badge-primary">delivering</span>
                                            @elseif($order->status == 3)
                                            <span class="badge badge-pill badge-success"><i class="zmdi zmdi-check"></i> delivered</span>
                                            @elseif($order->status == 4)
                                            <span class="badge badge-pill badge-danger line-through">canceled</span>
                                            @endif
                                    </td>
                                    <td style="display: flex">
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        <form method="post" action="">
                                            @csrf
                                            <input type="hidden" name="orderID" value="{{ $order->order_id }}">
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="container" id="no_catfound">No Orders Found!!!</div>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="category-pagination2">{{ $orders->links() }}</div>
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
@endsection