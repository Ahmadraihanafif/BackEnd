<?php

namespace App\Http\Controllers;

use App\Models\Student;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();

        $data = [
            'messege' => 'Get all Students',
            'data' => $students,
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
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
        return response()->json($data, 201);
    }
    public function update(Request $request, $id)
    {
        $students = Student::find($id);
        $students->update($request->all());
        return $students;
    }
    public function destroy($id)
    {
        return Student::destroy($id);
    }
}
