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

use \PDO;

//防止通过地址栏直接访问
defined("APP_PATH") or die('You hava no permission to access');

/**
 * 基础模型类
 * 基础模型类使用PDO类的方法封装了常用的查询、增加、删除、更新、计数方法
 */
class Model {

	//数据表名称
	protected $tableName;

	//保存要返回的查询结果
	protected $array;

	//存放PDO对象
	protected $pdo;



	/**
	 * 构造函数
	 * 可以利用构造函数中的参数连接新的数据库
	 * @param string $tableName 数据表名称
	 * @param string $dbType 数据库类型
	 * @param string $hostName 主机名称
	 * @param string $dbName 数据库名称
	 * @param string $dbUser 连接数据库的用户名
	 * @param string $dbPassword  连接数据库的密码
	 */
	public function __construct($tableName=NULL,$dbType=NULL,$hostName=NULL,$dbName=NULL,$dbUser=NULL,$dbPassword=NULL) {
		
		//无参数时连接配置文件中指定的数据库
		if($dbType!=NULL || $hostName!=NULL || $dbName!=NULL || $dbUser!=NULL || $dbPassword!=NULL) {
			$dsn="$dbType:host=$hostName;dbname=$dbName";
			$dbUser=$dbUser;
			$dbPassword=$dbPassword;
		}else {
			$dsn=DBTYPE.":host=".HOSTNAME.";dbname=".DBNAME;
			$dbUser=DBUSER;
			$dbPassword=DBPASSWORD;
		}

		$this->tableName=$tableName;

		//实例化PDO类
		$this->pdo=new PDO($dsn,$dbUser,$dbPassword);

		//设置编码格式
		$this->pdo->query("set names utf8");
		
	}



	/**
	 * sql语句过滤
	 * sql语句过滤可以防止SQL注入攻击
	 * @param string $sql语句
	 */
	public function filter($sql) {

		//去除字符串首尾处的空白字符
		$sql=trim($sql);

		//反引用一个引用字符串
		$sql=stripslashes($sql);

		//把预定义的字符转换为HTML实体
		$sql=htmlspecialchars($sql);

		return $sql;

	}



	/**
	 * 原始查询
	 * 该方法利用SQL语句实现对数据库的操作
	 * @param string $sql SQL语句
	 */
	public function query($sql) {

		$sql=$this->filter($sql);
		$obj=$this->pdo->prepare($sql);
		$obj->execute();
		$this->array=$obj->fetchAll(PDO::FETCH_ASSOC);
		return $this->array;

	}



	/**
	 * 查询
	 * 该方法用于从数据表选取数据
	 * @param string $field 字段 多个字段值可以用','隔开 如 "field1,field2,field3"
	 * @param string $cond 查询条件 如 "where id='xx' and name='xx'" 
	 */
	public function select($field,$cond=NULL) {

		$sql=$this->filter("SELECT $field FROM $this->tableName $cond");
		$obj=$this->pdo->prepare($sql);
		$obj->execute();
		$this->array=$obj->fetchAll(PDO::FETCH_ASSOC);
		return $this->array;
	}



	/**
	 * 增加
	 * 该方法用于向数据表插入新的行
	 * @param string $field 字段 多个字段值可以用','隔开 如 "field1,field2,field3"
	 * @param string $cond 要增加的值 如 "NULL,'xx','xx'" 每个值都应与$field内的值一一对应 
	 */
	public function add($field,$values) {

		$sql=$this->filter("INSERT INTO $this->tableName ($field) values($values)");
		$obj=$this->pdo->prepare($sql);
		$obj->execute();

	}



	/**
	 * 删除
	 * 该方法用于删除数据表中的一行 要删除整个数据表建议用本类的query方法 或者用自定义方法
	 * @param string $field 字段
	 * @param string $value 要删除的值
	 */
	public function delete($field,$value) {

		$sql=$this->filter("DELETE FROM $this->tableName WHERE $field='$value'");
		$obj=$this->pdo->prepare($sql);
		$obj->execute();

	}



	/**
	 * 更新
	 * 该方法用于修改数据表中的数据
	 * @param string $set 要更新的字段和值 如 "field='xx'" 更新多个字段应用','隔开 如 "field1='xx',field='xx'"
	 * @param string $cond 查询条件 如 "where id='xx' and name='xx'" 
	 */
	public function update($set,$cond=NULL) {

		$sql=$this->filter("UPDATE $this->tableName SET $set $cond");
		$obj=$this->pdo->prepare($sql);
		$obj->execute();

	}



	/**
	 * 计数
	 * 该方法用于返回指定列的值的数目
	 * @param string $field 字段 默认为'*'
	 * @param string $cond 查询条件 如 "where id='xx' and name='xx'" 
	 */
	public function count($field="*",$cond=NULL) {

		$sql=$this->filter("SELECT count($field) AS count FROM $this->tableName $cond");
		$obj=$this->pdo->prepare($sql);
		$obj->execute();
		$this->array=$obj->fetch(PDO::FETCH_ASSOC)['count'];
		return $this->array;

	}


	//这里可以添加自定义的方法

}