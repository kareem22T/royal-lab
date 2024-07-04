@extends('Admin.layouts.main')

@section("title", "Appointment #" . $appointment->id . " Cancel")

@section("content")
<div class="d-sm-flex align-items-center text-danger justify-content-between mb-4">
    <h1 class="h3 mb-0 text-danger-800 text-center w-100" style="font-weight: 700">
        @lang('appointments.cancel_appointment')
    </h1>
</div>
<div class="card p-3 mb-3">
    <h2>@lang('appointments.appointment_by')</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang('appointments.user_name')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->name : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.user_email')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->email : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>@lang('appointments.user_phone')</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->phone : "Missing" }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang('appointments.appointment_details')</h2>
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

    @if($appointment->status !== 4 && $appointment->status !== 0)
        <form action="{{route('admin.appointments.cancel.post', ['id' => $appointment->id])}}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-50 m-2">
                @lang('appointments.cancel_button')
            </button>
        </form>
    @endif

</div>
@endSection
