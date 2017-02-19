<?php

namespace App\Http\Controllers\Service\Admin;

use App\Orm\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Service\Admin\BasicController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends BasicController
{
    public function changeContent(Request $request)
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k=>$v){
             Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putField();
        return back();
    }

    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $link = Config::find($input['conf_id']);
        $link->conf_order = $input['conf_order'];
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
        $conf = Config::orderBy('conf_order','asc')->get();
        foreach($conf as $k=>$v){
            switch($v->field_type){
                case 'input' :
                    $conf[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'"/>';
                    break;
                case 'textarea' :
                    $conf[$k]->_html = '<textarea  name="conf_content[]" >'.$v->conf_content.'</textarea>';
                    break;
                case 'radio' :
                    $attr = explode(',',$v->field_value);
                    $str = '';
                    foreach($attr as $m=>$n){
                        $r =  explode('|',$n);
                        $c=$v->conf_content == $r[0]? 'checked' : '';

                        $str .= '<input type="radio" name="conf_content[]"  value="'.$n[0].'" '.$c.'/>'.$r[1].'&nbsp;';
                    }
                    $conf[$k]->_html = $str;
                    break;
                case 'file' :
                    $conf[$k]->_html = '<input type="text" class="md" id="fodimg" name="conf_content[]" value="'.$v->conf_content.'" size="50">
                                        <input id="file_upload"  type="file" multiple="true" >';
                    break;
            }
        }
        return view('admin.config.list',compact('conf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.add');
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
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $message = [
            'conf_name.required'=>'名称是必填的',
            'conf_title.required'=>'标题是必填的',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){

            $re = Config::create($input);
            if($re)
            {
                $this->putField();
                return redirect('admin/config')->with('ok','添加成功！');
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
        $conf = Config::find($id);
        return view('admin.config.edit',compact('conf'));
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
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        $message = [
            'conf_name.required'=>'名称是必填的',
            'conf_title.required'=>'标题是必填的',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $re = Config::where('conf_id',$id)
                ->update($data);
            if($re)
            {
                $this->putField();
                return redirect('admin/config')->with('ok','修改成功!');
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
        $re = Config::where('conf_id', $id)
            ->delete();
        if($re){
            $this->putField();
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

    public function putField()
    {
        \Illuminate\Support\Facades\Config::get('web');
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'/config/web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);

    }
}
