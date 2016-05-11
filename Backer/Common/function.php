<?php

/**
* 验证用户
* @param (boolean)$auth_act 同时验证是否拥有当前操作的权限
* @return (array)backer || false
**/
function auth($auth_act=false){
	//return true;
	$c= strtolower(CONTROLLER_NAME);
	$a = strtolower(ACTION_NAME);
	if( !$backer = session('backer') ){ return false; }
	if( !$auth_act ){ return $backer;}

	return !isset($backer['permissions'][$a]) ? false : 
		!preg_match($backer['permissions'][$a],$c) ? false :
		$backer;
}

/**
* 翻译字段名
**/
function dict($k,$prefix=null){
	$c = strtolower(CONTROLLER_NAME);
	$k = strtolower($k);
	if( $prefix ) $k = strtolower($prefix).'_'.$k;

	return isset(C('BACKER.dict')[$c.'_'.$k]) ? C('BACKER.dict')[$c.'_'.$k] :
		( isset(C('BACKER.dict')[$k]) ? C('BACKER.dict')[$k] : $k );
}


/**
* 模版中执行变量名的方法（因为TP模板语法不支持以变量为）
* @usage
* 用于支持ModelController _index['table']配置 'ctime'=>"date,Y-m-d H:i:s,###",
* {$record[$cname] | filter=$fn,###}
**/
function filter($exp,$val){

	if(!$exp){ return $val; }

	$args = explode(',', $exp);
	foreach ($args as &$arg) {
		if($arg=='###'){ $arg = $val; }
	}
	$fn = array_shift($args);
	return call_user_func_array($fn,$args);

}


function magic_string($string){
	//图片
	if( preg_match('/^.*\.(jpg|png|gif|jpeg)$/i', $string) ){
		return '<img src="'.$string.'" />';
	}
	return $string;
}
function magic_title(){
	$title = dict(CONTROLLER_NAME);
	if( !empty(I('get.')) ){
		foreach (I('get.') as $prefix => $k) {
			$p = dict($k,$prefix);
			if($p!=$k && $p!=$prefix.'_'.$k){ $title.='<span>'.$p.'</span>'; }
		}
	}
	return $title;
}
/**
* 为Index每个Record的操作url追加参数
**/
function magic_url($url,$record){
	return U($url,array_merge(array(
		'm'=>CONTROLLER_NAME,
		'id'=>$record['id'],
	),I('get.')));
}



