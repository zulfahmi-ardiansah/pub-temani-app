@extends("layout.default")

@section("content")
    <div class="container-xl">
        <div class="page-header text-white d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle text-white">
                        Penanganan Aduan
                    </div>
                    <h2 class="page-title">
                        Pengerjaan
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
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                @include("report.view.common")
                                <div class="form-group mb-0">
                                    <label class="form-label">
                                        Pembuat
                                    </label>
                                    <p class="form-control mb-0">
                                        {{ $repHeader->he_creator ? $repHeader->he_creator_rel->us_name : "" }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @include("report.view.comment")
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Form Perkembangan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Komentar <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <textarea name="ce_content" maxlength="255" required="" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-label">
                                        Foto
                                    </label>
                                    <input name="ce_image" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="d-block">
                                    <button name="submit-process-2" value="submit-process" class="w-100 btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                                        Simpan Perkembangan
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-block">
                                    <button name="submit-process-3" value="submit-process" class="w-100 btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                        Pekerjaan Selesai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop