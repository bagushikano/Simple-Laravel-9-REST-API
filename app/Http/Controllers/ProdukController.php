<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function get() {
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'produkList' => Produk::with('merekProduk')->get(),
            'message' => 'Data produk'
        ], 200);
    }

    public function detail($id) {
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'produk' => Produk::where('id', $id)->with('merekProduk')->first(),
            'message' => 'Data produk'
        ], 200);
    }

    public function create(Request $req) {
        $produkData = json_decode($req->produk);
        $data = new Produk();
        $data->nama_produk = $produkData->nama_produk;
        $data->desc = $produkData->desc;
        $data->merek_id = $produkData->merek_id;
        if($req->hasFile('file')){
            $file = $req->file('file');
            $filename = uniqid().'.png';
            $fileLocation = '/image';
            $path = $fileLocation."/".$filename;
            $data->foto = '/storage'.$path;
            Storage::disk('public')->put($path, file_get_contents($file));
        }
        $data->save();
        return response()->json([
            'statusCode' => 200,
            'status' => true,
            'produk' => Produk::where('id', $data->id)->first(),
            'message' => 'Berhasil membuat produk baru'
        ], 200);
    }

    public function update($id, Request $req) {
        $produkData = json_decode($req->produk);
        $data = Produk::where('id', $id)->first();
        if ($data) {
            $data->nama_produk = $produkData->nama_produk;
            $data->desc = $produkData->desc;
            $data->merek_id = $produkData->merek_id;
            if($req->hasFile('file')){
                $file = $req->file('file');
                $filename = uniqid().'.png';
                $fileLocation = '/image';
                $path = $fileLocation."/".$filename;
                $data->foto = '/storage'.$path;
                Storage::disk('public')->put($path, file_get_contents($file));
            }
            $data->save();
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'produk' => Produk::where('id', $data->id)->first(),
                'message' => 'Berhasil mengupdate produk'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'merekProduk' => null,
                'message' => 'gagal mengupdate produk'
            ], 200);
        }
    }
    public function delete($id) {
        $data =  Produk::where('id', $id)->delete();
        if ($data) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'merekProduk' => null,
                'message' => 'berhasil menghapus produk'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'merekProduk' => null,
                'message' => 'gagal menghapus produk'
            ], 200);
        }
    }
}
