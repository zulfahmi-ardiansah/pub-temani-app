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
                        Daftar Aduan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card mb-3" style="height: calc(20rem + 10px)">
                        <div class="card-header">
                            <h3 class="card-title">Pekerjaan</h3>
                        </div>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            <div class="divide-y">
                                @foreach ($repHeaderTaskList as $repHeader)
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-truncate">
                                                    <a href="{{ url('/report/process/' . $repHeader->id) }}">
                                                        <strong>
                                                            {{ $repHeader->he_title }}
                                                        </strong>
                                                    </a>
                                                </div>
                                                <div class="text-truncate">
                                                    <small class="text-muted">
                                                        Diperbarui pada {{ date("M d, Y", strtotime($repHeader->updated_at)) }} 
                                                        <span style="font-size: .6em; padding: 0px 5px; display: inline-block; transform: translateY(-3px);">●</span>
                                                        Oleh {{ $repHeader->he_creator ? $repHeader->he_creator_rel->us_name : "" }} 
                                                        <span style="font-size: .6em; padding: 0px 5px; display: inline-block; transform: translateY(-3px);">●</span> 
                                                        Kategori {{ $repHeader->he_category ? $repHeader->he_category_rel->ca_name : "" }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-auto align-self-center">
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
                                        </div>
                                    </div>
                                @endforeach
                                @if (!count($repHeaderTaskList))
                                    <div class="divide-empty">
                                        <img src="{{ asset('/assets/img/icon/empty.svg') }}" alt="empty">
                                        <h3>
                                            Data tidak ditemukan
                                        </h3>
                                        <p class="text-muted mt-1 text-center">
                                            Lihat aduan masyarakat terkait dengan departemenmu dibawah agar dapat dikerjakan !
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card" style="height: calc(20rem + 10px)">
                        <div class="card-header">
                            <h3 class="card-title">Aduan</h3>
                        </div>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            <div class="divide-y">
                                @foreach ($repHeaderUntaskList as $repHeader)
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-truncate">
                                                    <a href="{{ url('/report/process/' . $repHeader->id) }}">
                                                        <strong>
                                                            {{ $repHeader->he_title }}
                                                        </strong>
                                                    </a>
                                                </div>
                                                <div class="text-truncate">
                                                    <small class="text-muted">
                                                        Diperbarui pada {{ date("M d, Y", strtotime($repHeader->updated_at)) }} 
                                                        <span style="font-size: .6em; padding: 0px 5px; display: inline-block; transform: translateY(-3px);">●</span>
                                                        Oleh {{ $repHeader->he_creator ? $repHeader->he_creator_rel->us_name : "" }} 
                                                        <span style="font-size: .6em; padding: 0px 5px; display: inline-block; transform: translateY(-3px);">●</span> 
                                                        Kategori {{ $repHeader->he_category ? $repHeader->he_category_rel->ca_name : "" }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-auto align-self-center">
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
                                        </div>
                                    </div>
                                @endforeach
                                @if (!count($repHeaderUntaskList))
                                    <div class="divide-empty">
                                        <img src="{{ asset('/assets/img/icon/empty.svg') }}" alt="empty">
                                        <h3>
                                            Data tidak ditemukan
                                        </h3>
                                        <p class="text-muted mt-1 text-center">
                                            Tidak ada aduan masyarakat terkait dengan departemenmu
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop