<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user=User::all();
        return view('admin.user.index',compact('user'));
    }
    public function view($id)
    {
        $user=User::find($id);
        return view('admin.user.view',compact('user'));
    }
}
