@extends('Admin.layouts.main')

@section("title", "Prescriptions")

@php
    $Prescriptions = App\Models\Prescription::with("user")->get();
@endphp

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Prescriptions</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>User name</th>
                        <th>User email</th>
                        <th>User phone</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Prescriptions as $cat)
                        <tr>
                            <td>{{ $cat->user?->name ?? "Missing" }}</td>
                            <td>{{ $cat->user?->email ?? "Missing" }}</td>
                            <td>{{ $cat->user?->phone ?? "Missing" }}</td>
                            <td>{{ $cat->notes ?? "N/A" }}</td>
                            <td>
                                <a href="{{ $cat->file_path }}" download="download" target="_blank" class="btn btn-success">Download</a>
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
