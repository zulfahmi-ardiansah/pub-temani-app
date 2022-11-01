@if (count($repCommentList))
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">Perkembangan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Informasi
                            </th>
                            <th>
                                Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($repCommentList as $repComment)
                            <tr>
                                <td>
                                    {{ date("M d, Y", strtotime($repComment->created_at)) }}
                                    <small>{{ date("H:i", strtotime($repComment->created_at)) }}</small>
                                </td>
                                <td>
                                    {{ $repComment->ce_content }}
                                </td>
                                <td>
                                    @if ($repComment->ce_image)
                                        <a href="#" onclick="showImage('{{ asset($repComment->ce_image) }}')">
                                            Lihat Gambar
                                        </a>
                                    @else 
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto</h5>
                </div>
                <div class="modal-body">
                    <img src="" alt="Foto" class="img-thumbnail" id="imageDom" style="max-width: 100%;">
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e6e8e9">
                    <button type="button" class="btn btn-danger mt-3" onclick='$("#image").modal("hide")'>
                        Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImage (url) {
            $("#imageDom").attr("src", url);
            $("#image").modal("show");
        }
    </script>
@endif