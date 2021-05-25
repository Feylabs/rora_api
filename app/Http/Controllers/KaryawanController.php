<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = DataKaryawan::get();
        $response = [
            'message' => 'Menampilkan Seluruh Data Karyawan',
            'data'=> $karyawan
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nip_karyawan' => ['required'],
            'nama_karyawan' => ['required'],
            'alamat_karyawan' => ['required'],
            'notelp_karyawan' => ['required'],
            'jabatan' => ['required'],
            'department' => ['required'],
            'jenis_kelamin' =>['required','in:Pria,Wanita'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $karyawan = new DataKaryawan;
            $karyawan->nip_karyawan = $request->nip_karyawan;
            $karyawan->nama_karyawan = $request->nama_karyawan;
            $karyawan->alamat_karyawan = $request->alamat_karyawan;
            $karyawan->notelp_karyawan = $request->notelp_karyawan;
            $karyawan->jabatan = $request->jabatan;
            $karyawan->department = $request->department;
            $karyawan->jenis_kelamin = $request->jenis_kelamin;
            $karyawan->save();

            $response = [
                'message' => "Data Berhasil disimpan!",
                'data' => $karyawan
            ];
            return response()->json($response, Response::HTTP_OK);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Data Gagal disimpan!' . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = DataKaryawan::findorFail($id);
        $response = [
            'message' => "Detail Karyawan By ID",
            'data' => $karyawan
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $karyawan = DataKaryawan::findorFail($id);
        $validator = Validator::make($request->all(),[
            'nip_karyawan' => ['required'],
            'nama_karyawan' => ['required'],
            'alamat_karyawan' => ['required'],
            'notelp_karyawan' => ['required'],
            'jabatan' => ['required'],
            'department' => ['required'],
            'jenis_kelamin' =>['required','in:Pria,Wanita'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $karyawan->update($request->all());
            $response = [
                'message' => 'Data Karyawan Berhasil diUpdate',
                'data' => $karyawan
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to Update Data' . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = DataKaryawan::findorFail($id);
        try {
            $karyawan->delete();
            $response = [
                'message' => 'Data Karyawan Berhasil dihapus',
                'data' => $karyawan
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to Delete Data' . $e->errorInfo
            ]);
        }
    }
}
