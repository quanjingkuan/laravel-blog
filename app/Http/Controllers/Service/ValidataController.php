<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;
use App\Orm\AdminUser;
use Illuminate\Support\Facades\Crypt;

class ValidataController extends Controller
{
    public function create(Request $request)
    {
        $validata_code = new ValidateCode;
        $request->session()->put('validata_code',$validata_code->getCode());
        return $validata_code->doimg();

    }

    public function validata_admin_login(Request $request)
    {
        $username = $request->input('username','');
        $password = $request->input('password','');
        $code     = $request->input('code','');
        $user = AdminUser::find(1);
        if($username == null) return back()->with('status','Username is null');
        if($password == null) return back()->with('status','Password is null');
        if(strlen($code) != 4) return back()->with('status','Code length is 4 .');
        if($username != $user->username) return back()->with('status','用户名错误！');
        if($password != Crypt::decrypt($user->password)) return back()->with('status','密码错误！');
        $validata_code_session = session()->get('validata_code');
        if($validata_code_session != $code) return back()->with('status','验证码错误！');
        session()->put('username',$user->username);
        return redirect('admin/index');




    }
}
