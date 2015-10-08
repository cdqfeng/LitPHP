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
 * 图片处理类
 * 图片处理类可用来预览、剪切、缩放图片
 */
class Image {

	//图片资源
	protected $img;

	//图片存放路径
	protected $fileName;

	//图片信息
	public $info;


	/**
	 * 构造函数
	 * @param string $fileName 图片相对应用入口文件的相对路径
	 */
	public function __construct($fileName) {

		//图片相对应用入口文件的路径
		$this->fileName=$fileName;

		//获取图片的MIME类型，宽度，高度
		if(file_exists($fileName)) {

			$info=getimagesize($this->fileName);

			$this->info=array(
				'width' => $info[0],
				'height' => $info[1],
				'mime' => $info['mime']
			);

		}else {
			die("The file is not exist");
		}
		

		//判断图片MIME类型打开图片
		switch ($this->info['mime']) {
			case 'image/jpeg':
				$this->img=imagecreatefromjpeg($this->fileName);
				break;
			case 'image/png':
				$this->img=imagecreatefrompng($this->fileName);
				break;
			case 'image/gif':
				$this->img=imagecreatefromgif($this->fileName);
				break;
			default:
				die('The file is illegal,just accept jpeg | png | gif');
			break;
		}
	}



	//预览图片
	public function preview() {
		$this->outPut($this->img,false,NULL);
	}



	/**
	 * 剪切图片
	 * @param int $x 图片中的x坐标
	 * @param int $y 图片中的y坐标
	 * @param int $width 拷贝范围的宽度
	 * @param int $height 拷贝范围的高度
	 * @param boolean $boolean 是否替换原图片
	 * @param string $fileName 图片相对应用入口文件的相对路径
	 */
	public function clip($x,$y,$width,$height,$boolean,$fileName) {

		//判断新图片是否过宽过高
		if($width>$this->info['width'] || $height>$this->info['height']) {
			die("the target image is too width or too height");
		}else {

			//新建图片
			$tagImg=imagecreatetruecolor($width, $height);

			//拷贝图片的一部分
			imagecopy($tagImg, $this->img, 0, 0, $x, $y, $width, $height);

			//输出图片
			$this->outPut($tagImg,$boolean,$fileName);

			//释放图片占用的内存
			imagedestroy($tagImg);
		    imagedestroy($this->img);
		}

	}



	/**
	 * 缩放图片
	 * @param float $zoom 图片缩放比例
	 * @param boolean $boolean 是否替换原图片
	 * @param string $fileName 图片相对应用入口文件的相对路径
	 */
	public function zoom($zoom,$boolean,$fileName) {

		//新建图片
		$tagImg=imagecreatetruecolor(floor($zoom*$this->info['width']), floor($zoom*$this->info['height']));

		//重采样拷贝部分图片并调整大小
		imagecopyresampled($tagImg,$this->img,0,0,0,0,floor($zoom*$this->info['width']), floor($zoom*$this->info['height']),$this->info['width'],$this->info['height']);
	
		//输出图片
		$this->outPut($tagImg,$boolean,$fileName);

		//释放图片占用的内存
		imagedestroy($tagImg);
	    imagedestroy($this->img);

	}



	/**
	 * 输出图片
	 * @param string $fileName 图片相对应用入口文件的相对路径
	 * @param string $img 图片资源
	 * @param boolean $boolean true图片输出到文件 false图片输出到浏览器
	 */
	protected function outPut($img,$boolean=false,$fileName) {

		//判断图片MIME输出图片到浏览器或文件
		switch ($this->info['mime']) {
			case 'image/jpeg':
				if($boolean) {
					imagejpeg($img,$fileName);
				}else {
					header('Content-type:image/jpeg');
					imagejpeg($img);
				}
				break;
			case 'image/png':
				if($boolean) {
					imagepng($img,$fileName);
				}else {
					header('Content-type:image/png');
					imagepng($img);
				}
				break;
			case 'image/gif':
				if($boolean) {
					imagegif($img,$fileName);
				}else {
					header('Content-type:image/gif');
					imagegif($img);
				}
				break;
		}
		
	}

}