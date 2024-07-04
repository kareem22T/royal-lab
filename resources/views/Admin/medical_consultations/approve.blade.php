@extends('Admin.layouts.main')

@section("title", __("medical_consultation_approve.title", ['id' => $medical_consultation->id]))

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center w-100" style="font-weight: 700">
        @lang("medical_consultation_approve.confirm_prompt", ['status' => $medical_consultation->status])
    </h1>
</div>
<div class="card p-3 mb-3">
    <h2>@lang("medical_consultation_approve.ordered_by")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultation_approve.user_name")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->name : __("medical_consultation_approve.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_approve.user_email")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->email : __("medical_consultation_approve.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_approve.user_phone")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->phone : __("medical_consultation_approve.missing") }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("medical_consultation_approve.consultation_details")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultation_approve.doctor_name")</label>
            <span class="form-control">{{ $medical_consultation->doctor?->name ?? __("medical_consultation_approve.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_approve.specialization")</label>
            <span class="form-control">{{ $medical_consultation->specialization?->name ?? __("medical_consultation_approve.missing") }}</span>
        </div>
    </div>

    @if($medical_consultation->status !== 4 && $medical_consultation->status !== 0)
        <form action="{{ route('admin.medical_consultations.approve.post', ['id' => $medical_consultation->id]) }}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-success w-50 m-2">
                @lang("medical_consultation_approve.confirm_button", ['status' => $medical_consultation->status])
            </button>
        </form>
    @endif

</div>

@endSection
<!-- Page level custom scripts -->
<script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endSection
