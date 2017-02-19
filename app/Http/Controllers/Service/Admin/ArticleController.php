<?php

namespace App\Http\Controllers\Service\Admin;

use App\Orm\Article;
use App\Orm\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\Admin\BasicController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BasicController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('art_id','DESC')
                             ->paginate(15);
        return view('admin.article.list',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = (new Category)->tree();

        return view('admin.article.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = Input::except('_token');

        $input['art_time'] = time();
        $rules =[
            'art_title'=>'required',
            'art_content'=>'required',

        ];
        $message = [
            'art_title.required'=>'文章名称是必填的',
            'art_content.required'=>'内容是必填的',
        ];

        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Article::create($input);
            if($re)
            {
                return redirect('admin/article');
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
        $art = Article::where('art_id',$id)->first();
        $data = (new Category)->tree();
        return view('admin.article.edit',compact('data','art'));
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
        $input['art_time'] = time();
        $rules =[
            'art_title'=>'required',
            'art_content'=>'required',

        ];
        $message = [
            'art_title.required'=>'文章名称是必填的',
            'art_content.required'=>'内容是必填的',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $re = Article::where('art_id',$id)
                ->update($data);
            if($re)
            {
                return redirect('admin/article')->with('ok','修改成功!');
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
        $re = Article::where('art_id', $id)
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
