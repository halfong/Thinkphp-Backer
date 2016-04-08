<?php
namespace Backer\Core;

class edit extends base {

	function __construct(){
		parent::__construct();
		if( !I('get.save') ){	//展示
			if( I('get.id') ){
	        	$M = D($this->Assigns['C']['model']['refer']);
	        	$Record = $M->find(I('get.id'));
	        	if(!$Record){ $this->error('找不到了!'); }
	        }else{
	        	$Record = I('get.');
	        }
			$this->Assigns['Record'] = $Record;
		}
	}


	public function _empty($method,$args){
		if( I('get.save') ){
			$this->bc_save();
		}else{
			$this->play('./edit');
		}
	}

	private function bc_save(){
		$M = D($this->Assigns['C']['model']['refer']);
		if(!$M->create()){ $this->error($M->getError()); }
		$result = I('post.id') ? $M->save() : $M->add();
		if(!$result){ $this->error($M->getError()); }
		$this->success('保存成功！','javascript:history.back(-2);');
		exit;
	}

	//处理文件上传
	public function upload(){
	    $upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     APP_PATH.'Backer/Static/upload/'; // 设置附件上传根目录
	    //exit($upload->rootPath);

	    // 上传文件 
	    $files   =   $upload->upload();
	    if(!$files) {// 上传错误提示错误信息
	    	if(IS_POST){ echo $upload->getError(); }
	    	return false;
	    }

    	foreach ($files as &$file) {
    		$file['absUrl'] = 'http://'.$_SERVER['HTTP_HOST'].'/Backer/Static/upload/'.$file['savepath'].$file['savename'];
    	}

    	if(IS_POST){
    		//CKEditor特殊处理
    		if(I('get.CKEditor')){
    			echo '<script type="text/javascript">
    			window.parent.CKEDITOR.tools.callFunction('.I('get.CKEditorFuncNum').', "'.$file['absUrl'].'","");
    			</script>';
    		}
    	}
    	return $files;
	}


}