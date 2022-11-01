<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register - Temani</title>
    @include("include.css")
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="."><img src="{{ asset('/assets/img/logo/logo-and-text.svg') }}" height="36" alt=""></a>
            </div>
            <form class="card card-md" action="" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="card-body">
                    <h2 class="card-title text-center mb-4"><b>Pendaftaran akun</b></h2>
                    <div class="mb-3">
                        <label class="form-label">Email <sup class="text-danger"><b>*</b></sup></label>
                        <input name="us_email" autocomplete="off" required="true" maxlength="100" type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama <sup class="text-danger"><b>*</b></sup></label>
                        <input name="us_name" autocomplete="off" required="true" maxlength="100" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Kata Sandi <sup class="text-danger"><b>*</b></sup>
                        </label>
                        <div class="input-group input-group-flat">
                            <input name="us_password" maxlength="100" autocomplete="off" required="true" type="password" class="form-control">
                            <span class="input-group-text px-2" style="border-left: 2px solid #dadcde;">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Alamat <sup class="text-danger"><b>*</b></sup>
                        </label>
                        <textarea name="us_address" required="" class="form-control" maxlength="255"></textarea>
                    </div>
                    <div class="form-footer">
                        <button name="submit-process" value="submit-process" type="submit" class="btn btn-primary w-100">Kirim</button>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Sudah memiliki akun ? <a href="{{ url('/login') }}" tabindex="-1">Masuk di sini</a>
            </div>
        </div>
    </div>
    
    @include("include.js")
</body>

</html>
