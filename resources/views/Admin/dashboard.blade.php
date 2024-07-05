@extends("Admin.layouts.main")

@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>
    <form action="/admin/store-settings" enctype="multipart/form-data" id="wrapper" method="POST" class="card p-4">
        @csrf
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Hero Section</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Contact</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="form-group">
                    <input type="text" name="hero_tex" id="hero_tex" class="form-control" placeholder="Hero Text" value="{{(isset($settingsArray["hero_tex"]) && $settingsArray["hero_tex"]["value"]) ? $settingsArray["hero_tex"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="hero_tex_ar" id="hero_tex_ar" class="form-control" placeholder="Hero Text in arabic" value="{{(isset($settingsArray["hero_tex_ar"]) && $settingsArray["hero_tex_ar"]["value"]) ? $settingsArray["hero_tex_ar"]["value"] : ''}}">
                </div>
                <div class="w-100 form-group">
                    <label for="gallary" class="form-control"
                    style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 140px; font-size: 22px;">Upload
                    Hero Images*
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-plus" width="55"
                        height="55" viewBox="0 0 24 24" stroke-width="2" stroke="#2c3e50" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 8h.01"></path>
                        <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5"></path>
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"></path>
                        <path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54"></path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                    </svg>
                </label>
                    <input type="file" id="gallary" name="hero_gallary[]" multiple="" class="form-control" @change="handleChangeImages" style="display: none;">
                </div>
                <div id="preview-gallery" class="mt-3">
                    <div class="row" v-if="images_path && images_path.length > 0">
                       <div v-for="(img, index) in images_path" :key="index"
                          class="col-lg-3 col-md-6 mb-4">
                          <img :src="img"
                             style="width: 100%; height: 250px; object-fit: cover;" alt="gallery">
                       </div>
                    </div>
                    <div class="row" v-if="!images_path || images_path.length == 0">
                       <div v-for="(img, index) in images_path_main" :key="index"
                          class="col-lg-3 col-md-6 mb-4">
                          <img :src="img"
                             style="width: 100%; height: 250px; object-fit: cover;" alt="gallery">
                       </div>
                    </div>
                 </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="form-group">
                    <input type="text" name="facebook_url" id="facebook_url" class="form-control" placeholder="Facebook Url" value="{{(isset($settingsArray["facebook_url"]) && $settingsArray["facebook_url"]["value"]) ? $settingsArray["facebook_url"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="instagram_url" id="instagram_url" class="form-control" placeholder="Instagram Url" value="{{(isset($settingsArray["instagram_url"]) && $settingsArray["instagram_url"]["value"]) ? $settingsArray["instagram_url"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="linkedin_url" id="linkedin_url" class="form-control" placeholder="Linked In Url" value="{{(isset($settingsArray["linkedin_url"]) && $settingsArray["linkedin_url"]["value"]) ? $settingsArray["linkedin_url"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="whatsapp_url" id="whatsapp_url" class="form-control" placeholder="Whatsapp Url" value="{{(isset($settingsArray["whatsapp_url"]) && $settingsArray["whatsapp_url"]["value"]) ? $settingsArray["whatsapp_url"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="location_url" id="location_url" class="form-control" placeholder="Location Url" value="{{(isset($settingsArray["location_url"]) && $settingsArray["location_url"]["value"]) ? $settingsArray["location_url"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{(isset($settingsArray["phone"]) && $settingsArray["phone"]["value"]) ? $settingsArray["phone"]["value"] : ''}}">
                </div>

            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

@endSection

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.30/vue.cjs.min.js" integrity="sha512-0iiTIkY3h448LMfv6vcOAgwsnSIQ4QYgSyAbyWDtqrig7Xc8PAukJjyXCeYxVGncMyIbd6feVBRwoRayeEvmJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
const { createApp, ref } = Vue

createApp({
    data() {
        return {
            images_path_main: @json((isset($settingsArray["hero_gallary"]) && $settingsArray["hero_gallary"]["value"]) ? json_decode($settingsArray["hero_gallary"]["value"]) : []),
            images_path: [],
            images: []
        }
    },
    methods: {
        handleChangeImages(event) {
            let files = Array.from(event.target.files)
            files.map(file => {
                this.images.push(file)
                this.images_path.push(URL.createObjectURL(file))
            })
        },
        handleDeleteImage(index) {
            let arr = this.images
            arr.splice(index, 1)
            this.images = arr
            let arr_paths  = this.images_path
            arr_paths.splice(index, 1)
            this.images_path = arr_paths
        },
    },
}).mount('#wrapper')
</script>
@endSection

