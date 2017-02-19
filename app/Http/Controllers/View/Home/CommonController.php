<?php

namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use App\Orm\Article;
use App\Orm\Category;
use App\Orm\Links;
use App\Orm\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class CommonController extends Controller
{
    public function __construct()
    {
    	//nav
    	$tagn = Category::where('cate_pid',0)->get();
    	View::share('tagn',$tagn);
    	//自定义导航获取
	    	$navs = Navs::orderBy('nav_order','asc')->get();
	    	View::share('navs',$navs);
    	//点击率最高的6篇文章 图文区域
    		$hot = Article::orderBy('art_view','desc')->take(6)->get();
	    	View::share('hot',$hot);

    	//点击排行右侧区域
    		$hots = Article::orderBy('art_view','desc')->take(5)->get();
			View::share('hots',$hots);

		//最新8篇文章
    		$new = Article::orderBy('art_time','desc')->take(8)->get();
    		View::share('new',$new);
    	//友情链接
    		$link = Links::orderBy('links_order','asc')->take(6)->get();
    		View::share('link',$link);
    	
    		$submenu = '';
    		View::share('submenu',$submenu);
    }
}
