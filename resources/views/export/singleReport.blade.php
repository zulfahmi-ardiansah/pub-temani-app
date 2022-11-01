<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Aduan Masyarakat
    </title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        body {
            font-size: 11pt;
            padding: 30px 50px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
            display: block;
            margin-bottom: 3px;
        }

        .form-group:last-child {
            margin-bottom: 0px;
        }
        
        img {
            border: 1px solid black;
            margin-top: 3px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table tr td,
        table tr th {
            border: 1px solid black;
            padding: 5px 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>
        Aduan Masyarakat
    </h1>
    <br>
    <div class="form-group">
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
    <div class="form-group">
        <label class="form-label">
            Pembuat
        </label>
        <p class="form-control">
            {{ $repHeader->he_creator ? $repHeader->he_creator_rel->us_name : "" }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Dibuat
        </label>
        <p class="form-control">
            {{ date("H:i - M d, Y", strtotime($repHeader->created_at)) }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Terakhir Diperbarui
        </label>
        <p class="form-control">
            {{ date("H:i - M d, Y", strtotime($repHeader->updated_at)) }}
        </p>
    </div>
    @if ($repHeader->he_status == 3)
        <div class="form-group">
            <label class="form-label">
                Durasi Penanganan
            </label>
            <p class="form-control">
                {{ round((strtotime($repHeader->updated_at) - strtotime($repHeader->created_at)) / (60 * 60 * 24)) }} Hari
            </p>
        </div>
    @endif
    @if ($repHeader->he_departement)
        <div class="form-group">
            <label class="form-label">
                Ditangani Oleh
            </label>
            <p class="form-control">
                {{ $repHeader->he_departement ? $repHeader->he_departement_rel->de_name : "" }}
            </p>
        </div>
    @endif
    <div class="form-group">
        <label class="form-label">
            Kategori
        </label>
        <p class="form-control">
            {{ $repHeader->he_category ? $repHeader->he_category_rel->ca_name : "" }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Judul
        </label>
        <p class="form-control">
            {{ $repHeader->he_title }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Deskripsi
        </label>
        <p class="form-control">
            {{ $repHeader->he_description }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Tempat
        </label>
        <p class="form-control">
            {{ $repHeader->he_place }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Waktu Tanggal
        </label>
        <p class="form-control">
            {{ $repHeader->he_time }} - {{ date("M d, Y", strtotime($repHeader->he_date)) }}
        </p>
    </div>
    <div class="form-group">
        <label class="form-label">
            Foto
        </label>
        <div style="width: 300px; max-width: 100%;">
            <img src="{{ public_path($repHeader->he_image) }}" alt="foto-aduan" style="max-width: 100%" class="img-thumbnail">
        </div>
    </div>
    @if (count($repCommentList))
        <div class="form-group">
            <label class="form-label">
                Perkembangan
            </label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Informasi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repCommentList as $repComment)
                        <tr>
                            <td>
                            {{ date("H:i", strtotime($repComment->created_at)) }} - {{ date("M d, Y", strtotime($repComment->created_at)) }}
                            </td>
                            <td>
                                {{ $repComment->ce_content }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>
</html>