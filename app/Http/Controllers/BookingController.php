<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
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

    public function submit(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'doctor' => 'required',
        'date' => [
            'required',
            'date',
            'not_in:Friday', // Exclude Friday as a booking day
            'after_or_equal:' . now()->format('Y-m-d'), // Booking date should be today or in the future
        ],
        'time' => [
            'required',
            'date_format:H:i',
            'after_or_equal:09:00', // Booking time should be after or equal to 9 am
            'before_or_equal:18:00', // Booking time should be before or equal to 6 pm
            'not_in:12:30', // Exclude specific timeslot, e.g., 12:30 pm
        ],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $appointment = new Appointment;
    $appointment->name = $request->name;
    $appointment->email = $request->email;
    $appointment->phone = $request->phone;
    $appointment->doctor = $request->doctor;
    $appointment->date = $request->date;
    $appointment->time = $request->time;
    $appointment->message = $request->message;
    $appointment->status = 'In progress';
    $appointment->user_id = Auth::user()->id;
    $appointment->save();

    $bookedTime = $appointment->time;
    $bookedDate = $appointment->date;

    return redirect()->back()->with([
        'message' => 'Appointment Request Successful. We will contact you soon.',
        'bookedTime' => $bookedTime,
        'bookedDate' => $bookedDate,
    ]);
}




    public function appointment(Request $request)
    {
        $data = new Appointment;

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
    public function showAppointment(){
        $data = appointment::all();
        return view('admin.showAppointment',compact('data'));
    }
    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status='approved';
        $data->save();

        return redirect()->back();
    }
    public function canceled($id)
    {
        $data = appointment::find($id);
        $data->status='canceled';
        $data->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'department' => 'required',
            'date' => 'required',
            'time' => 'required|unique:appointments,time,NULL,id,date,' . $request->input('date'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new Appointment;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->doctor = $request->doctor;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->message = $request->message;
        $data->status = 'In progress';
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }
        $data->save();

        return redirect()->back()->with('message', 'Appointment Request Successful. We will contact you soon.');
    }
}
