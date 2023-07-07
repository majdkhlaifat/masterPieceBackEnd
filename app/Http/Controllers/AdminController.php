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
    public function showDoctors()
    {
        $data = Doctor::all();
        return view('admin.showDoctors', compact('data'));
    }
    public function deleteDoctor($id)
    {
        $data = Doctor::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Doctor deleted successfully.');
    }
    public function updateDoctor($id)
    {
        $data = Doctor::find($id);
        return view('admin.updateDoctor',compact('data'));
    }
    public function editDoctor(Request $request, $id)
    {
        $data = Doctor::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->speciality = $request->speciality;
        $data->room = $request->room;

        $image = $request->file;

        if($image){
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $image->move('doctorimage', $imagename);
        $data->image = $imagename;
        }
        
        $data->save();
        return redirect()->back()->with('message', 'Doctor Information Updated Successfully');

    }
}
