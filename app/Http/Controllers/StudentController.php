<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{

//  public function StudenstList()
//  {
//    $students = Student::all();
//    return response()->json(['students'=>$students]);
//  }

  public function getStudents(){
    $students = Student::all();
    return response()->json(['students'=>$students]);
  }

  public function addStudent()
  {
  return view('form');
  }

  public function getStudentData($id){

    $student = Student::where('id',$id)->get();

    return view('edit-user',['student'=>$student]);
  }


  public function updateStudent(Request $request){

    $student = Student::find($request->id);
    if (!$student) {
      return response()->json(['message' => 'Student not found'], 404);
    }

    $student->name = $request->name;
    $student->email = $request->email;

    if($request->hasFile('file'))
    {
      $file = $request->file('file');
      $fileName = time().''.$file->getClientOriginalName();
      $filePath = $file->storeAs('images',$fileName, 'public');
      $student->image = $filePath;
    }

    $student->save();

    return response()->json(['message' => 'Student updated successfully','filePath'=>$student->image]);

  }

  public function form_submit(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('images', 'public');
      $validatedData['image'] = $imagePath;
    }

    $student = new Student($validatedData);
    $student->save();

    return response()->json(['message' => 'Data uploaded successfully']);
  }

  public function deleteStudent($id)
  {
//  Student::where('id',$id)->delete();
    return response()->json(['message'=>'Student Deleted']);
  }
}
