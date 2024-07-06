@extends('Admin.layouts.main')

@section("title", "Comments")

@php
    $Prescriptions = App\Models\Comment::latest()->get();
@endphp

@section("content")
<style>
    #dataTable_wrapper{
        width: 100%
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Comment</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="width: 100%;">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __("prescriptions.user_name") }}</th>
                        <th>{{ __("prescriptions.user_email") }}</th>
                        <th>{{ __("prescriptions.user_phone") }}</th>
                        <th>{{ "Message" }}</th>
                        <th>{{ __("prescriptions.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Prescriptions as $cat)
                        <tr>
                            <td>{{ $cat->name ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->email ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->phone ?? __("prescriptions.missing") }}</td>
                            <td>{{ $cat->comment ?? __("prescriptions.na") }}</td>
                            <td>
                                @if($cat->show)
                                    <form method="POST" action="{{route('admin.comment.shownhide')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$cat->id}}">
                                        <button type="submit" class="btn btn-danger">Hide</button>
                                    </form>
                                    @else
                                    <form method="POST" action="{{route('admin.comment.shownhide')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$cat->id}}">
                                        <button type="submit" class="btn btn-success">Show</button>
                                    </form>
                                @endif
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
