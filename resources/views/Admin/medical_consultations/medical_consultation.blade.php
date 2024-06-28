@extends('Admin.layouts.main')

@section("title", "Consultation #" . $medical_consultation->id . " Details")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Consultation #{{$medical_consultation->id}} Details</h1>
    <a href="{{ route("admin.medical_consultations.show.all") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
</div>
<div class="card p-3 mb-3">
    <h2>Ordered by:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>User Name</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->name : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Email</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->email : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Phone</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->phone : "Missing" }}</span>
        </div>
    </div>
    <hr>
    <h2>Consultation Details:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>Doctor Name</label>
            <span class="form-control">{{ $medical_consultation->doctor?->name ?? "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>Specialization</label>
            <span class="form-control">{{ $medical_consultation->specialization?->name ?? "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>Date</label>
            <span class="form-control">{{ $medical_consultation->date ?? "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>Created at</label>
            <span class="form-control">{{ $medical_consultation->created_at ?? "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>Status</label>
            <span class="form-control">
                {{ $medical_consultation->status == 1 ? "Under Review" : ($medical_consultation->status == 2 ? "Confirmed" : ( ($medical_consultation->status == 3 ? "Completed" : ($medical_consultation->status == 0 ? "Canceled" : "Undifiened")))) }}
            </span>
        </div>
    </div>
    <hr>

    <div class="btns d-flex gap-3 justify-content-center">

        @if($medical_consultation->status !== 3 && $medical_consultation->status !== 0)
            <a href="{{route('admin.medical_consultations.approve', ['id' => $medical_consultation->id])}}" class="btn btn-success w-25 m-2">
                {{ $medical_consultation->status === 1 ? "Confirm!" : '' }}
                {{ $medical_consultation->status === 2 ? "Complete!" : '' }}
            </a>
        @endif

        @if($medical_consultation->status !== 3 && $medical_consultation->status !== 0)
            <a href="{{route('admin.medical_consultations.cancel', ['id' => $medical_consultation->id])}}"class="btn btn-danger w-25 m-2">Cancel</a>
        @endif
    </div>

</div>

@endSection
