@extends('Admin.layouts.main')

@section("title", "Orders - Under Review")

@php
    $orders = App\Models\Order::latest()->with("user")->where("status", 1)->paginate(15);
@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang("orders.reviews_orders")</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>@lang("orders.ordered_by")</th>
                        <th>@lang("orders.recipient_name")</th>
                        <th>@lang("orders.recipient_phone")</th>
                        <th>@lang("orders.recipient_address")</th>
                        <th>@lang("orders.sub_total")</th>
                        <th>@lang("orders.status")</th>
                        <th>@lang("orders.date")</th>
                        <th>@lang("orders.actions")</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->user ? $order->user->name : __("orders.missing") }}</td>
                            <td>{{ $order->recipient_name }}</td>
                            <td>{{ $order->recipient_phone }}</td>
                            <td>{{ $order->recipient_address }}</td>
                            <td>{{ $order->sub_total }}</td>
                            <td>{{ $order->status == 1 ? __("orders.under_review") : ($order->status == 2 ? __("orders.confirmed") : ($order->status == 3 ? __("orders.completed") : ($order->status == 0 ? __("orders.canceled") : __("orders.undefined")))) }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <a href="{{ route("admin.orders.order.details", ["id" => $order->id]) }}" class="btn btn-success">@lang("orders.show")</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
        <div class="d-flex laravel_pagination mt-5">
            {!! $orders->links() !!}
        </div>
        @endif

    </div>
</div>

@endSection


@section("scripts")
<script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endSection
