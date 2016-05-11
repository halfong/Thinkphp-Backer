<?php
namespace Backer\Controller;
use Think\Controller;


class ApiController extends Controller {
	
	public function toggleActive(){
		if(!I('get.id') || !I('get.m')){ $this->error('请指定数据ID！');}

		$M = D(I('get.m'));
		$proj =$M->find(I('get.id'));
		
		$active = $proj['active']==0 ? 1 : 0;

		if( !$M->where('id='.$proj['id'])->save(array('active'=>$active)) ){
			exit($M->getError());
		}

		redirect(getenv("HTTP_REFERER"));
		exit;
	}


}