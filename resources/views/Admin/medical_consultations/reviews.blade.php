@extends('Admin.layouts.main')

@section("title", "Appointments - Under Review")

@php
    $appointments = App\Models\Appointment::latest()->with("user")->where("status", 1)->paginate(15);
@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Appointments - Under Review</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bconsultationed" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <tr>
                            <th>Booked by</th>
                            <th>Doctor</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultations as $consultation)
                            <tr>
                                <td>{{ $consultation->user ? $consultation->user->name : "Missing" }}</td>
                                <td>{{ $consultation->doctor?->name ?? "Missing" }}</td>
                                <td>{{ $consultation->specialization?->name ?? "Missing" }}</td>
                                <td>{{ $consultation->status == 1 ? "Under Review" : ($consultation->status == 2 ? "Confirmed" : ($consultation->status == 3 ? "On Shipping" : ($consultation->status == 4 ? "Completed" : ($consultation->status == 0 ? "Canceled" : "Undifiened")))) }}</td>
                                <td>{{ $consultation->date }}</td>
                                <td>{{ $consultation->created_at }}</td>
                                <td>
                                    <a href="{{ route("admin.appointments.appointment.details", ["id" => $appointment->id]) }}" class="btn btn-success">Show</a>
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
