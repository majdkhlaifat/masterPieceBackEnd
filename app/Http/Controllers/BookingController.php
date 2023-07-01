<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;



class BookingController extends Controller
{
    public function create()
    {
        $doctors = Doctor::all();
        return view('user.booking', compact('doctors'));
    }
    public function submitAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
            'department' => 'required',
            'date' => 'required',
            'time' => 'required|unique:appointments,time,NULL,id,date,' . $request->input('date'),
        ]);
    }
    public function appointment(Request $request)
    {
        $data = new appointment;

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->doctor=$request->doctor;
        $data->date=$request->date;
        $data->time=$request->time;
        $data->message=$request->message;
        $data->status='In progress';
        if(Auth::id())
        {
            $data->user_id=Auth::user()->id;
        }
        $data->save();
        return redirect()->back()->with('message','Appointment Request Successful. We will contact with you soon.');
    }
    public function myAppointment()
    {
        if(Auth::id())
        {
            $userid=Auth::user()->id;
            $appoints =appointment::where('user_id',$userid)->get();
            return view('user.my_appointment',compact('appoints'));
        }
        else{
            return redirect()->back();
        }
    }
    public function cancel_appoint($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}
