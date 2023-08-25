<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\View;

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
        'email' => 'required|email|unique:doctors,email',
        'password' => 'required|min:8',
        'phone' => 'required|numeric',
        'speciality' => 'required|not_in:--Select--',
        'room' => 'required|numeric',
        'file' => 'required|file',
    ]);

    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $image = $request->file('file');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $image->move('doctorimage', $imagename);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->usertype = 2;

        $user->save();

        $doctor = new Doctor;
        $doctor->user_id = $user->id;
        $doctor->image = $imagename;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
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

    if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $image = $request->file('file');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move('doctorimage', $imagename);
        $data->image = $imagename;
    }

    if ($request->filled('password')) {
        $data->password = bcrypt($request->password);
    }

    $data->save();
    return redirect()->back()->with('message', 'Doctor Information Updated Successfully');
}
    public function getUserTypeCounts()
    {
        $userTypeCounts = User::select('usertype', \DB::raw('COUNT(*) as count'))
            ->groupBy('usertype')
            ->get()
            ->keyBy('usertype')
            ->map(function ($item) {
                return $item->count;
            });

        $counts = [
            'patients' => $userTypeCounts->get(0, 0),
            'doctors' => $userTypeCounts->get(2, 0),
            'admins' => $userTypeCounts->get(1, 0),
        ];

        return response()->json($counts);
    }
    public function getAppointmentStatusCounts()
    {
        // Fetch the counts for each appointment status from the database
        $inProgressCount = Appointment::where('status', 'in progress')->count();
        $approvedCount = Appointment::where('status', 'approved')->count();
        $cancelledCount = Appointment::where('status', 'canceled')->count();

        // Return the data as JSON
        return response()->json([
            'inProgressCount' => $inProgressCount,
            'approvedCount' => $approvedCount,
            'cancelledCount' => $cancelledCount,
        ]);
    }
    public function showUsers()
    {
        $users = User::all();
//        dd($users);
        return view('admin.home', compact('users'));

    }
}
