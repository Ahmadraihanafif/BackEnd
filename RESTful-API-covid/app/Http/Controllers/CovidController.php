<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class CovidController extends Controller
{

    public function index()
    {
        $patients = Patients::all();
        if (count($patients)) {
            $data = [
                'messege' => 'Get all patients',
                'data' => $patients,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'messege' => "Data Tidak Ada"
            ];
            return response()->json($data, 404);
        }
    }
    public function store(Request $request)
    {
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'status' => 'required',
                'tgl_masuk' => 'date|required',
                'tgl_keluar' => 'date|required'
            ],
            [
                'nama.required' => 'Masukan nama Anda !',
                'phone.required' => 'Masukkan Nomer Phone !',
                'addres.required' => 'Masukkan alamat anda !',
                'status.required' => 'Masukkan Status anda !',
                'tgl_masuk.required' => 'Masukkan tanggal masuk anda !',
                'tgl_keluar.required' => 'Masukkan tanggal keluar anda !',
                'tgl_masuk.date' => 'Masukkan tanggal Sesuai format (Tahun-bulan-tanggal) !',
                'tgl_keluar.date' => 'Masukkan tanggal Sesuai format (Tahun-bulan-tanggal) !',
            ]
        );

        if ($validasi->fails()) {
            $data = [
                'massege' => 'Data Tidak berhasil diinput',
                'data' => $validasi->errors()
            ];
            return response()->json($data, 404);
        } else {
            $input = [
                'nama' => $request->nama,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status,
                'tgl_masuk' => $request->tgl_masuk,
                'tgl_keluar' => $request->tgl_keluar,
            ];
            $patients = patients::create($input);

            $data = [
                'massege' => 'patients is created Successfully',
                'data' => $patients,
            ];
            return response()->json($data, 200);
        }
    }
    public function show($id)
    {
        $patients = Patients::find($id);

        if ($patients) {
            $data = [
                'messege' => 'Get detail Data',
                'data' => $patients,
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'messege' => 'Data not found',
            ];
            return response()->json($data, 404);
        }
    }
    public function update(Request $request, $id)
    {
        $pastiens = Patients::find($id);
        $pastiens->update($request->all());
        if ($pastiens) {
            $input = [
                'nama' => $request->nama ?? $pastiens->nama,
                'nim' => $request->nim ?? $pastiens->nim,
                'email' => $request->email ?? $pastiens->email,
                "jurusan" => $request->jurusan ?? $pastiens->jurusan
            ];
            $pastiens->update($input);

            $data = [
                'massege' => 'Data is Updated',
                'data' => $pastiens
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'massege' => "Data not found"
            ];
            return response()->json($data, 404);
        }
    }
    public function destroy($id)
    {
        $patients = Patients::find($id);
        if ($patients) {
            $patients->delete();

            $data = [
                'massege' => "data is deleted"
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'massege' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }
    public function search($nama)
    {

        $pasien = Patients::where('nama', 'like', '%' . $nama . '%')->get();

        $data = [
            'massege' => 'Data pasien ' . $nama . '',
            'data' => $pasien
        ];
        return response()->json($data, 200);
    }
    public function status($status)
    {



        $covid = Patients::where('status', $status)->count();

        $data = [
            'massege' => 'Data pasien dengan status ' . $status . ' ; ',
            'jumlah' => $covid

        ];

        return response()->json($data, 200);
    }
}
