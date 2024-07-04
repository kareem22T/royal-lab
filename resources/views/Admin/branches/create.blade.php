@extends('Admin.layouts.main')

@section("title", "@lang('branches.create_branch')")
@section("loading_txt", "@lang('branches.create')")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('branches.create_branch')</h1>
    <a href="{{ route('admin.branches.show') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> @lang('branches.back')
    </a>
</div>

<div class="card p-3 mb-3" id="branches_wrapper">
    <div class="d-flex justify-content-between" style="gap: 16px">
        <div class="w-100">
            <div class="form-group w-100">
                <label for="address" class="form-label">@lang('branches.address')</label>
                <input type="text" class="form-control" id="address" placeholder="@lang('branches.address')" v-model="address">
            </div>
            <div class="form-group w-100">
                <label for="address_ar" class="form-label">@lang('branches.address_ar')</label>
                <input type="text" class="form-control" id="address_ar" placeholder="@lang('branches.address_ar')" v-model="address_ar">
            </div>
            <div class="form-group w-100">
                <label for="phone" class="form-label">@lang('branches.phone')</label>
                <input type="text" class="form-control" id="phone" placeholder="@lang('branches.phone')" v-model="phone">
            </div>
            <div class="form-group w-100">
                <label for="city_id" class="form-label">@lang('branches.city')</label>
                <select class="form-control" id="city_id" v-model="city_id">
                    <option value="">@lang('branches.select_city')</option>
                    <option v-for="city in cities" :value="city.id">@{{ city.name }}</option>
                </select>
            </div>
            <div class="form-group w-100">
                <label for="region_id" class="form-label">@lang('branches.region')</label>
                <select class="form-control" id="region_id" v-model="region_id">
                    <option value="">@lang('branches.select_region')</option>
                    <option v-for="region in regions" :value="region.id">@{{ region.name }}</option>
                </select>
            </div>
        </div>
    </div>
    @php
        $cities = App\Models\City::all();
        $regions = App\Models\Region::all();
    @endphp
    <div class="form-group">
        <button class="btn btn-success w-25" @click="create">@lang('branches.create')</button>
    </div>
</div>
@endsection

@section("scripts")
<script>
const { createApp, ref } = Vue;

createApp({
    data() {
        return {
            address: null,
            address_ar: null,
            phone: null,
            city_id: null,
            region_id: null,
            cities: @json($cities),
            regions: @json($regions),
        };
    },
    async mounted() {
        await this.fetchCitiesAndRegions();
    },
    methods: {
        async fetchCitiesAndRegions() {
            try {
                const citiesResponse = await axios.get('{{ route("admin.cities.get") }}');
                const regionsResponse = await axios.get('{{ route("admin.regions.get") }}');
                this.cities = citiesResponse.data.data[0];
                this.regions = regionsResponse.data.data[0];
            } catch (error) {
                console.error("Error fetching cities and regions:", error);
            }
        },
        async create() {
            $('.loader').fadeIn().css('display', 'flex');
            try {
                const response = await axios.post(`{{ route("admin.branches.create") }}`, {
                    address: this.address,
                    address_ar: this.address_ar,
                    phone: this.phone,
                    city_id: this.city_id,
                    region_id: this.region_id,
                });
                if (response.data.status === true) {
                    document.getElementById('errors').innerHTML = '';
                    let error = document.createElement('div');
                    error.classList = 'success';
                    error.innerHTML = response.data.message;
                    document.getElementById('errors').append(error);
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
}).mount('#branches_wrapper');
</script>
@endsection
