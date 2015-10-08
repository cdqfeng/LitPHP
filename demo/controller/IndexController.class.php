<?php

namespace demo\controller;
use LitPHP\Controller;
use LitPHP\Page;
use LitPHP\Verify;

class IndexController extends Controller {

	//使用模版类demo
	public function index() {

		//向模版变量赋值
		$this->assign("welcome","欢迎使用LitPHP框架:)");
		//渲染模版
		$this->display("index.html");
	}

	//使用分页类demo
	public function page() {

		//实例化分页类 设置总记录数为16 每页显示2条记录
		$page=new Page(16,2);
		//向分页链接中插入参数
		$page->parameter("id","123");
		$page->parameter("name","litphper");
		echo $page->outPut();
	}

	//使用验证码类demo
	public function verify() {

		//实例化验证码类
		$verify=new Verify();
		$verify->outPut();		

	}

}