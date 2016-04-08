<?php
namespace Backer\Core;

class auth extends base {

	public function index(){
		$this->play('./auth');
	}

	public function login(){
		$name=I('post.name');
		$password=I('post.password');

		if( !$name || !$password ){ $this->error('请Post输入用户名及密码！');return false; }

		foreach ( C('BACKER_ACCOUNTS') as $backer) {
			if( $name==$backer['name'] && $password==$backer['password'] ){
				session('backer',$backer);
				$this->success('登录成功',U('/Backer/Index'));
				return true;
			}
		}
		$this->error('用户名或密码错误！');
		return false;
	}

	public function logout(){
		session('backer',null);
		$this->success('已登出',U('/Backer/Auth'));
	}

}