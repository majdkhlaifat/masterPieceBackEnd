<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function home()
    {
        $users = User::where('usertype', 0)->get();
        return view('doctor.home', compact('users'));
    }


    public function patientPortal($patient_id)
{
    $patient = User::find($patient_id);
    return view('doctor.patientPortal', compact('patient'));
}

}
