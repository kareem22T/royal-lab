@extends('Admin.layouts.main')

@section("title", "Jobs Requests")

@php
    $Prescriptions = App\Models\Apply_job::with("user")->get();
@endphp

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jobs Requests</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __("prescriptions.user_name") }}</th>
                        <th>{{ __("prescriptions.user_phone") }}</th>
                        <th>{{ __("prescriptions.notes") }}</th>
                        <th>{{ __("prescriptions.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Prescriptions as $cat)
                        <tr>
                            <td>{{ $cat->user?->name ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->user?->email ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->user?->phone ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->notes ?? __("prescriptions.na") }}</td>
                            <td>
                                <a href="{{ $cat->file_path }}" download="download" target="_blank" class="btn btn-success">{{ __("prescriptions.download") }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section("scripts")
<script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endsection
