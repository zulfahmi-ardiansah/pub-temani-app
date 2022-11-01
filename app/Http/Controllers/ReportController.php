<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    AdmCategory,
    AdmDepartement,
    AdmUser,
    RepHeader,
    RepComment
};

class ReportController extends Controller
{
    // Process
        public function process (Request $request, $id)
        {
            $data["title"]  =   "Proses";
            try {
                if ($request->get("submit-process-1")) {
                    $repHeader  =   RepHeader::find($id);
                    $repHeader->he_departement  =   session()->get("admUser")->us_departement;
                    $repHeader->he_worker       =   session()->get("admUser")->id;
                    $repHeader->he_status       =   2;
                    $repHeader->save();
                    return redirect(url("/report/list"))->with("success", "Aduan berhasil diambil !");
                } else if ($request->get("submit-process-2")) {
                    $repComment =   new RepComment();
                    $repComment->ce_content     =   $request->get("ce_content");
                    $repComment->ce_header      =   $id;
                    if ($request->file("ce_image")) {
                        $repComment->ce_image   =   Utility::uploadFile($request, "ce_image", "report-");
                    }
                    $repComment->save();
                    return redirect(url("/report/list"))->with("success", "Perkembangan telah berhasil disimpan !");
                } else if ($request->get("submit-process-3")) {
                    $repComment =   new RepComment();
                    $repComment->ce_content     =   $request->get("ce_content");
                    $repComment->ce_header      =   $id;
                    if ($request->file("ce_image")) {
                        $repComment->ce_image   =   Utility::uploadFile($request, "ce_image", "report-");
                    }
                    $repComment->save();
                    $repHeader  =   RepHeader::find($id);
                    $repHeader->he_status   =   3;
                    $repHeader->save();
                    return redirect(url("/report/list"))->with("success", "Aduan berhasil diselesaikan !");
                }
                $data["repHeader"]  =   RepHeader::find($id);
                $data["repCommentList"] =   RepComment::where("ce_header", $id)->orderBy("id", "ASC")->get();
                if ($data["repHeader"]->he_status == 1) {
                    return view("report.process.process-1", $data);
                } else if ($data["repHeader"]->he_status == 2) {
                    return view("report.process.process-2", $data);
                }
            } catch (\Throwable $e) {}
            return redirect(url("/home"))->with("error", "Terjadi kesalahan ! ");
        }

    // List
        public function list (Request $request)
        {
            $data["title"]  =   "Penanganan Aduan";
            if (session()->get("admUser")->us_departement) {
                $admDepartement =   AdmDepartement::find(session()->get("admUser")->us_departement);
                $data["repHeaderUntaskList"]    =   RepHeader::where("he_category", $admDepartement->de_category)
                                                    ->where("he_status", 1)
                                                    ->orderBy("he_status", "ASC")
                                                    ->orderBy("id", "DESC")
                                                    ->get();
                $data["repHeaderTaskList"]    =   RepHeader::where("he_departement", $admDepartement->id)
                                                    ->where("he_status", "!=", 1)
                                                    ->where("he_status", "!=", 3)
                                                    ->orderBy("he_status", "ASC")
                                                    ->orderBy("id", "DESC")
                                                    ->get();
            } else {
                $data["repHeaderList"]  =   RepHeader::orderBy("he_status", "ASC")
                                                    ->orderBy("id", "DESC")
                                                    ->get();
            }
            return view("report.list", $data);
        }

    // History
        public function history (Request $request)
        {
            $data["title"]  =   "Riwayat Aduan";
            if (session()->get("admUser")->us_departement) {
                $admDepartement =   AdmDepartement::find(session()->get("admUser")->us_departement);
                $data["repHeaderList"]      =   RepHeader::where("he_departement", $admDepartement->id)
                                                    ->orderBy("updated_at", "DESC")
                                                    ->orderBy("id", "DESC")
                                                    ->paginate(10);
            } else {
                $data["repHeaderList"]  =   RepHeader::orderBy("updated_at", "DESC")
                                                    ->orderBy("id", "DESC")
                                                    ->paginate(10);
            }
            return view("report.history", $data);
        }

    // View
        public function view (Request $request, $id)
        {
            $data["title"]  =   "Aduan";
            $data["repHeader"]  =   RepHeader::find($id);
            $data["repCommentList"] =   RepComment::where("ce_header", $id)->orderBy("id", "ASC")->get();
            return view("report.view.view", $data);
        }

    // Print
        public function print (Request $request, $id)
        {
            $data["title"]  =   "Aduan";
            $data["repHeader"]  =   RepHeader::find($id);
            $data["repCommentList"] =   RepComment::where("ce_header", $id)->orderBy("id", "ASC")->get();
            $pdf = \PDF::loadview('export.singleReport', $data);
            return $pdf->stream('report.pdf');
        }

    // Create
        public function create (Request $request)
        {
            $data["title"]  =   "Membuat Aduan";
            try {
                if ($request->get("submit-process")) {
                    $repHeader  =   new RepHeader();
                    $repHeader->he_title    =   $request->get("he_title");
                    $repHeader->he_description    =   $request->get("he_description");
                    $repHeader->he_time     =   $request->get("he_time");
                    $repHeader->he_date     =   $request->get("he_date");
                    $repHeader->he_category =   $request->get("he_category");
                    $repHeader->he_place    =   $request->get("he_place");
                    $repHeader->he_place_lat    =   $request->get("he_place_lat");
                    $repHeader->he_place_long   =   $request->get("he_place_long");
                    $repHeader->he_creator  =   session()->get("admUser")->id;
                    $repHeader->he_status   =   1;
                    if ($request->file("he_image")) {
                        $repHeader->he_image    =   Utility::uploadFile($request, "he_image", "report-");
                    }
                    $repHeader->save();
                    return redirect(url("/home"))->with("success", "Laporan kamu berhasil dikirimkan ! Tunggu kabar dan perkembangannya ya !");
                }
            } catch (\Throwable $e) {
                return redirect(url("/report/create"))->with("error", "Terjadi kesalahan ! ");
            }
            $data["admCategoryList"]    =   AdmCategory::orderBy("ca_name", "ASC")->get();
            return view("report.create.form", $data);
        }
}
