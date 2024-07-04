@extends('Admin.layouts.main')

@section("title", "@lang('branches.delete_branch')")
@section("loading_txt", "@lang('branches.delete')")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('branches.delete_branch')</h1>
    <a href="{{ route('admin.branches.show') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> @lang('branches.back')
    </a>
</div>

<div class="card p-3 mb-3" id="branches_wrapper">
    <div class="card-header mb-3">
        <h3 class="text-danger text-center mb-0">@lang('branches.confirm_delete')</h3>
    </div>
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="name" class="form-label">@lang('branches.address')</label>
                <input type="text" class="form-control" id="name" disabled placeholder="@lang('branches.address')" v-model="name">
            </div>
        </div>
    </div>
    <div class="form-group w-100 d-flex justify-content-center" style="gap: 16px">
        <a href="{{ route('admin.branches.show') }}" class="btn btn-secondary w-25">@lang('branches.cancel')</a>
        <button class="btn btn-danger w-25" @click="deleteBranch">@lang('branches.delete')</button>
    </div>
</div>

@endsection

@section("scripts")
<script>
const { createApp } = Vue

createApp({
    data() {
        return {
            id: '{{ $Branch->id }}',
            name: '{{ $Branch->address }}',
        }
    },
    methods: {
        async deleteBranch() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("admin.branches.delete") }}`, {
                    id: this.id
                });
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = '';
                    let successMessage = document.createElement('div');
                    successMessage.classList = 'success';
                    successMessage.innerHTML = response.data.message;
                    document.getElementById('errors').append(successMessage);
                    $('#errors').fadeIn('slow');
                    setTimeout(() => {
                        $('.loader').fadeOut();
                        $('#errors').fadeOut('slow');
                        window.location.href = '{{ route("admin.branches.show") }}';
                    }, 1300);
                } else {
                    $('.loader').fadeOut();
                    document.getElementById('errors').innerHTML = '';
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div');
                        error.classList = 'error';
                        error.innerHTML = value;
                        document.getElementById('errors').append(error);
                    });
                    $('#errors').fadeIn('slow');
                    setTimeout(() => {
                        $('#errors').fadeOut('slow');
                    }, 5000);
                }
            } catch (error) {
                document.getElementById('errors').innerHTML = '';
                let err = document.createElement('div');
                err.classList = 'error';
                err.innerHTML = '@lang('branches.errors.server_error')';
                document.getElementById('errors').append(err);
                $('#errors').fadeIn('slow');
                $('.loader').fadeOut();
                setTimeout(() => {
                    $('#errors').fadeOut('slow');
                }, 3500);
                console.error(error);
            }
        }
    },
}).mount('#branches_wrapper')
</script>
@endsection
