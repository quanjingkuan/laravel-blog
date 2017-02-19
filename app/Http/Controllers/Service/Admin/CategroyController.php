<?php

namespace App\Http\Controllers\Service\Admin;

use App\Http\Controllers\Service\Admin\BasicController;
use App\Orm\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class CategroyController extends BasicController
{

    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
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
    public function index()
    {
        $categroy = Category::get();
        $data = (new Category)->tree();
        return view('admin.category.list')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data',$data));
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
            'cate_name'=>'required',
        ];
        $message = [
            'cate_name.required'=>'分类名称是必填的',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Category::create($input);
            if($re)
            {
                return redirect('admin/category');
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
        $cate = Category::find($id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('cate',$cate,'data',$data));
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
            'cate_name'=>'required',
        ];
        $message = [
            'cate_name.required'=>'分类名称是必填的',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $re = Category::where('cate_id',$id)
                            ->update($data);
            if($re)
            {
                return redirect('admin/category')->with('ok','修改成功!');
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
        $re = Category::where('cate_id', $id)
            ->delete();
        Category::where('cate_pid',$id)->update(['cate_pid'=>0]);
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
