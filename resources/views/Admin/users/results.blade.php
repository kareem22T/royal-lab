@extends('Admin.layouts.main')

@section("title", "Results")

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Results of {{ $user?->name ?? "" }} </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Result service</th>
                        <th>date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Results as $cat)
                        <tr>
                            <td>{{ $cat->service_name ?? "Missing" }}</td>
                            <td>{{ $cat->date ?? "Missing" }}</td>
                            <td>{{ $cat->status == 2 ? "Completed" : "Waiting" }}</td>
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
