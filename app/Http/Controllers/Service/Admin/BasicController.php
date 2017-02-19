<?php

namespace App\Http\Controllers\Service\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BasicController extends Controller
{
    //upload img 
    public function uploadImg(Request $request)
    {
        $file = Input::file('Filedata');
        if($file->isValid()){
            $realPath = $file->getRealPath(); //临时文件绝对路径
            $entension= $file->getClientOriginalExtension();//后缀
            if($entension == 'png' || $entension == 'jpge' || $entension == 'gif'){
            $newname = md5(date('YmdHis')).mt_rand(100,999).'.'.$entension;
            $path = $file->move('uploads/',$newname);
            $filePath = 'uploads/'.$newname;
                return $filePath;
            }else{
                return back()->with('errors','非法文件');
            }

        }
    }
}
