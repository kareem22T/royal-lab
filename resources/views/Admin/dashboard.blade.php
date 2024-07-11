@extends("Admin.layouts.main")

@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>
    <form action="/admin/store-settings" enctype="multipart/form-data" id="wrapper" method="POST" class="card p-4">
        @csrf
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="true">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#last-section" type="button" role="tab" aria-controls="last-section" aria-selected="false">Last Section Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#about_us" type="button" role="tab" aria-controls="about_us" aria-selected="false">About us</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#about_royal" type="button" role="tab" aria-controls="about_royal" aria-selected="false">About Royal</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#medical_inssurence" type="button" role="tab" aria-controls="medical_inssurence" aria-selected="false">Medical Inssurence</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pharmaceutical_analyses" type="button" role="tab" aria-controls="pharmaceutical_analyses" aria-selected="false">Pharmaceutical analyses</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="tab2" role="tabpanel" aria-labelledby="pills-profile-tab">
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
            <div class="tab-pane fade" id="last-section" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="form-group">
                    <label for="">First Card</label>
                    <input type="text" name="package_1" id="package_1" class="form-control" placeholder="Package 1" value="{{(isset($settingsArray["package_1"]) && $settingsArray["package_1"]["value"]) ? $settingsArray["package_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Card</label>
                    <input type="text" name="package_2" id="package_2" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_1"]) && $settingsArray["package_1"]["value"]) ? $settingsArray["package_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Card</label>
                    <input type="text" name="package_3" id="package_3" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_3"]) && $settingsArray["package_3"]["value"]) ? $settingsArray["package_3"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">First Card arabic</label>
                    <input type="text" name="package_ar_1" id="package_ar_1" class="form-control" placeholder="Package 1" value="{{(isset($settingsArray["package_ar_1"]) && $settingsArray["package_ar_1"]["value"]) ? $settingsArray["package_ar_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Card arabic</label>
                    <input type="text" name="package_ar_2" id="package_ar_2" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_ar_1"]) && $settingsArray["package_ar_1"]["value"]) ? $settingsArray["package_ar_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Card arabic</label>
                    <input type="text" name="package_ar_3" id="package_ar_3" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_ar_3"]) && $settingsArray["package_ar_3"]["value"]) ? $settingsArray["package_ar_3"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">First Description</label>
                    <input type="text" name="package_desc_1" id="package_desc_1" class="form-control" placeholder="Package 1" value="{{(isset($settingsArray["package_desc_1"]) && $settingsArray["package_desc_1"]["value"]) ? $settingsArray["package_desc_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Description</label>
                    <input type="text" name="package_desc_2" id="package_desc_2" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_desc_1"]) && $settingsArray["package_desc_1"]["value"]) ? $settingsArray["package_desc_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Description</label>
                    <input type="text" name="package_desc_3" id="package_desc_3" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_desc_3"]) && $settingsArray["package_desc_3"]["value"]) ? $settingsArray["package_desc_3"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">First Description arabic</label>
                    <input type="text" name="package_desc_ar_1" id="package_desc_ar_1" class="form-control" placeholder="Package 1" value="{{(isset($settingsArray["package_desc_ar_1"]) && $settingsArray["package_desc_ar_1"]["value"]) ? $settingsArray["package_desc_ar_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Description arabic</label>
                    <input type="text" name="package_desc_ar_2" id="package_desc_ar_2" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_desc_ar_1"]) && $settingsArray["package_desc_ar_1"]["value"]) ? $settingsArray["package_desc_ar_1"]["value"] : ''}}">
                </div>
                <div class="form-group">
                    <label for="">Second Description arabic</label>
                    <input type="text" name="package_desc_ar_3" id="package_desc_ar_3" class="form-control" placeholder="Package 2" value="{{(isset($settingsArray["package_desc_ar_3"]) && $settingsArray["package_desc_ar_3"]["value"]) ? $settingsArray["package_desc_ar_3"]["value"] : ''}}">
                </div>
            </div>
            <div class="tab-pane fade" id="about_us" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">About us *</label>
                            <textarea name="about_us" class="form-control" id="about_us" cols="30" rows="10" placeholder="about us" value="{{(isset($settingsArray["about_us"]) && $settingsArray["about_us"]["value"]) ? $settingsArray["about_us"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">About us arabic *</label>
                            <textarea name="about_us_ar" class="form-control" id="about_us_ar" cols="30" rows="10" placeholder="about us arabic" value="{{(isset($settingsArray["about_us_ar"]) && $settingsArray["about_us_ar"]["value"]) ? $settingsArray["about_us_ar"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="about_royal" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">About royal *</label>
                            <textarea name="about_royal" class="form-control" id="about_royal" cols="30" rows="10" placeholder="about royal" value="{{(isset($settingsArray["about_royal"]) && $settingsArray["about_royal"]["value"]) ? $settingsArray["about_royal"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">About royal arabic *</label>
                            <textarea name="about_royal_ar" class="form-control" id="about_royal_ar" cols="30" rows="10" placeholder="about royal arabic" value="{{(isset($settingsArray["about_royal_ar"]) && $settingsArray["about_royal_ar"]["value"]) ? $settingsArray["about_royal_ar"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="medical_inssurence" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">Medical inssurence *</label>
                            <textarea name="medical_inssurence" class="form-control" id="medical_inssurence" cols="30" rows="10" placeholder="Medical inssurence" value="{{(isset($settingsArray["medical_inssurence"]) && $settingsArray["medical_inssurence"]["value"]) ? $settingsArray["medical_inssurence"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">Medical inssurence arabic *</label>
                            <textarea name="medical_inssurence_ar" class="form-control" id="medical_inssurence_ar" cols="30" rows="10" placeholder="Medical inssurence arabic" value="{{(isset($settingsArray["medical_inssurence_ar"]) && $settingsArray["medical_inssurence_ar"]["value"]) ? $settingsArray["medical_inssurence_ar"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pharmaceutical_analyses" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">Pharmaceutical analyses *</label>
                            <textarea name="pharmaceutical_analyses" class="form-control" id="pharmaceutical_analyses" cols="30" rows="10" placeholder="Pharmaceutical analyses" value="{{(isset($settingsArray["pharmaceutical_analyses"]) && $settingsArray["pharmaceutical_analyses"]["value"]) ? $settingsArray["pharmaceutical_analyses"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 pb-3">
                    <div class="w-100 p-3":key="index">
                        <div>
                            <label for="lang_name" class="form-label">Pharmaceutical analyses arabic *</label>
                            <textarea name="pharmaceutical_analyses_ar" class="form-control" id="pharmaceutical_analyses_ar" cols="30" rows="10" placeholder="Pharmaceutical analyses arabic" value="{{(isset($settingsArray["pharmaceutical_analyses_ar"]) && $settingsArray["pharmaceutical_analyses_ar"]["value"]) ? $settingsArray["pharmaceutical_analyses_ar"]["value"] : ''}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        execCommand(command) {
        document.execCommand(command, false, null);
        },
        insertHTML(html, element, key) {
            document.getElementById(element).focus();
            document.execCommand('insertHTML', false, html);
        },
    },
}).mount('#wrapper')
</script>
@endSection

