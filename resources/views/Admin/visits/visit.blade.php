@extends('Admin.layouts.main')

@section("title", "Visit #" . $visit->id . " Details")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Visit #{{$visit->id}} Details</h1>
    <a href="{{ route("admin.visits.show.all") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
</div>
<div class="card p-3 mb-3">
    <h2>Visitd by:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>User Name</label>
            <span class="form-control">{{ $visit->user ? $visit->user->name : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Email</label>
            <span class="form-control">{{ $visit->user ? $visit->user->email : "Missing" }}</span>
        </div>
        <div class="form-group">
            <label>User Phone</label>
            <span class="form-control">{{ $visit->user ? $visit->user->phone : "Missing" }}</span>
        </div>
    </div>
    <hr>
    <h2>Recipient Details:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>Date</label>
            <span class="form-control">{{ $visit->date }}</span>
        </div>
        <div class="form-group">
            <label>Address</label>
            <span class="form-control">{{ $visit->address }}</span>
        </div>
        <div class="form-group" style="grid-column: span 2">
            <label>Phone</label>
            <span class="form-control">{{ $visit->phone }}</span>
        </div>
    </div>
    <hr>
    <h2>Visit Information:</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>Status</label>
            <span class="form-control">
                {{ $visit->status == 1 ? "Under Review" : ($visit->status == 2 ? "Confirmed" : ( ($visit->status == 3 ? "Completed" : ($visit->status == 0 ? "Canceled" : "Undifiened")))) }}
            </span>
        </div>
        <div class="form-group">
            <label>Created at</label>
            <span class="form-control">{{ $visit->created_at }}</span>
        </div>
    </div>

    <div class="btns d-flex gap-3 justify-content-center">

        @if($visit->status !== 3 && $visit->status !== 0)
            <a href="{{route('admin.visits.approve', ['id' => $visit->id])}}" class="btn btn-success w-25 m-2">
                {{ $visit->status === 1 ? "Confirm!" : '' }}
                {{ $visit->status === 2 ? "Complete!" : '' }}
            </a>
        @endif

        @if($visit->status !== 3 && $visit->status !== 0)
            <a href="{{route('admin.visits.cancel', ['id' => $visit->id])}}"class="btn btn-danger w-25 m-2">Cancel</a>
        @endif
    </div>

</div>

@endSection
