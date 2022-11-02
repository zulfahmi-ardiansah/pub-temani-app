<div class="form-group mb-3">
    <label class="form-label">
        Status Aduan
    </label>
    @if ($repHeader->he_status == 0)
        <div class="badge bg-danger">Ditolak</div>
    @elseif ($repHeader->he_status == 1)
        <div class="badge bg-warning">Menunggu</div>
    @elseif ($repHeader->he_status == 2)
        <div class="badge bg-success">Dalam Proses</div>
    @elseif ($repHeader->he_status == 3)
        <div class="badge bg-primary">Selesai</div>
    @endif
</div>
<div class="form-group mb-3">
    <div class="row">
        <div class="col-6">
            <label class="form-label">
                Dibuat
            </label>
            <p class="form-control mb-0">
                {{ date("H:i - M d, Y", strtotime($repHeader->created_at)) }}
            </p>
        </div>
        <div class="col-6">
            <label class="form-label">
                Terakhir Diperbarui
            </label>
            <p class="form-control mb-0">
                {{ date("H:i - M d, Y", strtotime($repHeader->updated_at)) }}
            </p>
        </div>
    </div>
</div>
@if ($repHeader->he_status == 3)
    <div class="form-group mb-3">
        <label class="form-label">
            Durasi Penanganan
        </label>
        <p class="form-control mb-0">
            {{ round((strtotime($repHeader->updated_at) - strtotime($repHeader->created_at)) / (60 * 60 * 24)) }} Hari
        </p>
    </div>
@endif
@if ($repHeader->he_departement)
    <div class="form-group mb-3">
        <label class="form-label">
            Ditangani Oleh
        </label>
        <p class="form-control mb-0">
            {{ $repHeader->he_departement ? $repHeader->he_departement_rel->de_name : "" }}
        </p>
    </div>
@endif
<div class="form-group mb-3">
    <label class="form-label">
        Kategori
    </label>
    <p class="form-control mb-0">
        {{ $repHeader->he_category ? $repHeader->he_category_rel->ca_name : "" }}
    </p>
</div>
<div class="form-group mb-3">
    <label class="form-label">
        Judul
    </label>
    <p class="form-control mb-0">
        {{ $repHeader->he_title }}
    </p>
</div>
<div class="form-group mb-3">
    <label class="form-label">
        Deskripsi
    </label>
    <p class="form-control mb-0">
        {{ $repHeader->he_description }}
    </p>
</div>
<div class="form-group mb-3">
    <label class="form-label">
        Tempat
    </label>
    <p class="form-control mb-0">
        {{ $repHeader->he_place }}
    </p>
    @if ($repHeader->he_place_lat && $repHeader->he_place_long)
        <div class="d-block mt-2">
            <iframe style="width: 100%; height: 350px;border: 1px solid #ccc;border-radius: 4px;" src="https://www.openstreetmap.org/export/embed.html?bbox={{ $repHeader->he_place_long }},{{ $repHeader->he_place_lat }},{{ $repHeader->he_place_long }},{{ $repHeader->he_place_lat }}&marker={{ $repHeader->he_place_lat }},{{ $repHeader->he_place_long }}" frameborder="0"></iframe>
        </div>
        <a target="_blank" class="btn btn-default mt-2 w-100 mb-1" href="https://maps.google.com/?q={{ $repHeader->he_place_lat }},{{ $repHeader->he_place_long }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="18" y2="6.01" /><path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5" /><polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15" /><line x1="9" y1="4" x2="9" y2="17" /><line x1="15" y1="15" x2="15" y2="20" /></svg>
            Buka titik pada Google Map
        </a>
    @endif
</div>
<div class="form-group mb-3">
    <div class="row">
        <div class="col-5">
            <label class="form-label">
                Waktu
            </label>
            <p class="form-control mb-0">
                {{ $repHeader->he_time }}
            </p>
        </div>
        <div class="col-7">
            <label class="form-label">
                Tanggal
            </label>
            <p class="form-control mb-0">
                {{ date("M d, Y", strtotime($repHeader->he_date)) }}
            </p>
        </div>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">
        Foto
    </label>
    <div style="width: 300px; max-width: 100%;">
        <img src="{{ str_contains($repHeader->he_image, 'test_case_temani.jpg') ? asset('assets/img/icon/test_case_temani.jpg') : asset($repHeader->he_image) }}" alt="foto-aduan" style="max-width: 100%" class="img-thumbnail">
    </div>
</div>