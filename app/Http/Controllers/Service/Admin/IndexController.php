<?php

namespace App\Http\Controllers\Service\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Service\Admin\BasicController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Orm\AdminUser;
class IndexController extends BasicController
{
    public function logout()
    {
        session(['username'=> null]);
        return redirect('admin/login');
    }

    public function updata()
    {
            if($input = Input::all()){
                $rules =[
                    'password_o'=>'required',
                    'password'=>'required|between:6,20|confirmed',
                ];
                $validator = Validator::make($input,$rules);
                if($validator->passes()){
                    $user = AdminUser::find(1);
                    $password_o = Input::get('password_o');
                    if(Crypt::decrypt($user->password) != $password_o){
                        return back()->with('errors','password_o is error');
                    }else{
                        $password = Input::get('password');
                        $enc = Crypt::encrypt($password);
                        $user->password = $enc;
                        $user->save();
                        return redirect('admin/info')->with('sucess','成功！下次重新登陆生效！');
                    }
                }else{
                    return back()->withErrors($validator);
                }
            }
    }
}
