@extends('Admin.layouts.main')

@section("title", "Medical consultation #" . $medical_consultation->id . " Approve")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center w-100" style="font-weight: 700">
        Are you sure you want to
        {{ $medical_consultation->status === 1 ? "Confirm" : '' }}
        {{ $medical_consultation->status === 2 ? "Complete" : '' }}
         this medical consultation?
    </h1>
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
    </div>

    @if($medical_consultation->status !== 4 && $medical_consultation->status !== 0)
        <form action="{{route('admin.medical_consultations.approve.post', ['id' => $medical_consultation->id])}}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-success w-50 m-2">
                {{ $medical_consultation->status === 1 ? "Confirm!" : '' }}
                {{ $medical_consultation->status === 2 ? "Complete!" : '' }}
            </button>
        </form>
    @endif

</div>

@endSection
