<?php

namespace App\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

trait RedirectTo
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $role = Auth::user()->roles->first()->name;
        // dd($role);
        if (!empty($this->redirectTo)) {
            return $this->redirectTo;
        }
        if ($role == 'admin') {
            return redirect('/admin/home');
        }
         elseif ($role == 'jobseeker') {
            return Route('jobseekerDashboard.index');
        } elseif ($role == 'mentor') {
            return Route('job-posting-mentor.index');
        } else {
            return Route('employerDashboard.index');
        }
    }
}

