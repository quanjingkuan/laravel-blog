<?php

namespace App\Http\Controllers\View\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    public function toIndex()
    {
        return view('admin.index');
    }

    public function toInfo()
    {
        return view('admin.info');
    }

    public function toPass()
    {
        return view('admin.pass');
    }
}
