@extends('Admin.layouts.main')

@section("title", "Teams")

@php
    $teams = App\Models\Team::all();
@endphp

@section("content")
<style>
    #dataTable_wrapper {
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Teams</h1>
    <a href="{{ route("admin.teams.add") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create Team</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: auto">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $prod)
                        <tr>
                            <td>{{ $prod->name }}</td>
                            <td>{{ substr($prod->position, 0, 100) }}</td>
                            <td>
                                <div class="btns" style="display: flex;gap: 4px">
                                    <a href="{{ route("admin.teams.edit", ["id" => $prod->id]) }}" class="btn btn-success">Edit</a>
                                    <a href="{{ route("admin.teams.delete.confirm", ["id" => $prod->id]) }}" class="btn btn-danger">Delete</a>
                                </div>
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
