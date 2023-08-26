<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        if (!Auth::check()) {
            // User is not logged in, show the error message and redirect back
            $errorMessage = __('You have to be logged in to book your appointment');
            Session::flash('error', $errorMessage);
            return redirect()->back();
        }
        $doctors = Doctor::all();
        // Fetch booked appointments for the selected doctor and date
        $bookedAppointments = Appointment::where('doctor', $request->doctor)
            ->where('date', $request->date)
            ->pluck('time')
            ->toArray();

        // Fetch doctor's working hours
        $workingHoursStart = Carbon::createFromFormat('H:i', '09:00');
        $workingHoursEnd = Carbon::createFromFormat('H:i', '18:00');

        // Calculate available time slots
        $availableTimeSlots = [];
        $currentTime = $workingHoursStart;
        while ($currentTime < $workingHoursEnd) {
            $timeSlot = $currentTime->format('H:i');
            if (!in_array($timeSlot, $bookedAppointments)) {
                $availableTimeSlots[] = $timeSlot;
            }
            $currentTime->addMinutes(30);
        }

        return view('user.booking', compact('doctors', 'availableTimeSlots'));

    }

    public function submit(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'doctor' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Check if the selected date and time are available
        $isAvailable = DB::table('appointments')
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->doesntExist();

        if (!$isAvailable) {
            return redirect()->back()->withErrors(['time' => 'Selected date and time are not available.']);
        }
        // Check for duplicate appointments
        $existingAppointment = Appointment::where('doctor', $request->doctor)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->first();
        if ($existingAppointment) {
            return redirect()->back()->withErrors(['time' => 'Appointment already booked for the selected date and time.']);
        }

        // Create and save the appointment
        $appointment = new Appointment();
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->doctor = $request->doctor;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->message = $request->message;
        $appointment->status = 'In progress';
        if(Auth::id())
        {
            $appointment->user_id=Auth::user()->id;
        }
        $appointment->save();
        return redirect()->back()->with('message', 'Appointment booked successfully.');

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

}

