<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\MedicalHistory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function home()
    {
        $users = User::where('usertype', 0)->get();
        return view('doctor.home', compact('users'));
    }


    public function patientPortal($patient_id)
{
    $patient = User::findOrFail($patient_id);
    $medicalHistory = MedicalHistory::where('user_id', $patient_id)->first();

    return view('doctor.patientPortal', compact('patient', 'medicalHistory'));
}
    public function storeMedicalHistory(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'dob' => 'required',
            'diabetes' => 'required|in:yes,no',
            'hypertension' => 'required|in:yes,no',
            'heart_disease' => 'required|in:yes,no',
            'smoking' => 'required|in:yes,no',
            'blood_type' => 'required',
            'allergies' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        // Create a new medical history record using Eloquent
        $medicalHistory = new MedicalHistory($validatedData);
        $user->medicalHistories()->save($medicalHistory);
        return redirect()->route('user.medical-history')->with('success', 'Medical history recorded successfully.');
    }
}
