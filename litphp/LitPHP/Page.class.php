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
 * 分页类
 */
class Page {

	//总页数
	private $pageAll;
	//要输出的分页链接集合
	private $pageList;
	//当前页码
	private $pageCurrent;
	//上一页
	private $prev;
	//下一页
	private $next;
	//每页显示的分页链接数 默认为5
	private $perPageLink=5;
	//页面开始页码
	private $current;
	//页面跳转时附带的参数
	private $parameter=Array();



	/**
	 * 构造函数
	 * @param int $arg0 从数据库中查询到的总记录条数
	 * @param int $arg1 每页显示的记录条数
	 */
	public function __construct($arg0,$arg1) {

		//获取总页数
		$this->pageAll=ceil($arg0/$arg1);

		//获取当前页码 如当前无页码 则默认页码为1
		$this->pageCurrent=isset($_GET['p'])?$_GET['p']:1;

		//上一页
		$this->prev=$this->pageCurrent-1<=0?1:$this->pageCurrent-1;

		//下一页
		$this->next=$this->pageCurrent+1>=$this->pageAll?$this->pageAll:$this->pageCurrent+1;

	}



	//插入参数
	public function parameter($arg0,$arg1) {

		$this->parameter[$arg0]=$arg1;
		
	}




	//生成分页字符串
	public function createPageList() {

		$parameter=NULL;

		//检测参数长度 如未插入参数 则默认参数为NULL
		if(count($this->parameter)==0) {
			$parameter=NULL;
		}else {
			foreach ($this->parameter as $key => $value) {
				$parameter.=$key.'/'.$value.'/';
			}
		}

		//如总页数小于每页显示的分页链接数 则设分页链接数为总页数
		if($this->pageAll<$this->perPageLink) {
			$this->perPageLink=$this->pageAll;
		}

		//每页第一个分页链接页码
		$this->pageStart=ceil($this->pageCurrent/$this->perPageLink)*$this->perPageLink-($this->perPageLink-1);

		//最后一页发分页链接数不足每页显示的分页链接数
		if($this->pageCurrent>$this->pageAll-$this->pageAll%$this->perPageLink) {
			$this->perPageLink=$this->pageAll%$this->perPageLink;
		}

		$this->pageList='<div><a class="num" href="'.__ROOT__."/".CONTROLLER."/".METHOD."/".$parameter.'p/'.$this->prev.'"><<</a>';

		for($i=0;$i<$this->perPageLink;$i++) {
			if($this->pageCurrent==$this->pageStart+$i) {
				$this->pageList.='<span class="current">'.($this->pageStart+$i).'</span>';
			}else {
				$this->pageList.='<a class="num" href="'.__ROOT__."/".CONTROLLER."/".METHOD."/".$parameter.'p/'.($this->pageStart+$i).'">'.($this->pageStart+$i).'</a>';
			}
		}

		$this->pageList.='<a class="num" href="'.__ROOT__."/".CONTROLLER."/".METHOD."/".$parameter.'p/'.$this->next.'">>></a></div>';
	
	}



	//输出分页链接集合
	public function outPut() {

		$this->createPageList();
		return $this->pageList;

	}

}
