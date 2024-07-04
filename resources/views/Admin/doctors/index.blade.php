@extends('Admin.layouts.main')

@section("title", __("doctors.doctors"))

@php
    $doctors = App\Models\Doctor::all();
@endphp

@section("content")
<style>
    #dataTable_wrapper {
        width: 100%;
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __("doctors.doctors") }}</h1>
    <a href="{{ route("admin.doctors.add") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ __("doctors.create_doctor") }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __("doctors.name") }}</th>
                        <th>{{ __("doctors.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>
                                <a href="{{ route("admin.doctors.edit", ["id" => $doctor->id]) }}" class="btn btn-success">{{ __("doctors.edit") }}</a>
                                <a href="{{ route("admin.doctors.delete.confirm", ["id" => $doctor->id]) }}" class="btn btn-danger">{{ __("doctors.delete") }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endSection

@section("scripts")
<script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endSection
