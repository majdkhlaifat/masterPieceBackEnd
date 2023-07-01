<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.addDoctor');
    }
    public function upload(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'phone' => 'required|numeric',
        'speciality' => 'required|not_in:--Select--',
        'room' => 'required|numeric',
        'file' => 'required|file',
    ]);

    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $image = $request->file('file');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $image->move('doctorimage', $imagename);

        $doctor = new Doctor;
        $doctor->image = $imagename;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Added Successfully');
    } else {
        return redirect()->back()->withErrors(['file' => 'Invalid or missing file']);
    }
}
    public function view()
    {
        $doctors = Doctor::all();
        return view('user.telemedicine', compact('doctors'));
    }
    public function show()
    {
        $doctors = Doctor::all();
        return view('user.booking', compact('doctors'));
    }

}
