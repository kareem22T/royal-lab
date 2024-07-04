@extends('Admin.layouts.main')

@section("title", __("doctors.create_doctor"))
@section("loading_txt", __("doctors.create"))

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __("doctors.create_doctor") }}</h1>
    <a href="{{ route("admin.doctors.show") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> {{ __("doctors.back") }}
    </a>
</div>

<div class="card p-3 mb-3" id="doctors_wrapper">
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="name" class="form-label">{{ __("doctors.name") }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ __("doctors.name") }}" v-model="name">
            </div>
            <div class="form-group w-100">
                <label for="name" class="form-label">{{ __("doctors.name_ar") }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ __("doctors.name_ar") }}" v-model="name_ar">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <h2>{{ __("doctors.doctor_specializations") }}</h2>
        <button class="btn btn-primary" @click="handleAddSpecialization">{{ __("doctors.add_specialization") }}</button>
    </div>
    <table class="table" v-if="specializations && specializations.length > 0">
        <thead>
          <tr>
            <th scope="col">{{ __("doctors.specialization_name") }}</th>
            <th scope="col">{{ __("doctors.specialization_name_ar") }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="specialization, index in specializations" :key="index">
            <td>
                <input type="text" class="form-control" placeholder="{{ __("doctors.specialization_name") }}" v-model="specializations[index]['name']" required>
            </td>
            <td>
                <input type="text" class="form-control" placeholder="{{ __("doctors.specialization_name_ar") }}" v-model="specializations[index]['name_ar']" required>
            </td>
            <td>
                <button class="btn btn-danger" @click="handleRemoveSpecialization(index)">{{ __("doctors.remove") }}</button>
            </td>
          </tr>
        </tbody>
      </table>
    <div class="form-group">
        <button class="btn btn-success w-25" @click="create">{{ __("doctors.create") }}</button>
    </div>
</div>

@endSection

@section("scripts")
<script>
const { createApp, ref } = Vue

createApp({
    data() {
        return {
            name: null,
            name_ar: null,
            specializations: [{
                name: "",
                name_ar: "",
            }],
        }
    },
    methods: {
        handleAddSpecialization() {
            this.specializations.push({
                name: "",
                name_ar: "",
            })
        },
        handleRemoveSpecialization(index) {
            this.specializations.splice(index, 1)
        },
        handleChangeThumbnail(event) {
            this.thumbnail = event.target.files[0]
            this.thumbnail_path = URL.createObjectURL(event.target.files[0])
        },
        async create() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("admin.doctors.create") }}`, {
                    name: this.name,
                    name_ar: this.name_ar,
                    specializations: this.specializations,
                },
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                },
                );
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
                        window.location.href = '{{ route("admin.doctors.show") }}'
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
                err.innerHTML = 'server error try again later'
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
}).mount('#doctors_wrapper')
</script>
@endSection
