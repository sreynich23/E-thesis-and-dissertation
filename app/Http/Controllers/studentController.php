<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.studet', compact('students'));
    }

    public function create(Request $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'id_number' => $request->id_number,
        ]);
        $student->save();

        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'id_number' => 'required|unique:students,id_number,' . $id,
        ]);

        $student->update([
            'name' => $request->name,
            'id_number' => $request->id_number,
            'password' => $request->password ? bcrypt($request->password) : $student->password,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->back();
    }
}
