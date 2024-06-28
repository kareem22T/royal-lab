@extends('Admin.layouts.main')

@section("title", "Visits - Completed")

@php
    $visits = App\Models\Visit::latest()->with("user")->where("status", 0)->paginate(15);

@endphp

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Visits - canceled</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive p-2">
            <table class="table table-bvisited" width="100%" cellspacing="0" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>Visited by</th>
                        <th>Address</th>
                        <th>Service</th>
                        <th>phone</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td>{{ $visit->user ? $visit->user->name : "Missing" }}</td>
                            <td>{{ $visit->address }}</td>
                            <td>{{ $visit->service }}</td>
                            <td>{{ $visit->phone }}</td>
                            <td>{{ $visit->status == 1 ? "Under Review" : ($visit->status == 2 ? "Confirmed" : ( ($visit->status == 3 ? "Completed" : ($visit->status == 0 ? "Canceled" : "Undifiened")))) }}</td>
                            <td>{{ $visit->date }}</td>
                            <td>{{ $visit->created_at }}</td>
                            <td>
                                <a href="{{ route("admin.visits.visit.details", ["id" => $visit->id]) }}" class="btn btn-success">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($visits->hasPages())
            <div class="d-flex laravel_pagination mt-5">
                {!! $visits->links() !!}
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
