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

//防止通过地址栏直接访问
defined("APP_PATH") or die('You hava no permission to access');

/**
 * 路由解析类
 */
class Route {

	//重写规则解析url
	public function parseUrl() {

		//要返回的数组用于保存控制器名称及方法名称
		$list=array();

		//获取路径信息
		if(isset($_SERVER['PATH_INFO'])) {
			//去处前后斜杠
			$path_info=trim($_SERVER['PATH_INFO'],"/");
		}else {
			//没有路径信息则默认控制器为index 默认方法为index
			$path_info="index/index";
		}

		//暂时存放控制器名称及方法名称的数组
		$path=array();

		//将路径信息分离为数组
		$path=explode("/", $path_info);

		//获取控制器类名称
		$controller=$path[0];

		//定义控制器名称常量
		define("CONTROLLER", $controller);

		//将控制器名称存入数组
		$list[]=$controller;

		//获取方法名称
		$method=isset($path[1])?$path[1]:"index";

		//定义方法名称常量
		define("METHOD", $method);
	

		//将方法名称存入数组
		$list[]=$method;

		//将剩余的数组存入GET数组
		if(isset($path[2])) {
			for($i=2;$i<count($path);$i+=2) {
				$_GET[$path[$i]]=$path[$i+1];
			} 
		}

		return $list;
	}

	//这里可以添加自定义的url解析规则,但要在LitPHP初始化类 LitPHP 中替代原来的parseUrl方法

}