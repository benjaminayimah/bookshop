@extends('layouts.customerAccMaster')

@section('customerAccLeft')
    <div class="cus-acctright-list">
        <h5 class="customer-acc-h5">Orders</h5>
        <div class="my-cus-row">
            <div class="col-md-12">
                @if (count($orders) > 0)
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="cus_order_table" class="table align-items-center table-flush no-border">
                            <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Date ordered</th>
                                <th>Status</th>
                                <th style="text-align: center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><span>{{ $order->order_id }}</span></td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="badge badge-pill badge-info">pending</span>
                                            @elseif ($order->status == 2)
                                                <span class="badge badge-pill badge-primary">delivering</span>
                                            @elseif($order->status == 3)
                                                <span class="badge badge-pill badge-success"><i class="zmdi zmdi-check"></i> delivered</span>
                                            @elseif($order->status == 4)
                                                <span class="badge badge-pill badge-danger">canceled</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; display: flex; position: relative">
                                            <a href="{{ route('get.custorderdetail', ['id' => $order->order_id]) }}" class="btn-sm btn fw-400 clear-btn epp-blue">View details</a>
                                            @if ($order->status == 3 || $order->status == 4)
                                                <form method="post" class="d-none" action="{{ route('post.delorder') }}" id="order_del_form_{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="input" value="{{ $order->order_id }}">
                                                </form>
                                                <a href="javascript: void (0)" class="btn-sm epp-blue order-del-btn" data-toggle="del_lazy_load_{{ $order->id }}" data-target="order_del_form_{{ $order->id }}"><i class="zmdi zmdi-delete"></i></a>
                                                <div class="del-lazy-loader" id="del_lazy_load_{{ $order->id }}" style="height: 20px; width: 20px; border-radius:50%; right: 0; position: absolute"></div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="cus-acc-details-holder">No order available!</div>
                @endif
            </div>
        </div>
    </div>
@stop
