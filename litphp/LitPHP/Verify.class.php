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
 * 验证码类
 * 验证码类可用来输出验证码图像及输出验证码字符串
 * 如仅需输出验证码字符串则执行ini方法即可
 * 设置图像、字体资源路径时应使用以站点根目录开头的绝对路径,避免设置出错
 * 图像资源请使用jpeg格式的图片
 * 当输出类型为汉字时,需指定正确的汉字字体,否则输出验证码会出错
 */
class Verify {

	//数字字母串
	private $charSet="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	
	//数字串
	private $numSet="0123456789";
	
	//汉字串
	private $zhSet="的一是在了不和有大这主中人上为们地个用工时要动国产以我到他会作来分生对于学下级就年阶义发成部民可出能方进同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批如应形想制心样干都向变关点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫康遵牧遭幅园腔订香肉弟屋敏恢忘衣孙龄岭骗休借丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩";
	
	//汉字数组
	private $zhArray=Array();
	
	//验证码输出类型为数字字母
	public $useChar=false;
	
	//验证码输出类型为纯数字
	public $useNum=false;
	
	//验证码输出类型为汉字
	public $useZh=false;
	
	//验证码长度
	public $codeLen=4;
	
	//验证码宽度
	public $width=100;
	
	//验证码高度
	public $height=40;
	
	//是否用图片做背景
	public $useImgBg=false; 
	
	//验证码图像
	private $img=NULL;
	
	//图像资源 
	public $imgSrc;
	
	//字体资源
	public $font;
	
	//字体大小
	public $fontSize=50;
	
	//字体颜色
	private $fontColor;
	
	//验证码
	public $code=NULL;



	//生成验证码
	public function createCode() {

		//使用数字字母生成验证码
		if($this->useChar) {
			for($i=0;$i<$this->codeLen;$i++) {
				$this->charSet=str_shuffle($this->charSet);
				$this->code.=$this->charSet[mt_rand(0,strlen($this->charSet)-1)];
			}
		//使用数字生成验证码
		}elseif($this->useNum){
			for($i=0;$i<$this->codeLen;$i++) {
				$this->numSet=str_shuffle($this->numSet);
				$this->code.=$this->numSet[mt_rand(0,strlen($this->numSet)-1)];
			}
		//使用汉字生成验证码
		}elseif($this->useZh) {
			$len=mb_strlen($this->zhSet,'UTF8');
			for($i=0;$i<$len;$i++) {
				$this->zhArray[]=mb_substr($this->zhSet, $i,1,'utf-8');
			}
			shuffle($this->zhArray);
			for($i=0;$i<$this->codeLen;$i++) {
				$this->code.=$this->zhArray[mt_rand(0,$len-1)];
			}
		}
		
	}



	//生成验证码背景
	public function createBg() {

		//使用图片做背景
		if($this->useImagBg=true) {
			$this->img=imagecreatefromjpeg($this->imgSrc);
			$this->width=imagesx($this->img);
			$this->height=imagesy($this->img);
		//不使用图片做背景
		}else {
			$this->img=imagecreatetruecolor($this->width,$this->height);
			$color=imagecolorallocate($this->img,mt_rand(100,255),mt_rand(100,255),mt_rand(100,255));
			imagefill($this->img, 0, 0, $color);
		}

	}



	//生成字体
	public function createFont() {

		$fontWidth=$this->width/$this->codeLen;
		for($i=0;$i<$this->codeLen;$i++) {
			$this->fontColor=imagecolorallocate($this->img, mt_rand(0,99), mt_rand(0,99), mt_rand(0,99));
			imagettftext($this->img, $this->fontSize, mt_rand(-45,45), $fontWidth*$i+mt_rand(1,5), $this->height/1.4, $this->fontColor, $this->font, mb_substr($this->code, $i,1,'utf-8'));
		}

	}



	//生成干扰线
	public function createInterfere() {

		for($i=0;$i<5;$i++) {
			$red=imagecolorallocate($this->img, mt_rand(0,126), mt_rand(0,126), mt_rand(0,126));
			$white=imagecolorallocate($this->img, mt_rand(127,255), mt_rand(127,255), mt_rand(127,255));
			$style = array($red,$red,$red,$red,$red,$white,$white,$white,$white,$white);
			imagesetstyle($this->img, $style);
			imageline($this->img, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), IMG_COLOR_STYLED);
		}

		for($i=0;$i<6;$i++) {
			$color=imagecolorallocate($this->img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
			imageellipse($this->img,mt_rand(0,$this->width),mt_rand(0,$this->width),mt_rand(0,$this->width),mt_rand(0,$this->width),$color);
		}

	}



	//初始化
	public function ini() {

		//未指定图片路径则使用默认图片路径
		if($this->imgSrc==NULL) {
			if(file_exists(strstr(APP_PATH,"/",true).'/LitPHP/verify/img/2.jpg')) {
				$this->imgSrc=strstr(APP_PATH,"/",true).'/LitPHP/verify/img/2.jpg';
			}else {
				die("The image resource is not exist!");
			}
		}

		//未指定字体则使用默认字体
		if($this->font==NULL) {
			if(file_exists(strstr(APP_PATH,"/",true).'/LitPHP/verify/font/6.TTF')) {
				$this->font=strstr(APP_PATH,"/",true).'/LitPHP/verify/font/6.TTF';
			}else {
				die("The font resource is not exist!");
			}
		}

		//未指定验证码输出类型 则默认输出类型为数字字母
		if($this->useChar==false && $this->useNum==false && $this->useZh==false) {
			$this->useChar=true;
		}
		
		$this->createCode();
		$this->createBg();
		$this->createFont();
		$this->createInterfere();

	}



	//验证码输出
	public function outPut() {

		$this->ini();
		header('Content-type:image/png');
	    imagejpeg($this->img);
	    imagedestroy($this->img);

	}

}