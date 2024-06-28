@extends('Admin.layouts.main')

@section("title", "Appointment #" . $appointment->id . " Approve")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center w-100" style="font-weight: 700">
        Are you sure you want to
        {{ $appointment->status === 1 ? "Confirm" : '' }}
        {{ $appointment->status === 2 ? "Complete" : '' }}
         this appointment?
    </h1>
</div>
<div class="card p-3 mb-3">
    <h2>Appointmentd by:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>User Name</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->name : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Email</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->email : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Phone</label>
            <span class="form-control">{{ $appointment->user ? $appointment->user->phone : "Missing" }}</span>
        </div>
    </div>
    <hr>
    <h2>Appointment Details:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>Appointment Name</label>
            <span class="form-control">{{ $appointment->name }}</span>
        </div>
        <div class="form-group">
            <label>Recipient Phone</label>
            <span class="form-control">{{ $appointment->phone }}</span>
        </div>
        <div class="form-group" style="grid-column: span 2">
            <label>Appointment Age</label>
            <span class="form-control">{{ $appointment->age }}</span>
        </div>
    </div>

    @if($appointment->status !== 4 && $appointment->status !== 0)
        <form action="{{route('admin.appointments.approve.post', ['id' => $appointment->id])}}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-success w-50 m-2">
                {{ $appointment->status === 1 ? "Confirm!" : '' }}
                {{ $appointment->status === 2 ? "Complete!" : '' }}
            </button>
        </form>
    @endif

</div>

@endSection
