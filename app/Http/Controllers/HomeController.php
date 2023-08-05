<?php

namespace App\Http\Controllers;

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
                return view('admin.home');
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
}
