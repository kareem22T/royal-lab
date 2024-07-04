@extends('Admin.layouts.main')

@section("title", "Appointments - Confirmed")

@php
    $appointments = App\Models\Appointment::latest()->with("user")->where("status", 2)->paginate(15);
@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('appointments.confirmed_appointments')</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>@lang('appointments.booked_by')</th>
                        <th>@lang('appointments.user_name')</th>
                        <th>@lang('appointments.user_phone')</th>
                        <th>@lang('appointments.user_age')</th>
                        <th>@lang('appointments.status')</th>
                        <th>@lang('appointments.date')</th>
                        <th>@lang('appointments.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->user ? $appointment->user->name : __('appointments.missing') }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->age }}</td>
                            <td>
                                {{ $appointment->status == 1 ? __('appointments.under_review') : ($appointment->status == 2 ? __('appointments.confirmed') : ($appointment->status == 3 ? __('appointments.completed') : ($appointment->status == 0 ? __('appointments.canceled') : __('appointments.undefined')))) }}
                            </td>
                            <td>{{ $appointment->date }}</td>
                            <td>
                                <a href="{{ route('admin.appointments.appointment.details', ['id' => $appointment->id]) }}" class="btn btn-success">@lang('appointments.show')</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($appointments->hasPages())
        <div class="d-flex laravel_pagination mt-5">
            {!! $appointments->links() !!}
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
