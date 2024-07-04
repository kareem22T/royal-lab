@extends('Admin.layouts.main')

@section("title", __("consultations.title_delete"))
@section("loading_txt", __("consultations.loading_txt_delete"))

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __("consultations.delete_consultation") }}</h1>
    <a href="{{ route("admin.consultations.show") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> {{ __("consultations.back") }}
    </a>
</div>

<div class="card p-3 mb-3" id="consultations_wrapper">
    <div class="card-header mb-3">
        <h3 class="text-danger text-center mb-0">{{ __("consultations.confirm_delete") }}</h3>
    </div>
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="name" class="form-label">{{ __("consultations.name") }}</label>
                <input type="text" class="form-control" id="name" disabled placeholder="{{ __("consultations.name_placeholder") }}" v-model="name">
            </div>
        </div>
    </div>
    <div class="form-group w-100 d-flex justify-content-center" style="gap: 16px">
        <a href="{{ route("admin.consultations.show") }}" class="btn btn-secondary w-25">{{ __("consultations.cancel") }}</a>
        <button class="btn btn-danger w-25" @click="deleteCat">{{ __("consultations.delete_button") }}</button>
    </div>
</div>

@endSection

@section("scripts")
<script>
const { createApp, ref } = Vue

createApp({
    data() {
        return {
            id: '{{ $Consultation->id }}',
            name: '{{ $Consultation->name }}',
            description: '{{ $Consultation->description }}',
            thumbnail: null,
            thumbnail_path: '{{ $Consultation->thumbnail_path }}',
        }
    },
    methods: {
        handleChangeThumbnail(event) {
            this.thumbnail = event.target.files[0]
            this.thumbnail_path = URL.createObjectURL(event.target.files[0])
        },
        async deleteCat() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("admin.consultations.delete") }}`, {
                    id: this.id
                });
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = ''
                    let error = document.createElement('div')
                    error.classList = 'success'
                    error.innerHTML = response.data.message
                    document.getElementById('errors').append(error)
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('.loader').fadeOut()
                        $('#errors').fadeOut('slow')
                        window.location.href = '{{ route("admin.consultations.show") }}'
                    }, 1300);
                } else {
                    $('.loader').fadeOut()
                    document.getElementById('errors').innerHTML = ''
                    $.each(response.data.errors, function (key, value) {
                        let error = document.createElement('div')
                        error.classList = 'error'
                        error.innerHTML = value
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    setTimeout(() => {
                        $('#errors').fadeOut('slow')
                    }, 5000);
                }
            } catch (error) {
                document.getElementById('errors').innerHTML = ''
                let err = document.createElement('div')
                err.classList = 'error'
                err.innerHTML = '{{ __("consultations.server_error") }}'
                document.getElementById('errors').append(err)
                $('#errors').fadeIn('slow')
                $('.loader').fadeOut()
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 3500);
                console.error(error);
            }
        }
    },
}).mount('#consultations_wrapper')
</script>
@endSection
