@extends('Admin.layouts.main')

@section("title", "Appointments - Confirmed")

@php
    $medical_consultations = App\Models\Appointment::latest()->with("user")->where("status", 2)->paginate(15);
@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Appointments - Confirmed</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bmedical_consultationed" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>Booked by</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medical_consultations as $medical_consultation)
                        <tr>
                            <td>{{ $medical_consultation->user ? $medical_consultation->user->name : "Missing" }}</td>
                            <td>{{ $medical_consultation->doctor ? $medical_consultation->doctor->name : "Missing" }}</td>
                            <td>{{ $medical_consultation->status == 1 ? "Under Review" : ($medical_consultation->status == 2 ? "Confirmed" : (($medical_consultation->status == 3 ? "Completed" : ($medical_consultation->status == 0 ? "Canceled" : "Undifiened")))) }}</td>
                            <td>{{ $medical_consultation->date }}</td>
                            <td>{{ $medical_consultation->created_at }}</td>
                            <td>
                                <a href="{{ route("admin.medical_consultations.medical_consultation.details", ["id" => $medical_consultation->id]) }}" class="btn btn-success">Show</a>
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
