<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;

class StudentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();
        if (count($students)) {
            $data = [
                'messege' => 'Get all Students',
                'data' => $students,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'messege' => "Data Eror"
            ];
            return response()->json($data, 404);
        }
    }
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'jurusan' => 'required'
        ]);

        if ($validasi->fails()) {
            $data = [
                'massege' => 'Data Tidak berhasil diinput',
                'data' => $validasi->errors()
            ];
            return response()->json($data, 404);
        } else {
            $input = [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
            ];
            $student = Student::create($input);

            $data = [
                'massege' => 'Student is created Successfully',
                'data' => $student,
            ];
            return response()->json($data, 200);
        }
    }
    public function update(Request $request, $id)
    {
        $students = Student::find($id);
        $students->update($request->all());
        if ($students) {
            $input = [
                'nama' => $request->nama ?? $students->nama,
                'nim' => $request->nim ?? $students->nim,
                'email' => $request->email ?? $students->email,
                "jurusan" => $request->jurusan ?? $students->jurusan
            ];
            $students->update($input);

            $data = [
                'massege' => 'Student is Updated',
                'data' => $students
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'massege' => "Student not found"
            ];
            return response()->json($data, 404);
        }
    }
    public function destroy($id)
    {
        $students = Student::find($id);
        if ($students) {
            $students->delete();

            $data = [
                'massege' => "Student is deleted"
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'massege' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function show($id)
    {
        $students = Student::find($id);

        if ($students) {
            $data = [
                'messege' => 'Get detail Student',
                'data' => $students,
            ];
            return response()->json($data, 202);
        } else {
            $data = [
                'messege' => 'Student not found',
            ];
            return response()->json($data, 404);
        }
    }
}
