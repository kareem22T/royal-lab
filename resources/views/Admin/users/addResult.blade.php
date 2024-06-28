@extends('Admin.layouts.main')

@section("title", "Results - Create")
@section("loading_txt", "Create")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Result to {{ $user->name }}</h1>
    <a href="{{ route("admin.users") }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
</div>

<div class="card p-3 mb-3" id="Results_wrapper">
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="name" class="form-label">Service</label>
                <input type="text" class="form-control" id="name"  placeholder="Service Name" v-model="name">
            </div>
            <div class="form-group w-100">
                <label for="name" class="form-label">Service in arabic</label>
                <input type="text" class="form-control" id="name"  placeholder="Service Name in arabic" v-model="name_ar">
            </div>
            <div class="form-group w-100">
                <label for="name" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" v-model="date">
            </div>
            <div class="form-group w-100">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="" class="form-control" v-model="status">
                    <option value="1">Waiting</option>
                    <option value="2">Completed</option>
                </select>
            </div>
            <div class="form-group w-100">
                <label for="status" class="form-label">File</label>
                <input type="file" name="file" id="file" class="form-control"  @change="getFile">
            </div>
        </div>

    </div>
    <div class="form-group">
        <button class="btn btn-success w-25" @click="create">Create</button>
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
            status: null,
            date: null,
            file: null,
        }
    },
    methods: {
        getFile(e) {
            this.file = e.target.files[0]
        },
        handleChangeThumbnail(event) {
            this.thumbnail = event.target.files[0]
            this.thumbnail_path = URL.createObjectURL(event.target.files[0])
        },
        async create() {
            $('.loader').fadeIn().css('display', 'flex')
            try {
                const response = await axios.post(`{{ route("admin.results.create") }}`, {
                    service_name: this.name,
                    service_name_ar: this.name_ar,
                    date: this.date,
                    status: this.status,
                    file: this.file,
                    user_id: "{{$user->id}}",
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
                        window.location.href = response.data.data.redirct_to
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
}).mount('#Results_wrapper')
</script>
@endSection
