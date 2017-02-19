<?php

namespace App\Http\Controllers\Service\Admin;

use App\Orm\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\Admin\BasicController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends BasicController
{
    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $link = Navs::find($input['nav_id']);
        $link->nav_order = $input['nav_order'];
        $re = $link->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg'    => '排序成功！'

            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '排序失败！'

            ];
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.list',compact('nav'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.navs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //except delete or filed
        $input = Input::except('_token');
        $rules =[
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        $message = [
            'nav_name.required'=>'链接名称是必填的',
            'nav_url.required'=>'链接地址是必填的',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){

            $re = Navs::create($input);
            if($re)
            {
                return redirect('admin/navs')->with('ok','添加成功！');
            }else{
                return back()->with('errors','添加失败，稍后在试。');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nav = Navs::find($id);
        return view('admin.navs.edit',compact('nav'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        $rules =[
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        $message = [
            'nav_name.required'=>'链接名称是必填的',
            'nav_url.required'=>'链接地址是必填的',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $re = Navs::where('nav_id',$id)
                ->update($data);
            if($re)
            {
                return redirect('admin/navs')->with('ok','修改成功!');
            }else{
                return back()->with('errors','修改失败，稍后在试。(或者没有任何内容改动 )');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $re = Navs::where('nav_id', $id)
            ->delete();
        if($re){
            $data = [
                'status' => 0,
                'message'=>'ok',
            ];
        }else{
            $data = [
                'status' => 1,
                'message'=>'no',
            ];
        }
        return $data;

    }
}
