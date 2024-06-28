@extends('Admin.layouts.main')

@section("title", "Appointment #" . $appointment->id . " Details")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Appointment #{{$appointment->id}} Details</h1>
    <a href="{{ route("admin.appointments.show.all") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
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
    <hr>
    <h2>Appointment Information:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>Status</label>
            <span class="form-control">
                {{ $appointment->status == 1 ? "Under Review" : ($appointment->status == 2 ? "Confirmed" : ( ($appointment->status == 3 ? "Completed" : ($appointment->status == 0 ? "Canceled" : "Undifiened")))) }}
            </span>
        </div>
        <div class="form-group">
            <label>Branch</label>
            <span class="form-control">{{ $appointment->branch->address }}</span>
        </div>
        <div class="form-group">
            <label>Service</label>
            <span class="form-control">{{ $appointment->service->name }}</span>
        </div>
        <div class="form-group">
            <label>Date</label>
            <span class="form-control">{{ $appointment->date }}</span>
        </div>
    </div>
    <hr>

    <div class="btns d-flex gap-3 justify-content-center">

        @if($appointment->status !== 3 && $appointment->status !== 0)
            <a href="{{route('admin.appointments.approve', ['id' => $appointment->id])}}" class="btn btn-success w-25 m-2">
                {{ $appointment->status === 1 ? "Confirm!" : '' }}
                {{ $appointment->status === 2 ? "Complete!" : '' }}
            </a>
        @endif

        @if($appointment->status !== 3 && $appointment->status !== 0)
            <a href="{{route('admin.appointments.cancel', ['id' => $appointment->id])}}"class="btn btn-danger w-25 m-2">Cancel</a>
        @endif
    </div>

</div>

@endSection
