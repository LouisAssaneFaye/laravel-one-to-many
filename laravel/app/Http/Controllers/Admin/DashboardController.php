<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home (){
        $user=Auth::user();
        $id=Auth::id();
        return view('admin.home', compact('user','id'));
    }
}
