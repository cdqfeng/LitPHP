<?php
/******************************************************
 *                                                    *
 * LitPHP Version: 1.0                                *
 * Author：清风                                       *
 * Email：it_layout@163.com                           *
 * Date: 2015-10-8                                    *
 *                                                    *
 *****************************************************/

//防止通过地址栏直接访问
defined("APP_PATH") or die('You hava no permission to access');

//SmartyPHP配置文件
return Array(

	//基础设置
	'FRONT'					=>		__ROOT__.'/view',								//存放前端html css js等
	
	//PHP错误报告开关
	'DEBUG'					=>		'on',

	//应用设置
	'CONTROLLER_LAYER'		=>		'controller',									//控制器层
	'MODEL_LAYER'			=>		'model',										//模型文层
	'VIEW_LAYER'			=>		'view',											//视图层

	//模版引擎设置
	'TEMPLATE_DIR' 			=> 		APP_PATH.'view/',										//模版目录
	'COMPILE_DIR'  			=> 		APP_PATH.'view/compile',						//编译目录
	'CACHE_DIR'				=>		APP_PATH.'view/cache',							//缓存目录
	'CACHING'				=>		false,											//是否开启缓存
	'CACHE_LIFETIME'		=>		NULL,											//缓存存活时间 (秒)
	'LEFT_DELIMITER' 		=> 		'{{',											//左界定符
	'RIGHT_DELIMITER'   	=> 		'}}',											//右界定符

	//数据库设置
	'DBTYPE'				=>		'mysql',										//数据库类型
	'HOSTNAME'				=>		'localhost',									//主机名 (注意：不要加端口号)
	'DBNAME'				=>		'smartyphp_cms',											//数据库名
	'DBUSER'				=>		'root',											//数据用户名
	'DBPASSWORD'			=>		'123456',										//数据库密码
	
	//缓存数据库设置
	'REDIS_HOST'			=>		'127.0.0.1',									//缓存数据库主机名
	'REDIS_PORT'			=>		'6379'											//缓存数据库端口	
); 