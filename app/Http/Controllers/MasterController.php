<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    AdmCategory,
    AdmDepartement,
    AdmUser
};

class MasterController extends Controller
{
    // Category
        public function category (Request $request)
        {
            $data["title"]  =   "Kategori";
            try {
                if ($request->get("submit-form")) {
                    $data["admCategory"]    =   $request->get("id") ? AdmCategory::find($request->get("id")) : null;
                    return view("master.category.form", $data);
                } else if ($request->get("submit-process")) {
                    $admCategory    =   $request->get("id") ? AdmCategory::find($request->get("id")) : null;
                    $admCategory    =   $admCategory ? $admCategory : new AdmCategory();
                    $admCategory->ca_name   =   $request->get("ca_name");
                    $admCategory->ca_description    =   $request->get("ca_description");
                    if ($request->file("ca_icon")) {
                        $admCategory->ca_icon   =   Utility::uploadFile($request, "ca_icon", "icon-");
                    }
                    $admCategory->save();
                    return redirect(url("/master/category"))->with("success", "Data berhasil disimpan !");
                } else if ($request->get("submit-delete")) {
                    $admCategory    =   $request->get("id") ? AdmCategory::find($request->get("id")) : null;
                    if ($admCategory) {
                        $admCategory->delete();
                    }
                    return redirect(url("/master/category"))->with("success", "Data berhasil dihapus !");
                }
            } catch (\Throwable $e) {
                return redirect(url("/master/category"))->with("error", "Terjadi kesalahan !");
            }
            $data["admCategoryList"]    =   AdmCategory::orderBy("ca_name", "ASC")->get();
            return view("master.category.list", $data);
        }

    // Departement
        public function departement (Request $request)
        {
            $data["title"]  =   "Departemen";
            try {
                if ($request->get("submit-form")) {
                    $data["admDepartement"]     =   $request->get("id") ? AdmDepartement::find($request->get("id")) : null;
                    $data["admCategoryList"]    =   AdmCategory::orderBy("ca_name", "ASC")->get();
                    return view("master.departement.form", $data);
                } else if ($request->get("submit-process")) {
                    $admDepartement    =   $request->get("id") ? AdmDepartement::find($request->get("id")) : null;
                    $admDepartement    =   $admDepartement ? $admDepartement : new AdmDepartement();
                    $admDepartement->de_name   =   $request->get("de_name");
                    $admDepartement->de_description =   $request->get("de_description");
                    $admDepartement->de_category    =   $request->get("de_category");
                    if ($request->file("de_icon")) {
                        $admDepartement->de_icon   =   Utility::uploadFile($request, "de_icon", "icon-");
                    }
                    $admDepartement->save();
                    return redirect(url("/master/departement"))->with("success", "Data berhasil disimpan !");
                } else if ($request->get("submit-delete")) {
                    $admDepartement    =   $request->get("id") ? AdmDepartement::find($request->get("id")) : null;
                    if ($admDepartement) {
                        $admDepartement->delete();
                    }
                    return redirect(url("/master/departement"))->with("success", "Data berhasil dihapus !");
                }
            } catch (\Throwable $e) {
                return redirect(url("/master/departement"))->with("error", "Terjadi kesalahan ! ");
            }
            $data["admDepartementList"]    =   AdmDepartement::orderBy("de_name", "ASC")->get();
            return view("master.departement.list", $data);
        }
        
    // User
        public function user (Request $request)
        {
            $data["title"]  =   "Pengguna";
            try {
                if ($request->get("submit-delete")) {
                    $admUser    =   $request->get("id") ? AdmUser::find($request->get("id")) : null;
                    if ($admUser) {
                        $admUser->delete();
                    }
                    return redirect(url("/master/user"))->with("success", "Data berhasil dihapus !");
                }
            } catch (\Throwable $e) {
                return redirect(url("/master/user"))->with("error", "Terjadi kesalahan ! ");
            }
            $data["admUserList"]    =   AdmUser::where("us_role", "USER")->orderBy("us_name", "ASC")->paginate(10);
            return view("master.user.list", $data);
        }

    // Employee
        public function employee (Request $request)
        {
            $data["title"]  =   "Pegawai";
            try {
                if ($request->get("submit-form")) {
                    $data["admUser"]    =   $request->get("id") ? AdmUser::find($request->get("id")) : null;
                    $data["admDepartementList"]    =   AdmDepartement::orderBy("de_name", "ASC")->get();
                    return view("master.employee.form", $data);
                } else if ($request->get("submit-process")) {
                    $admUser    =   $request->get("id") ? AdmUser::find($request->get("id")) : null;
                    $admUser    =   $admUser ? $admUser : new AdmUser();
                    $admUser->us_name   =   $request->get("us_name");
                    $admUser->us_email  =   $request->get("us_email");
                    $admUser->us_structural     =   $request->get("us_structural");
                    $admUser->us_departement    =   $request->get("us_departement");
                    $admUser->us_address    =   $request->get("us_address");
                    $admUser->us_role   =   "EMPLOYEE";
                    if ($request->get("us_password")) {
                        $admUser->us_password   =   bcrypt($request->get("us_password"));
                    }
                    $admUser->save();
                    return redirect(url("/master/employee"))->with("success", "Data berhasil disimpan !");
                    return false;
                } else if ($request->get("submit-delete")) {
                    $admUser    =   $request->get("id") ? AdmUser::find($request->get("id")) : null;
                    if ($admUser) {
                        $admUser->delete();
                    }
                    return redirect(url("/master/user"))->with("success", "Data berhasil dihapus !");
                }
            } catch (\Throwable $e) {
                return redirect(url("/master/employee"))->with("error", "Terjadi kesalahan ! ");
            }
            $data["admUserList"]    =   AdmUser::where("us_role", "!=", "USER")->orderBy("us_name", "ASC")->get();
            return view("master.employee.list", $data);
        }
}
