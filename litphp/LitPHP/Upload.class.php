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
 * 文件上传类
 */
class Upload {

	//允许上传的文件类型
	public $type=array();

	//允许上传文件的大小(以字节计)
	protected $size;

	//默认文件名
	protected $fileName;


	/**
	 * 构造函数 
	 * @param array $type 允许上传的文件类型
	 * @param int $size 允许上传的文件的大小
	 */
	public function __construct($type,$size) {

		$this->type=$type;
		$this->size=$size;
		$this->fileName=date("YmdHis").mt_rand(4,4); 

	}


	/**
	 * 上传文件
	 * @param string $name 上传文件的name名称
	 * @param string $path 文件保存路径
	 */
	public function execute($name,$path) {

		if(isset($_FILES)) { 
			//取出上传文件类型
			$type=explode("/", $_FILES[$name]['type'])[1];
			//取出上传文件大小
			$size=$_FILES[$name]['size'];

			//判断上传文件类型及大小是否符合要求
			if(is_numeric(array_search($type, $this->type)) && $size<=$this->size) {
				//保存文件到新的文件夹
				move_uploaded_file($_FILES[$name]["tmp_name"],$path.$this->fileName.".".$type);
				return "upload success!";
			//文件类型不符合要求
			}elseif(!array_search($type, $this->type)) {
				return "The type of file is not permit!";
			//文件大小不符合要求
			}elseif($size>$this->size) {
				return "The size of file is too large";
			}
		}else {
			die("The upload file is not exist!");
		}

	}

}
 