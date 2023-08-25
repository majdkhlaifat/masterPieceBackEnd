<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->usertype == '0') {
                return view('user.home');
            } elseif ($user->usertype == '1') {
                return view('admin.addDoctor');
            } elseif ($user->usertype == '2') {
                return redirect()->route('doctor.home');
            }
        }

        return redirect()->back();
    }
    public function index()
    {
        return view('user.home');
    }
    public function chatbot()
    {
        return view('user.chatbot');
    }

    public function heartAge()
    {
        return view('user.heart-age');
    }

    public function weightManagement()
    {
        return view('user.weightManagement');
    }

    public function history()
    {
        $user = Auth::user();
        return view('user.medical-history', compact('user'));
    }
    public function livechat($doctor)
    {
        $user = Auth::user();

        // Find a conversation where the user is either the patient or the doctor
        $conversation = Conversation::where(function ($query) use ($user, $doctor) {
//            dd($user->id);
            $query->where('user_id', $user->id)
                ->where('id', $doctor);
        })->orWhere(function ($query) use ($user, $doctor) {
            $query->where('user_id', $doctor)
                ->where('id', $user->id);
        })->firstOrFail();

        return view('user.livechat', compact('user', 'conversation'));
    }



}
