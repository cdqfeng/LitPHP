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
 * LitPHP初始化类
 */
class LitPHP {

	//构造函数
	public function __construct() {

		//定义应用根目录 (应用入口文件的根目录)
		$root=rtrim(dirname(rtrim($_SERVER['SCRIPT_NAME'])));
		define('__ROOT__',  (($root=='/' || $root=='\\')?'':$root));

		//加载配置
		$this->loadConfig();

		//当DEBUG为off时关闭所有PHP错误报告,默认设置为on
		if(DEBUG=="off") {
			error_reporting(0);
		}

		//自动加载类函数
		spl_autoload_register(function($class){
				if(file_exists(strstr(APP_PATH,"/",true)."/".$class.".class.php")) {
				include(strstr(APP_PATH,"/",true)."/".$class.".class.php");
			}
		});

		//生成应用目录下的基础目录及默认控制器类
		$this->createFile();
		//实例化控制器类
		$this->instance();
		
	}

	//加载配置
	public function loadConfig() {

		$list=array();

		//有自定义配置时加载自定义配置文件
		if(file_exists(strstr(APP_PATH,"/",true)."/".basename(APP_PATH)."/conf/Config.php")) {
			$list=include(strstr(APP_PATH,"/",true)."/".basename(APP_PATH)."/conf/Config.php");
		//无自定义配置文件时加载系统默认的配置文件
		}else {
			$list=include(strstr(APP_PATH,"/",true)."/"."LitPHP/Config.php");
		}

		//将配置参数转化为常量
		foreach ($list as $key => $value) {
			define($key,$value);
		}
	}

	//实例化类和执行类的方法
	public function instance() {

		//创建路由对象
		$route=new \LitPHP\Route();

		//获取包含控制器名 方法名 参数的数组
		$list=array();
		//这里的parseUrl方法可用在Route类中自定义的解析规则替代
		$list=$route->parseUrl();

		//实例化类
		$class=basename(APP_PATH)."\\".CONTROLLER_LAYER."\\".ucfirst($list[0]).ucfirst(CONTROLLER_LAYER);
		$class=new $class;

		//执行方法
		if(method_exists($class, $list[1])) {
			$class->$list[1]();
		}else {
			die("The method ".$list[1]." of class ".$list[0]." does not exist");
		}
	}	


	//创建应用目录下的文件夹
	public function createFile() {

		if(!file_exists(APP_PATH."controller")) {
			mkdir(APP_PATH."controller");
		}
		if(!file_exists(APP_PATH."controller/IndexController.class.php")) {
			$data="<?php\r\n\r\nnamespace ".basename(APP_PATH)."\\controller;\r\nuse LitPHP\\Controller;\r\n\r\nclass IndexController extends Controller {\r\n\r\n\tpublic function index() {\r\n\r\n\t\theader('Content-Type:text/html;charset=utf-8');\r\n\t\techo '<h1>欢迎使用LitPHP框架! :)</h1>';\r\n\t}\r\n}";
			file_put_contents(APP_PATH."controller/IndexController.class.php",$data);
		}
		if(!file_exists(APP_PATH."model")) {
			mkdir(APP_PATH."model");
		}
		if(!file_exists(APP_PATH."view")) {
			mkdir(APP_PATH."view");
		}
		if(!file_exists(APP_PATH."view/compile")) {
			mkdir(APP_PATH."view/compile");
		}
		if(!file_exists(APP_PATH."view/cache")) {
			mkdir(APP_PATH."view/cache");
		}
		if(!file_exists(APP_PATH."conf")) {
			mkdir(APP_PATH."conf");
		}

	}


}
