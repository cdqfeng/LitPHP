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
 * Redis缓存类
 * 使用redis缓存类必须先安装redis客户端并运行
 */
class Redis extends \Redis {

	//构造函数
	public function __construct() {

		$this->connect(REDIS_HOST,REDIS_PORT);

	}

}