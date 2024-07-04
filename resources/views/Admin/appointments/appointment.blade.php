@extends('Admin.layouts.main')

@section("title", "@lang('appointments.details_title', ['id' => $appointment->id])")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('appointments.details_title', ['id' => $appointment->id])</h1>
    <a href="{{ route('admin.appointments.show.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> @lang('appointments.back')
    </a>
</div>
<div class="card p-3 mb-3">
    <h2>@lang('appointments.appointed_by'):</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang('appointments.user_name')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->name : __('appointments.missing') }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.user_email')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->email : __('appointments.missing') }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.user_phone')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->phone : __('appointments.missing') }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang('appointments.appointment_details'):</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang('appointments.appointment_name')</label>
            <span class="form-control">{{ $appointment->name }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.recipient_phone')</label>
            <span class="form-control">{{ $appointment->phone }}</span>
        </div>
        <div class="form-group" style="grid-column: span 2">
            <label>@lang('appointments.appointment_age')</label>
            <span class="form-control">{{ $appointment->age }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang('appointments.appointment_info'):</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang('appointments.status')</label>
            <span class="form-control">
                {{ $appointment->status == 1 ? __('appointments.under_review') : ($appointment->status == 2 ? __('appointments.confirmed') : ($appointment->status == 3 ? __('appointments.completed') : ($appointment->status == 0 ? __('appointments.canceled') : __('appointments.undefined')))) }}
            </span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.branch')</label>
            <span class="form-control">{{ $appointment->branch?->address }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.service')</label>
            <span class="form-control">{{ $appointment->service?->name }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.date')</label>
            <span class="form-control">{{ $appointment->date }}</span>
        </div>
    </div>
    <hr>

    <div class="btns d-flex gap-3 justify-content-center">
        @if($appointment->status !== 3 && $appointment->status !== 0)
            <a href="{{ route('admin.appointments.approve', ['id' => $appointment->id]) }}" class="btn btn-success w-25 m-2">
                {{ $appointment->status === 1 ? __('appointments.confirm') : '' }}
                {{ $appointment->status === 2 ? __('appointments.complete') : '' }}
            </a>
        @endif

        @if($appointment->status !== 3 && $appointment->status !== 0)
            <a href="{{ route('admin.appointments.cancel', ['id' => $appointment->id]) }}" class="btn btn-danger w-25 m-2">
                @lang('appointments.cancel')
            </a>
        @endif
    </div>
</div>
@endSection
