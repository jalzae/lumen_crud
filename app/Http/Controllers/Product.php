<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Product extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        header('Content-Type: application/json');

        $check = DB::table("barang")->get();

        if (count($check) == 0) {
            return response()->json(array(
                "message" => "success but no data here",
                "results" => $check
            ), 201);
        } else {
            return response()->json(array(
                "message" => "success",
                "results" => $check
            ), 200);
        }
    }

    public function detail($id)
    {
        $product =  DB::table("barang")->where('id_Barang', $id)->get();
        $product1 =  DB::table("barang")->where('id_Barang', $id)->first();

        if (count($product) == 0) {
            return response()->json([
                'status' => "nodata",
                'message' => "nodata",
                'data' => $product
            ], 400);
        } else {
            $data = [
                'status' => "success",
                'message' => "data exist",
                'data' => $product
            ];
            return response()->json($product1, 200);
        }
    }

    public function insert(Request $request)
    {
        header('Content-Type: application/json');
        $Nama_Barang = $request->Nama_Barang;

        $data = [
            "Nama_Barang" => $Nama_Barang
        ];

        $valid = [
            "Nama_Barang" => "required"
        ];

        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => "ERROR",
                "message" => $validator->errors(),
            ), 404);
        } else {
            $save = DB::table('barang')->insert($data);

            if ($save) {
                return response()->json(array(
                    "status" => "SUCCESS",
                    "message" => "Berhasil",
                    "results" => $data
                ), 200);
            } else {
                return response()->json(array(
                    "status" => "ERROR",
                    "message" => "Gagal",
                    "results" => $data
                ), 404);
            }
        }
    }
    public function update(Request $request)
    {
        header('Content-Type: application/json');
        $id_Barang = $request->id_Barang;
        $Nama_Barang = $request->Nama_Barang;

        $data = [
            "Nama_Barang" => $Nama_Barang
        ];
        $valid = [
            "Nama_Barang" => "required"
        ];

        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => "ERROR",
                "message" => $validator->errors(),
            ), 404);
        } else {

            $update = DB::table('barang')->where('id_Barang', $id_Barang)->update($data);

            if ($update) {
                return response()->json(array(
                    "status" => "SUCCESS",
                    "message" => "Berhasil",
                    "results" => $data
                ), 200);
            } else {
                return response()->json(array(
                    "status" => "ERROR",
                    "message" => "Gagal",
                    "results" => $data
                ), 404);
            }
        }
    }
    public function delete(Request $request)
    {
        header('Content-Type: application/json');
        $id_Barang = $request->id_Barang;
        $update = DB::table('barang')->where("id_Barang", $id_Barang)->delete();

        if ($update) {
            return response()->json(array(
                "status" => "SUCCESS",
                "message" => "Berhasil",
            ), 200);
        } else {
            return response()->json(array(
                "status" => "ERROR",
                "message" => "Gagal",
            ), 404);
        }
    }
}
