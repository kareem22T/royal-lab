@extends('Admin.layouts.main')

@section("title", __("medical_consultations.title", ['id' => $medical_consultation->id]))

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang("medical_consultations.heading", ['id' => $medical_consultation->id])</h1>
    <a href="{{ route("admin.medical_consultations.show.all") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> @lang("medical_consultations.back")</a>
</div>
<div class="card p-3 mb-3">
    <h2>@lang("medical_consultations.ordered_by")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultations.user_name")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->name : __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.user_email")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->email : __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.user_phone")</label>
            <span class="form-control">{{ $medical_consultation->user ? $medical_consultation->user->phone : __("medical_consultations.missing") }}</span>
        </div>
    </div>
    <hr>
    <h2>@lang("medical_consultations.consultation_details")</h2>
    <div class="user_details" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px">
        <div class="form-group">
            <label>@lang("medical_consultations.doctor_name")</label>
            <span class="form-control">{{ $medical_consultation->doctor?->name ?? __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.specialization")</label>
            <span class="form-control">{{ $medical_consultation->specialization?->name ?? __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.date")</label>
            <span class="form-control">{{ $medical_consultation->date ?? __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.created_at")</label>
            <span class="form-control">{{ $medical_consultation->created_at ?? __("medical_consultations.missing") }}</span>
        </div>
        <div class="form-group">
            <label>@lang("medical_consultations.status")</label>
            <span class="form-control">
                @switch($medical_consultation->status)
                    @case(1)
                        @lang("medical_consultations.under_review")
                        @break
                    @case(2)
                        @lang("medical_consultations.confirmed")
                        @break
                    @case(3)
                        @lang("medical_consultations.completed")
                        @break
                    @case(0)
                        @lang("medical_consultations.canceled")
                        @break
                    @default
                        @lang("medical_consultations.undefined")
                @endswitch
            </span>
        </div>
    </div>
    <hr>

    <div class="btns d-flex gap-3 justify-content-center">

        @if($medical_consultation->status !== 3 && $medical_consultation->status !== 0)
            <a href="{{ route('admin.medical_consultations.approve', ['id' => $medical_consultation->id]) }}" class="btn btn-success w-25 m-2">
                @if($medical_consultation->status === 1)
                    @lang("medical_consultations.confirm")
                @elseif($medical_consultation->status === 2)
                    @lang("medical_consultations.complete")
                @endif
            </a>
        @endif

        @if($medical_consultation->status !== 3 && $medical_consultation->status !== 0)
            <a href="{{ route('admin.medical_consultations.cancel', ['id' => $medical_consultation->id]) }}" class="btn btn-danger w-25 m-2">@lang("medical_consultations.cancel")</a>
        @endif
    </div>

</div>

@endSection
