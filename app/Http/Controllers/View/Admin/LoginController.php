<?php

namespace App\Http\Controllers\View\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function toLogin()
    {
        if(session('username')){
            return redirect('admin/index');
        }
        return view('admin.login');
    }
}
