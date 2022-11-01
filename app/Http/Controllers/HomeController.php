<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    AdmUser,
    RepHeader
};

class HomeController extends Controller
{
    // Index
        public function index (Request $request)
        {
            $data["title"]  =   "Beranda";
            $data["repHeaderList"]  =   RepHeader::where("he_creator", session()->get("admUser")->id)->orderBy("id", "DESC")->paginate(10);
            return view("home.index", $data);
        }

    // Password
        public function password (Request $request)
        {
            $data["title"]  =   "Ganti Kata Sandi";
            if ($request->get("submit-process")) {
                if ($request->get("new_us_password") != $request->get("new_confirmation_us_password")) {
                    return redirect(url("/home/password"))->with("error", "Kata sandi baru tidak sesuai dengan konfirmasi kata sandi baru !");
                }
                if (!(\Hash::check($request->get("old_us_password"), session()->get("admUser")->us_password))) {
                    return redirect(url("/home/password"))->with("error", "Kata sandi lama tidak sesuai !");
                }
                $admUser    =   AdmUser::find(session()->get("admUser")->id);
                $admUser->us_password   =   bcrypt($request->get("new_us_password"));
                $admUser->save();
                session()->put("admUser", $admUser);
                return redirect(url("/home"))->with("success", "Kata sandi berhasil diubah !");
            }
            return view("home.password", $data);
        }
}
