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

        // Check if the user's medical history has been submitted before
        if ($user->medicalHistories()->where('medical_history_submitted', true)->exists()) {
            return redirect()->route('user.medical-history')->with('error', 'Medical history has already been submitted.');
        }

        // Create a new medical history record using Eloquent
        $medicalHistory = new MedicalHistory($validatedData);
        $user->medicalHistories()->save($medicalHistory);

        // Update the medical_history_submitted column for the user's medical history
        $user->medicalHistories()->update(['medical_history_submitted' => true]);

        return redirect()->route('user.medical-history')->with('success', 'Medical history recorded and submitted successfully.');
    }


}
