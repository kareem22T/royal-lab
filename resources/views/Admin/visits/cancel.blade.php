@extends('Admin.layouts.main')

@section("title", "Visit #" . $visit->id . " Cancel")

@section("content")
<div class="d-sm-flex align-items-center text-danger justify-content-between mb-4">
    <h1 class="h3 mb-0 text-danger-800 text-center w-100" style="font-weight: 700">
        Are you sure you want to cancel
         this visit?
    </h1>
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
    @if($visit->status !== 4 && $visit->status !== 0)
        <form action="{{route('admin.visits.cancel.post', ['id' => $visit->id])}}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-50 m-2">
                Cancel
            </button>
        </form>
    @endif

</div>

@endSection
