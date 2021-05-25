<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penggajian = Penggajian::orderBy('id','DESC')->get();
        $response = [
            'message' => 'Menampilkan data terbaru',
            'data'=> $penggajian
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
            // 'kode_gaji' => ['required'],
            'nominal' => ['required'],
            'description' => ['required'],
            'status' =>['required','in:diSetujui,diTolak']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $penggajian = Penggajian::create($request->all());
            $response = [
                'message' => 'Data Penggajian Berhasil disimpan',
                'data' => $penggajian
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to Create Data' . $e->errorInfo
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
        //
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
        $penggajian = Penggajian::findorFail($id);

        $validator = Validator::make($request->all(),[
            // 'kode_gaji' => ['required'],
            'nominal' => ['required'],
            'description' => ['required'],
            'status' =>['required','in:diSetujui,diTolak']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $penggajian->update($request->all());
            $response = [
                'message' => 'Data Penggajian Berhasil diperbarui',
                'data' => $penggajian
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
        $penggajian = Penggajian::findorFail($id);
        try {
            $penggajian->delete();
            $response = [
                'message' => 'Data Penggajian Berhasil dihapus'
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to delete Data' . $e->errorInfo
            ]);
        }
    }
}
