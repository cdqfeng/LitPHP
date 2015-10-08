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

//引入smarty模版引擎类
require_once strstr(APP_PATH,"/",true)."/".'LitPHP/smarty/Smarty.class.php';

/**
 * smarty模版类
 * smarty模版类继承smarty类并在该类实例化时设置模版存放目录，编译目录，缓存目录，左右限定符
 */
class Smarty extends \Smarty {

	//构造函数
	public function __construct() {

		//继承父类构造函数
		parent::__construct();

		//模版存放目录
		$this->template_dir=TEMPLATE_DIR;

		//模版编译目录
		$this->compile_dir=COMPILE_DIR;

		//缓存目录
		$this->cache_dir=CACHE_DIR;

		//是否开启缓存 开启为true 关闭为false
		$this->caching=CACHING;

		//设置缓存事件
		$this->cache_lifetime=CACHE_LIFETIME;

		//左限定符
		$this->left_delimiter=LEFT_DELIMITER;

		//右限定符
		$this->right_delimiter=RIGHT_DELIMITER;

		//模版变量ROOT为网站根目录
		$this->assign("ROOT",__ROOT__);

		//模版变量FRONT 存放模版 js css等的根目录 系统默认配置里该目录指向站点目录下的public文件夹
		$this->assign("FRONT",FRONT);

	}
	
}