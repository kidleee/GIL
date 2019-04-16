<?php
namespace app\index\controller;

use think\Db;
use think\Request;



class Index
{
    public function index()
    {
        return 'Hello world!';/*'<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    */}
	
	public function hello($name = 'World', $city = 'shanghai')
    {
        return 'Hello,' . $name . '! You come from ' . $city . '.';
    }
	
	public function a()
	{
		Db::connect('mysql://root:123456@127.0.0.1:3306/my_db#utf8');
		$result = Db::table('name')
			->where('id', 1)
			->find();
		dump($result);
		Db::table('name')
			->insert(['A'=>0,'B'=>0,'C'=>0,'D'=>0,'id' => 18, 'name' => 'thinkphp', 'status' => 1]);
		
		echo "Hello world!<br>";
	    return ;          
	}
	public function b(Request $request, $name = 'World')
	{
		echo 'url: ' . $request->url() . '<br/>';
        return 'Hello,' . $name . '！';
	}
	public function c()
	{
		$arr  = array(
            'up'=>array(
				0=>array('locationx'=>0,'locationy'=>360),
				1=>array('locationx'=>20,'locationy'=>365),
				2=>array('locationx'=>40,'locationy'=>370),
				3=>array('locationx'=>60,'locationy'=>375),
				4=>array('locationx'=>80,'locationy'=>380),
				5=>array('locationx'=>100,'locationy'=>385),
				6=>array('locationx'=>120,'locationy'=>390),
				7=>array('locationx'=>140,'locationy'=>395),
				8=>array('locationx'=>160,'locationy'=>400),
				9=>array('locationx'=>180,'locationy'=>405),
				10=>array('locationx'=>200,'locationy'=>115),
				11=>array('locationx'=>220,'locationy'=>115),
				12=>array('locationx'=>240,'locationy'=>115),
				13=>array('locationx'=>260,'locationy'=>115),
				14=>array('locationx'=>280,'locationy'=>115),
				15=>array('locationx'=>300,'locationy'=>115),
				16=>array('locationx'=>320,'locationy'=>115),
				17=>array('locationx'=>340,'locationy'=>115),
				18=>array('locationx'=>360,'locationy'=>115),
				19=>array('locationx'=>380,'locationy'=>115),
				20=>array('locationx'=>400,'locationy'=>110),
				21=>array('locationx'=>420,'locationy'=>105),
				22=>array('locationx'=>440,'locationy'=>100),
				23=>array('locationx'=>460,'locationy'=>95),
				24=>array('locationx'=>480,'locationy'=>90),
				25=>array('locationx'=>500,'locationy'=>85),
				26=>array('locationx'=>520,'locationy'=>80),
				27=>array('locationx'=>540,'locationy'=>75),
				28=>array('locationx'=>560,'locationy'=>70),
			),
			'down'=>array(
				0=>array('locationx'=>0,'locationy'=>105),
				1=>array('locationx'=>20,'locationy'=>110),
				2=>array('locationx'=>40,'locationy'=>115),
				3=>array('locationx'=>60,'locationy'=>120),
				4=>array('locationx'=>80,'locationy'=>125),
				5=>array('locationx'=>100,'locationy'=>130),
				6=>array('locationx'=>120,'locationy'=>135),
				7=>array('locationx'=>140,'locationy'=>140),
				8=>array('locationx'=>160,'locationy'=>145),
				9=>array('locationx'=>180,'locationy'=>150),
				10=>array('locationx'=>200,'locationy'=>150),
				11=>array('locationx'=>220,'locationy'=>150),
				12=>array('locationx'=>240,'locationy'=>150),
				13=>array('locationx'=>260,'locationy'=>150),
				14=>array('locationx'=>280,'locationy'=>150),
				15=>array('locationx'=>300,'locationy'=>150),
				16=>array('locationx'=>320,'locationy'=>150),
				17=>array('locationx'=>340,'locationy'=>150),
				18=>array('locationx'=>360,'locationy'=>150),
				19=>array('locationx'=>380,'locationy'=>150),
				20=>array('locationx'=>400,'locationy'=>145),
				21=>array('locationx'=>420,'locationy'=>140),
				22=>array('locationx'=>440,'locationy'=>135),
				23=>array('locationx'=>460,'locationy'=>130),
				24=>array('locationx'=>480,'locationy'=>125),
				25=>array('locationx'=>500,'locationy'=>120),
				26=>array('locationx'=>520,'locationy'=>115),
				27=>array('locationx'=>540,'locationy'=>110),
				28=>array('locationx'=>560,'locationy'=>105),
			),
        );
        echo json_encode($arr); //必须echo
	}
	public function d()
	{
		$arr  = array(
            'up'=>array(
				0=>array('locationx'=>0,'locationy'=>705),
				1=>array('locationx'=>30,'locationy'=>735),
				2=>array('locationx'=>135,'locationy'=>810),
				3=>array('locationx'=>190,'locationy'=>845),
				4=>array('locationx'=>248,'locationy'=>860),
				5=>array('locationx'=>300,'locationy'=>875),
				6=>array('locationx'=>350,'locationy'=>890),
				7=>array('locationx'=>405,'locationy'=>910),
				8=>array('locationx'=>460,'locationy'=>925),
				9=>array('locationx'=>515,'locationy'=>940),
				10=>array('locationx'=>570,'locationy'=>955),
				11=>array('locationx'=>625,'locationy'=>985),
				12=>array('locationx'=>680,'locationy'=>1019),
				13=>array('locationx'=>725,'locationy'=>1055),
				14=>array('locationx'=>785,'locationy'=>1095),
				15=>array('locationx'=>840,'locationy'=>1100),
				16=>array('locationx'=>895,'locationy'=>1095),
				17=>array('locationx'=>945,'locationy'=>1090),
				18=>array('locationx'=>1000,'locationy'=>1085),
				19=>array('locationx'=>1055,'locationy'=>1080),
				20=>array('locationx'=>1105,'locationy'=>1075),
				21=>array('locationx'=>1160,'locationy'=>1050),
				22=>array('locationx'=>1210,'locationy'=>1030),
				23=>array('locationx'=>1270,'locationy'=>1005),
				24=>array('locationx'=>1320,'locationy'=>985),
				25=>array('locationx'=>1375,'locationy'=>975),
				26=>array('locationx'=>1425,'locationy'=>961),
				27=>array('locationx'=>1480,'locationy'=>959),
				28=>array('locationx'=>2400,'locationy'=>900),
				29=>array('locationx'=>2450,'locationy'=>890),
				30=>array('locationx'=>2505,'locationy'=>860),
				31=>array('locationx'=>2565,'locationy'=>825),
				32=>array('locationx'=>2610,'locationy'=>785),
				33=>array('locationx'=>2670,'locationy'=>750),
			),
			'down'=>array(
				0=>array('locationx'=>0,'locationy'=>895),
				1=>array('locationx'=>30,'locationy'=>925),
				2=>array('locationx'=>135,'locationy'=>1000),
				3=>array('locationx'=>190,'locationy'=>1035),
				4=>array('locationx'=>248,'locationy'=>1053),
				5=>array('locationx'=>300,'locationy'=>1065),
				6=>array('locationx'=>350,'locationy'=>1080),
				7=>array('locationx'=>405,'locationy'=>1100),
				8=>array('locationx'=>460,'locationy'=>1115),
				9=>array('locationx'=>515,'locationy'=>1130),
				10=>array('locationx'=>570,'locationy'=>1145),
				11=>array('locationx'=>625,'locationy'=>1175),
				12=>array('locationx'=>680,'locationy'=>1200),
				13=>array('locationx'=>725,'locationy'=>1245),
				14=>array('locationx'=>785,'locationy'=>1285),
				15=>array('locationx'=>840,'locationy'=>1290),
				16=>array('locationx'=>895,'locationy'=>1285),
				17=>array('locationx'=>945,'locationy'=>1280),
				18=>array('locationx'=>1000,'locationy'=>1275),
				19=>array('locationx'=>1055,'locationy'=>1270),
				20=>array('locationx'=>1105,'locationy'=>1265),
				21=>array('locationx'=>1160,'locationy'=>1240),
				22=>array('locationx'=>1210,'locationy'=>1220),
				23=>array('locationx'=>1270,'locationy'=>1195),
				24=>array('locationx'=>1320,'locationy'=>1175),
				25=>array('locationx'=>1375,'locationy'=>1155),
				26=>array('locationx'=>1425,'locationy'=>1151),
				27=>array('locationx'=>1480,'locationy'=>1149),
				28=>array('locationx'=>2400,'locationy'=>1090),
				29=>array('locationx'=>2450,'locationy'=>1080),
				30=>array('locationx'=>2505,'locationy'=>1050),
				31=>array('locationx'=>2560,'locationy'=>1020),
				32=>array('locationx'=>2610,'locationy'=>980),
				33=>array('locationx'=>2670,'locationy'=>935),
			),
        );
        echo json_encode($arr); //必须echo
	}
	public function e()
	{
		$arr  = array(
            'up'=>array(
				0=>array('locationx'=>0,'locationy'=>900),
				1=>array('locationx'=>675,'locationy'=>900),
				2=>array('locationx'=>1320,'locationy'=>900),
				3=>array('locationx'=>1970,'locationy'=>900),
				4=>array('locationx'=>2670,'locationy'=>900),
			),
			'down'=>array(
				0=>array('locationx'=>0,'locationy'=>1135),
				1=>array('locationx'=>675,'locationy'=>1135),
				2=>array('locationx'=>1320,'locationy'=>1135),
				3=>array('locationx'=>1970,'locationy'=>1135),
				4=>array('locationx'=>2670,'locationy'=>1135),
			),
        );
        echo json_encode($arr); //必须echo
	}
}
