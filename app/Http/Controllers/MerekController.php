<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merek;

class MerekController extends Controller
{
    public function get() {
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'merekProdukList' => Merek::get(),
            'message' => 'Data merek'
        ], 200);
    }

    public function getPaginated() {
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'merekProdukList' => Merek::paginate(3),
            'message' => 'Data merek'
        ], 200);
    }

    public function detail($id) {
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'merekProduk' => Merek::where('id', $id)->first(),
            'message' => 'Data merek'
        ], 200);
    }

    public function create(Request $req) {
        $requestContent = json_decode($req->getContent());
        $data = new Merek();
        $data->merek = $requestContent->namaMerek;
        $data->keterangan = $req->keteranganMerek;
        $data->save();
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'merekProduk' => Merek::where('id', $data->id)->first(),
            'message' => 'berhasil membuat data'
        ], 200);
    }

    public function update($id, Request $req) {
        $requestContent = json_decode($req->getContent());
        $data = Merek::where('id', $id)->first();
        if ($data) {
            $data->merek = $requestContent->namaMerek;
            $data->keterangan = $req->keteranganMerek;
            $data->save();
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'merekProduk' => Merek::where('id', $data->id)->first(),
                'message' => 'berhasil mengupdate merek'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'merekProduk' => null,
                'message' => 'gagal mengupdate merek'
            ], 200);
        }
    }

    public function delete($id) {
        $data =  Merek::where('id', $id)->delete();
        if ($data) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'merekProduk' => null,
                'message' => 'berhasil menghapus merek'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'merekProduk' => null,
                'message' => 'gagal menghapus merek'
            ], 200);
        }
    }
}
