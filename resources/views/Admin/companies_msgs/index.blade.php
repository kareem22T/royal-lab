@extends('Admin.layouts.main')

@section("title", "Companies Messages")

@php
    $Prescriptions = App\Models\Companies_msg::all();
@endphp

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Companies Messages</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Msg From</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Prescriptions as $cat)
                        <tr>
                            <td>{{ $cat->where }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->email }}</td>
                            <td>{{ $cat->subject }}</td>
                            <td>{{ $cat->notes }}</td>
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
