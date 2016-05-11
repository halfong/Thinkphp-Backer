<?php
namespace Backer\Core;

class AuthCore extends BaseCore {

	protected $_assigns = array(
		'Backer'=>null,
		'Config'=>null,
	);


	/**
	模板视图
	**/

	public function index(){
		$this->play('./auth');
	}

	/**
	执行方法
	**/

	public function login(){
		$name=I('post.name');
		$password=I('post.password');

		if( !$name || !$password ){ $this->error('请Post输入用户名及密码！');return false; }

		foreach ( C('BACKER.accounts') as $backer) {
			if( $name==$backer['name'] && $password==$backer['password'] ){
				session('backer',$backer);
				redirect(U('/Backer/Index'));
				return true;
			}
		}
		$this->error('用户名或密码错误！');
		return false;
	}

	public function logout(){
		session('backer',null);
		redirect(U('/Backer/Auth'));
	}

}