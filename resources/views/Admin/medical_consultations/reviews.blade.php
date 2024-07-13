@extends('Admin.layouts.main')

@section("title", "Appointments - Under Review")

@php
    $medical_consultations = App\Models\Medical_consultation::latest()->with("user")->where("status", 1)->paginate(15);
@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __("medical_consultations.reviews_consultations") }}</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>{{ __("medical_consultations.booked_by") }}</th>
                        <th>{{ __("medical_consultations.doctor") }}</th>
                        <th>{{ __("medical_consultations.status") }}</th>
                        <th>{{ __("medical_consultations.date") }}</th>
                        <th>{{ __("medical_consultations.created_at") }}</th>
                        <th>{{ __("medical_consultations.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medical_consultations as $medical_consultation)
                        <tr>
                            <td>{{ $medical_consultation->user ? $medical_consultation->user->name : __("medical_consultations.missing") }}</td>
                            <td>{{ $medical_consultation->doctor ? $medical_consultation->doctor->name : __("medical_consultations.missing") }}</td>
                            <td>
                                @if ($medical_consultation->status == 1)
                                    {{ __("medical_consultations.under_review") }}
                                @elseif ($medical_consultation->status == 2)
                                    {{ __("medical_consultations.confirmed") }}
                                @elseif ($medical_consultation->status == 3)
                                    {{ __("medical_consultations.completed") }}
                                @elseif ($medical_consultation->status == 0)
                                    {{ __("medical_consultations.canceled") }}
                                @else
                                    {{ __("medical_consultations.undefined") }}
                                @endif
                            </td>
                            <td>{{ $medical_consultation->date }}</td>
                            <td>{{ $medical_consultation->created_at }}</td>
                            <td>
                                <a href="{{ route("admin.medical_consultations.medical_consultation.details", ["id" => $medical_consultation->id]) }}" class="btn btn-success">{{ __("medical_consultations.show") }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($medical_consultations->hasPages())
        <div class="d-flex laravel_pagination mt-5">
            {!! $medical_consultations->links() !!}
        </div>
        @endif
    </div>
</div>
@endSection


@section("scripts")
<script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endSection
