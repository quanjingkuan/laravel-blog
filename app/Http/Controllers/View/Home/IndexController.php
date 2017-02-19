<?php

namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\View\Home\CommonController;
use App\Orm\Article;
use App\Orm\Category;
use App\Orm\Links;
use App\Orm\Navs;
use Illuminate\Http\Request;
class IndexController extends CommonController
{
    public function index($value='')
    {
    	
    	//图文列表带分页
    		$data = Article::orderBy('art_time','desc')->paginate(5);
    	//读取配置项

    	return view('home.index',compact('hot','data','new','link','hots'));
    }
    
    public function cate($cate_id)
    {
    	$field = Category::find($cate_id);
    	Category::where('cate_id',$cate_id)->increment('cate_view');
    	$art   = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(5);

    	$submenu = Category::where('cate_pid',$cate_id)->get();
    	return view('home.list',compact('field','art','submenu'));
    }

    public function item($art_id)
    {
    	$art = Article::where('art_id',$art_id)->first();
    	Article::where('art_id',$art_id)->increment('art_view');
    	$article['prev'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
    	$article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
    	$data = Article::where('cate_id',$art->art_id)->take(4);
    	return view('home.item',compact('art','prev','article','data'))->__toString();
    }
}
