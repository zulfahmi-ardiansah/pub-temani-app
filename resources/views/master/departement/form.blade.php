@extends("layout.default")

@section("content")
    <div class="container-xl">
        <div class="page-header text-white d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle text-white">
                        Data Dasar
                    </div>
                    <h2 class="page-title">
                        Departemen
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
                @if (!(is_null($admDepartement)))
                    <input type="hidden" name="id" value="{{ $admDepartement->id }}">
                @endif
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Nama <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <input name="de_name" type="text" class="form-control" maxlength="100" required="true">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Deskripsi <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <textarea name="de_description" required="" class="form-control" maxlength="255"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Kategori <sup class="text-danger"><b>*</b></sup>
                                    </label>
                                    <select name="de_category" required="true" class="form-control">
                                        <option value="">
                                            Pilih Kategori
                                        </option>
                                        @foreach ($admCategoryList as $admCategory)
                                            <option value="{{ $admCategory->id }}">
                                                {{ $admCategory->ca_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-label">
                                        @if (!(is_null($admDepartement)))
                                            Ubah Ikon
                                        @else
                                            Ikon <sup class="text-danger"><b>*</b></sup>
                                        @endif
                                    </label>
                                    <input name="de_icon" type="file" class="form-control" {{ is_null($admDepartement) ? 'required="true"' : '' }}>
                                    @if (!(is_null($admDepartement)))
                                        <div style="width: 300px; max-width: 100%; margin-top: 10px;">
                                            <img src="{{ asset($admDepartement->de_icon) }}" alt="img-icon" class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <button name="submit-process" value="submit-process" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
    @if (!(is_null($admDepartement)))
        <script>
            $('[name="de_name"]').val("{{ $admDepartement->de_name }}");
            $('[name="de_category"]').val("{{ $admDepartement->de_category }}");
            $('[name="de_description"]').val("{{ $admDepartement->de_description }}");
        </script>
    @endif
@stop