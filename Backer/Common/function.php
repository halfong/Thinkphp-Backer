<?php

//验证用户
//是否有当前Contrller/Action的权限
function auth(){
	$c= strtolower(CONTROLLER_NAME);
	$a = strtolower(ACTION_NAME);

	if( stristr(C('BACKER.reveal'),$c.'_*') || stristr(C('BACKER.reveal'),$c.'_'.$a) ){ return true; }

	$backer = session('backer');
	if( !$backer ){ return fasle; }
	$p = strtolower(C('BACKER_ACCOUNTS')[$backer['name']]['permissions']);

	return stristr($p,$c.'_*') || stristr($p,$c.'_'.$a);
}

//字段名翻译
function dict($k,$prefix=null){
	$a = strtolower(ACTION_NAME);
	$k = strtolower($k);
	if( $prefix ) $k = strtolower($prefix).'_'.$k;

	$text1 = C('BACKER_DICT')[$a.'_'.$k];
	$text2 = C('BACKER_DICT')[$k];
	$text3 = $k;
	
	return $text1 ? $text1 : ($text2 ? $text2 : $text3);
}


//执行配置中的数据显示过滤方法
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

//根据URL和DICT自动生成标题
function magic_title(){
	$title = '<span>'.dict(ACTION_NAME).'</span>';
	if( !empty(I('get.')) ){
		foreach (I('get.') as $prefix => $k) {
			$p = dict($k,$prefix);
			if($p!=$k && $p!=$prefix.'_'.$k){ $title.='<span>'.$p.'</span>'; }
		}
	}
	return $title;
}

//
function transform_params_url($raw,$rule,$url){
	$params = array();
	//如果带有proxy，将按其它k/v填充并销毁proxy
	$pairs= explode('&', $rule);
	foreach ($pairs as $ok_nk) {
		$ok_nk = explode('>', $ok_nk);
		foreach ($raw as $k => $v) {
			if($ok_nk[0]==$k){ $params[$ok_nk[1]] = $v; }
		}
	}
	return U($url,$params);
}



