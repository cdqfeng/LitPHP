<?php
/******************************************************
 *                                                    *
 * LitPHP Version: 1.0                                *
 * Author：清风                                       *
 * Email：it_layout@163.com                           *
 * Date: 2015-10-8                                    *
 *                                                    *
 *****************************************************/

namespace LitPHP;
use LitPHP\Smarty;

//防止通过地址栏直接访问
defined("APP_PATH") or die('You hava no permission to access');

/**
 * 基础控制器类
 * 基础控制器类重写了smarty模版引擎类的assign,display方法
 */
class Controller {

	//模版类
	protected $template=NULL;

	//构造函数
	public function __construct() {

		$this->template=new Smarty();
		
	}

	//模版变量赋值
	public function assign($arg0,$arg1) {

		$this->template->assign($arg0,$arg1);
		
	}

	//渲染模版
	public function display($arg0) {

		$this->template->display($arg0);
		
	}

}

