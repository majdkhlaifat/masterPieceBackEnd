<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientNotice;
use App\Models\User;

class PatientController extends Controller
{
    public function patientPortal()
{
    $userId = auth()->id();
    $notices = PatientNotice::where('patient_id', $userId)
        ->with('doctor')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.patientPortal', compact('notices'));
}


    public function addNotice(Request $request)
    {
        $request->validate([
            'notice' => 'required',
        ]);

        $user = $request->user();

        $notice = new PatientNotice;
        $notice->patient_id = $request->patient_id;
        $notice->doctor_id = $user->doctor->id;
        $notice->notice = $request->notice;
        $notice->save();

        return redirect()->back()->with('message', 'Notice added successfully.');
    }

    public function doctorPatientPortal($patient_id, $doctor_id)
    {
        $patient = User::findOrFail($patient_id);
        $doctor = User::findOrFail($doctor_id);

        return view('doctor.patientPortal', compact('patient', 'doctor'));
    }
}