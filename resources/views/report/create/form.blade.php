@extends("layout.default")

@section("content")
    <div class="container-xl">
        <div class="page-header text-white d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle text-white">
                        Aduan Masyarakat
                    </div>
                    <h2 class="page-title">
                        Buat Aduan
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="javascript:history.back()" class="btn btn-default mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>    
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="he_place_lat" value="">
                <input type="hidden" name="he_place_long" value="">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">
                                        Kategori <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <div class="row">
                                        @foreach ($admCategoryList as $admCategory)
                                            <div class="col-6 col-md-3 mb-3">
                                                <label class="form-selectgroup-item" style="height: 100%">
                                                    <input type="radio" name="he_category" value="{{ $admCategory->id }}" class="form-selectgroup-input" checked="">
                                                    <span class="form-selectgroup-label mb-3" style="height: 100%">
                                                        <img src="{{ asset($admCategory->ca_icon) }}" class="w-100 category-icon mb-3" alt="{{ $admCategory->ca_name }}">
                                                        <b>
                                                            {{ $admCategory->ca_name }}
                                                        </b>
                                                        <small class="d-block text-muted mt-1">
                                                            {{ $admCategory->ca_description }}
                                                        </small>
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Judul <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <input name="he_title" required="" type="text" maxlength="100" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Deskripsi <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <textarea name="he_description" required="" class="form-control" maxlength="255"></textarea>
                                    <small class="text-muted d-block mt-2 mb-1">
                                        Jelaskan permasalahan yang kamu alami dan ingin diadukan dengan jelas ya !
                                    </small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Tempat <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <textarea name="he_place" required="" class="form-control" maxlength="255"></textarea>
                                    <small class="text-muted d-block mt-2 mb-1">
                                        Berikan lokasi permasalahan yang kamu alami agar kami bisa segera langsung menanganinya ya !
                                    </small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2">
                                        Tempat dengan Titik di Map
                                    </label>
                                    <div class="input-group">
                                        <input type="text" readonly="" name="location" class="form-control" required="">
                                        <div class="input-group-append">
                                            <button class="btn btn-default" type="button" onclick="getLocation();">Berikan Lokasi Saat Ini</button>
                                        </div>
                                    </div>
                                    <div id="location-map"></div>
                                    <small class="text-muted d-block mt-2 mb-1">
                                        Kamu bisa memberikan titik di map sehingga lokasi permasalahan yang kamu alami lebih jelas !
                                    </small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Foto <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <input name="he_image" required="" type="file" class="form-control">
                                    <small class="text-muted d-block mt-2 mb-1">
                                        Upload foto terkait permasalahanmu, foto tersebut akan membantu kami dalam membantu permasalahanmu !
                                    </small>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col-5">
                                            <label class="form-label">
                                                Waktu <sup class="text-danger"><b>*</b></sup>
                                            </label>
                                            <input name="he_time" required="" type="time" class="form-control">
                                        </div>
                                        <div class="col-7">
                                            <label class="form-label">
                                                Tanggal <sup class="text-danger"><b>*</b></sup>
                                            </label>
                                            <input name="he_date" required="" type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <button name="submit-process" value="submit-process" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                Kirim Aduan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('[name="he_place_lat"]').val(null);
        $('[name="he_place_long"]').val(null);
        $('[name="location"]').val(null);

        function getLocation () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(refreshPosition);
            } else { 
                toastr["error"]("Aktifkan lokasi untuk mendapatkan lokasi presensi !", "Kesalahan");
            }
        }

        function refreshPosition(position) {
            $('[name="he_place_lat"]').val(position.coords.latitude);
            $('[name="he_place_long"]').val(position.coords.longitude);
            $('[name="location"]').val("Berhasil");
            $('#location-map').html(`
                <div class="d-block mt-2">
                    <iframe style="width: 100%; height: 350px;border: 1px solid #ccc;border-radius: 4px;" src="https://www.openstreetmap.org/export/embed.html?bbox=` + position.coords.longitude + `,` + position.coords.latitude + `,` + position.coords.longitude + `,` + position.coords.latitude + `&marker=` + position.coords.latitude + `,` + position.coords.longitude + `" frameborder="0"></iframe>
                </div>
            `)
        }
    </script>
@stop