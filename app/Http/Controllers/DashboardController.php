<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if ($user->isManager()) {
            return view('manager.dashboard');
        }

        if ($user->isViceManager()) {
            return view('vice-manager.dashboard');
        }

        if ($user->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->isStudent()) {
            return redirect()->route('student.dashboard');
        }

        abort(403);
    }
}
