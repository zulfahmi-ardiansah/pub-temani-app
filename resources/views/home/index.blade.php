@extends("layout.default")

@section("content")
    <div class="container-xl">
        <div class="page-header text-white d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle text-white">
                        Beranda
                    </div>
                    <h2 class="page-title">
                        Selamat Datang !
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{ url('/report/create') }}" class="btn btn-primary mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        <span class="d-none d-md-inline-block">Buat&nbsp;</span>Aduan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card" style="height: calc(24rem + 10px)">
                        <div class="card-header">
                            <h3 class="card-title">Aduanmu</h3>
                        </div>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                            <div class="divide-y">
                                @foreach ($repHeaderList as $repHeader)
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="text-truncate">
                                                    <a href="{{ url('/report/view/' . $repHeader->id) }}">
                                                        <strong>
                                                            {{ $repHeader->he_title }}
                                                        </strong>
                                                    </a>
                                                </div>
                                                <div class="text-truncate">
                                                    <small class="text-muted">
                                                        Diperbarui pada {{ date("M d, Y", strtotime($repHeader->updated_at)) }} 
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
                                @if (!count($repHeaderList))
                                    <div class="divide-empty">
                                        <img src="{{ asset('/assets/img/icon/empty.svg') }}" alt="empty">
                                        <h3>
                                            Kamu belum pernah membuat aduan
                                        </h3>
                                        <p class="text-muted mt-1 text-center">
                                            Laporkan permasalahan yang kamu alami dengan menekan menu buat aduan diatas !
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $repHeaderList->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop