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
                        Pengguna
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive m-0">
                            <table class="table card-table table-hover table-vcenter text-nowrap table-special">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Alamat
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admUserList as $admUser)
                                        <tr>
                                            <td>
                                                {{ $admUser->us_name }}
                                            </td>
                                            <td>
                                                {{ $admUser->us_email }}
                                            </td>
                                            <td>
                                                {{ $admUser->us_address }}
                                            </td>
                                            <td>
                                                @if ($admUser->us_role != "ADMIN")
                                                    <form action="" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $admUser->id }}">
                                                        <button name="submit-delete" value="submit-delete" class="btn btn-danger btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop