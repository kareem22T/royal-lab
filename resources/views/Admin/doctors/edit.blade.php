@extends('Admin.layouts.main')

@section("title", "Regions - Edit")
@section("loading_txt", "Update")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update doctor</h1>
    <a href="{{ route("admin.doctors.show") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
</div>

<div class="card p-3 mb-3" id="doctors_wrapper">
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name"  placeholder="doctor Name" v-model="name">
            </div>
            <div class="form-group w-100">
                <label for="name" class="form-label">Name in arabic</label>
                <input type="text" class="form-control" id="name"  placeholder="City Name in arabic" v-model="name_ar">
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <h2>Doctor specializations</h2>
        <button class="btn btn-primary" @click="handleAddSpecialization">Add Specialization</button>
     </div>
     <table class="table" v-if="specializations && specializations.length > 0">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Name in Arabic</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="specialization, index in specializations" :key="index">
            <td>
                <input type="text" name="size" id="size" class="form-control" placeholder="Name" v-model="specializations[index]['name']" required>
            </td>
            <td>
                <input type="text" name="Flavour" id="Flavour" class="form-control" placeholder="Name ar" v-model="specializations[index]['name_ar']" required>
            </td>
            <td>
                <button class="btn btn-danger" @click="handleRemoveSpecialization(index)">Remove</button>
            </td>
          </tr>
        </tbody>
      </table>
    <div class="form-group">
        <button class="btn btn-success w-25" @click="update">Update</button>
    </div>
</div>

@endSection

@section("scripts")
<script>
const { createApp, ref } = Vue

createApp({
    data() {
        return {
            id: '{{ $doctor->id }}',
            name: '{{ $doctor->name }}',
            name_ar: '{{ $doctor->name_ar }}',
            specializations: @json($doctor->specializations),

        }
    },
    methods: {
        handleChangeThumbnail(event) {
            this.thumbnail = event.target.files[0]
            this.thumbnail_path = URL.createObjectURL(event.target.files[0])
        },
        handleAddSpecialization() {
            this.specializations.push({
                name: "",
                name_ar: "",
            })
        },
        handleRemoveSpecialization(index) {
            this.specializations.splice(index, 1)
        },
        async update() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("admin.doctors.update") }}`, {
                    id: this.id,
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
