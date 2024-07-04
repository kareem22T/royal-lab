@extends('Admin.layouts.main')

@section("title", __("consultations.title"))

@php
    $consultations = App\Models\Consultation::all();
@endphp

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __("consultations.title") }}</h1>
    <a href="{{ route("admin.consultations.add") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ __("consultations.create_consultation") }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __("consultations.name") }}</th>
                        <th>{{ __("consultations.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultations as $cat)
                        <tr>
                            <td>{{ $cat->name }}</td>
                            <td>
                                <a href="{{ route("admin.consultations.edit", ["id" => $cat->id]) }}" class="btn btn-success">{{ __("consultations.edit") }}</a>
                                <a href="{{ route("admin.consultations.delete.confirm", ["id" => $cat->id]) }}" class="btn btn-danger">{{ __("consultations.delete") }}</a>
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
