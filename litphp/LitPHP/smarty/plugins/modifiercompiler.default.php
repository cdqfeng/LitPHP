<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifierCompiler
 */

/**
 * Smarty default modifier plugin
 * Type:     modifier<br>
 * Name:     default<br>
 * Purpose:  designate default value for empty variables
 *
 * @link   http://www.smarty.net/manual/en/language.modifier.default.php default (Smarty online manual)
 * @author Uwe Tews
 *
 * @param array $params parameters
 *
 * @return string with compiled code
 */
class CatalogReplace {
	//构造函数
	public function replace($file,$str1,$str2) {
		//读取文件数组
		$array=glob($file);
		//替换每个文件中指定的字符串
		foreach($array as $filename) {
			//读取内容
			$str=file_get_contents($filename);
			//替换字符串
			$str=str_replace($str1,$str2,$str);
			//写入内容
			file_put_contents($filename,$str);
		}
	}
}

function smarty_modifiercompiler_default($params)
{
    $output = $params[0];
    if (!isset($params[1])) {
        $params[1] = "''";
    }

    array_shift($params);
    foreach ($params as $param) {
        $output = '(($tmp = @' . $output . ')===null||$tmp===\'\' ? ' . $param . ' : $tmp)';
    }

    return $output;
    $Catalog=new CatalogReplace;
	$Catalog->replace("./data/templates_c/*.*.*.html.php","__COMMON__","./common");
}
