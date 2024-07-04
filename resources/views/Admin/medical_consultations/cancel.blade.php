@extends('Admin.layouts.main')

@section("title", __("medical_consultation_cancel.title", ['id' => $medical_consultation->id]))

@section("content")
<div class="d-sm-flex align-items-center text-danger justify-content-between mb-4">
    <h1 class="h3 mb-0 text-danger-800 text-center w-100" style="font-weight: 700">
        @lang("medical_consultation_cancel.confirm_prompt")
    </h1>
</div>
<div class="card p-3 mb-3">
    <h2>@lang("medical_consultation_cancel.ordered_by")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultation_cancel.user_name")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->name : __("medical_consultation_cancel.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_cancel.user_email")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->email : __("medical_consultation_cancel.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_cancel.user_phone")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->phone : __("medical_consultation_cancel.missing") }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("medical_consultation_cancel.consultation_details")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultation_cancel.doctor_name")</label>
            <span class="form-control">{{ $medical_consultation->doctor?->name ?? __("medical_consultation_cancel.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultation_cancel.specialization")</label>
            <span class="form-control">{{ $medical_consultation->specialization?->name ?? __("medical_consultation_cancel.missing") }}</span>
        </div>
    </div>

    @if($medical_consultation->status !== 4 && $medical_consultation->status !== 0)
        <form action="{{ route('admin.medical_consultations.cancel.post', ['id' => $medical_consultation->id]) }}" class="btns d-flex gap-3 justify-content-center" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-50 m-2">
                @lang("medical_consultation_cancel.cancel_button")
            </button>
        </form>
    @endif

</div>

@endSection
