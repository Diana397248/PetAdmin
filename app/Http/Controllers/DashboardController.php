<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        //TODO
        $authenticatable = Auth::user();
        if ($authenticatable) {
            $userRole = $authenticatable->role;
            if ($userRole === 'admin') {
                return redirect("/clients");
            } elseif ($userRole === 'doctor')
                return redirect("/appointments");
        }
        return Inertia::render('Dashboard');

    }
}
