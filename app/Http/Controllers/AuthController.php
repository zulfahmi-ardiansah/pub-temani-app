<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    AdmUser,
    AdmCitizen
};

class AuthController extends Controller
{
    // Login
        public function login (Request $request)
        {
            if ($request->get("submit-process")) {
                $admUser    =   AdmUser::where("us_email", $request->get("us_email"))->first();
                if ($admUser) {
                    if (\Hash::check($request->get("us_password"), $admUser->us_password)) {
                        session()->put("admUser", $admUser);
                        return redirect(url("/home"))->with("success", "Selamat datang di Temani !");
                    }
                }
                return redirect(url("/login"))->with("error", "Email atau kata sandi salah !");
            }
            return view("auth.login");
        }

    // Register
        public function register (Request $request)
        {
            try {
                if ($request->get("submit-process")) {
                    if (AdmUser::where("us_email", $request->get("us_email"))->count()) {
                        return redirect(url("/register"))->with("error", "Email sudah pernah didaftarkan ! ");
                    }
                    $admUser    =   new AdmUser();
                    $admUser->us_name   =   $request->get("us_name");
                    $admUser->us_email  =   $request->get("us_email");
                    $admUser->us_address    =   $request->get("us_address");
                    $admUser->us_role   =   "USER";
                    if ($request->get("us_password")) {
                        $admUser->us_password   =   bcrypt($request->get("us_password"));
                    }
                    $admUser->save();
                    return redirect(url("/login"))->with("success", "Akun berhasil didaftarkan !");
                    return false;
                }
            } catch (\Throwable $exception) {
                return redirect(url("/register"))->with("error", "Terjadi kesalahan !");
            }
            return view("auth.register");
        }

    // Logout
        public function logout (Request $request)
        {
            session()->flush();
            return redirect(url("/login"));
        }
}
