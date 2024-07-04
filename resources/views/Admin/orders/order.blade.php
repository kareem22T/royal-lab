@extends('Admin.layouts.main')

@section("title", __("orders.details_title", ['id' => $order->id]))

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang("orders.details_heading", ['id' => $order->id])</h1>
    <a href="{{ route("admin.orders.show.all") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> @lang("orders.back_button")
    </a>
</div>
<div class="card p-3 mb-3">
    <h2>@lang("orders.ordered_by")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("orders.user_name")</label>
            <span class="form-control">{{ $order->user ? $order->user->name : __("orders.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("orders.user_email")</label>
            <span class="form-control">{{ $order->user ? $order->user->email : __("orders.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("orders.user_phone")</label>
            <span class="form-control">{{ $order->user ? $order->user->phone : __("orders.missing") }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("orders.recipient_details")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("orders.recipient_name")</label>
            <span class="form-control">{{ $order->recipient_name }}</span>
        </div>
        <div class="form-group">
            <label>@lang("orders.recipient_phone")</label>
            <span class="form-control">{{ $order->recipient_phone }}</span>
        </div>
        <div class="form-group" style="grid-column: span 2">
            <label>@lang("orders.recipient_address")</label>
            <span class="form-control">{{ $order->recipient_address }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("orders.order_information")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("orders.status")</label>
            <span class="form-control">
                {{ $order->status == 1 ? __("orders.under_review") : ($order->status == 2 ? __("orders.confirmed") : ($order->status == 3 ? __("orders.completed") : ($order->status == 0 ? __("orders.canceled") : __("orders.undefined")))) }}
            </span>
        </div>
        <div class="form-group">
            <label>@lang("orders.date")</label>
            <span class="form-control">{{ $order->created_at }}</span>
        </div>
        <div class="form-group">
            <label>@lang("orders.sub_total")</label>
            <span class="form-control">{{ $order->sub_total }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("orders.order_services")</h2>
    <div class="table-responsive p-2">
        <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap;">
            <thead>
                <tr>
                    <th>@lang("orders.id")</th>
                    <th>@lang("orders.product_name")</th>
                    <th>@lang("orders.product_sold_price")</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    @if($product->product)
                        <tr>
                            <td>{{ $product->product->id }}</td>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ $product->price_in_order }}</td>
                        </tr>
                    @else
                        <tr class="text-center text-danger">
                            <td colspan="5">@lang("orders.missing_product")</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="btns d-flex gap-3 justify-content-center">
        @if($order->status !== 3 && $order->status !== 0)
            <a href="{{route('admin.orders.approve', ['id' => $order->id])}}" class="btn btn-success w-25 m-2">
                {{ $order->status === 1 ? __("orders.confirm_button") : '' }}
                {{ $order->status === 2 ? __("orders.complete_button") : '' }}
            </a>
        @endif

        @if($order->status !== 3 && $order->status !== 0)
            <a href="{{route('admin.orders.cancel', ['id' => $order->id])}}"class="btn btn-danger w-25 m-2">
                @lang("orders.cancel_button")
            </a>
        @endif
    </div>
</div>

@endsection
