@extends('Admin.layouts.main')

@section("title", __("orders.cancel_title", ['id' => $order->id]))

@section("content")
<div class="d-sm-flex align-items-center text-danger justify-content-between mb-4">
    <h1 class="h3 mb-0 text-danger-800 text-center w-100" style="font-weight: 700">
        @lang("orders.confirm_cancel")
    </h1>
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
            <span class="form-control">{{ $order->user->email }}</span>
        </div>
        <div class="form-group">
            <label>@lang("orders.user_phone")</label>
            <span class="form-control">{{ $order->user->phone }}</span>
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
                {{ $order->status == 1 ? __("orders.under_review") : ($order->status == 2 ? __("orders.confirmed") : ($order->status == 3 ? __("orders.completed") : ($order->status == 4 ? __("orders.completed") : ($order->status == 0 ? __("orders.canceled") : __("orders.undefined"))))) }}
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

    @if($order->status !== 4 && $order->status !== 0)
        <form action="{{route('admin.orders.cancel.post', ['id' => $order->id])}}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-50 m-2">
                @lang("orders.cancel_button")
            </button>
        </form>
    @endif

</div>
@endsection
