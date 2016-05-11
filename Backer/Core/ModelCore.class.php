<?php
namespace Backer\Core;

class ModelCore extends BaseCore {

	//需要在继承类中定义
	protected $_model;	//定义Model的命名空间，如 Home/User
	protected $_index;	//列表视图的配置，见README
	protected $_edit;	//编辑视图的配置，见README

	protected $_assigns = array(
		'Backer'=>null,
		'Config'=>null,

		//Index
		'Index',
		'Records',
		'Pageindex',

		//Edit
		'Edit',
		'Record',

	);

	function __construct(){
		parent::__construct();
		if( !$this->_assigns['Backer'] ){ redirect('/Backer'); }
		if( !auth(true) ){ $this->error('缺乏权限'); }
	}

	/**
	* 数据列表视图
	**/
	protected function _before_index(){

	}
	public function index(){
		$this->_before_index();
		if(!$this->_index){ return false; }
		$pageRecords = $this->pageRecords( D($this->_model) );
		$this->_assigns['Records'] = $pageRecords['records'];
		$this->_assigns['Pageindex'] = $pageRecords['pageindex'];
		$this->_assigns['Index'] = $this->_index;
		$this->play('./index');
	}

	/**
	* 编辑数据视图
	* if @param GET[id] 将读取已有数据做更新操作
	* if @param GET[save] 执行数据更新操作，非View
	**/
	protected function _before_edit(){

	}
	public function edit(){
		$this->_before_edit();
		if( I('get.save') ){ return $this->_save_edit(); }
		$Record = I('get.');
		if( isset($Record['id']) ){	//确认数据
        	$M = D($this->_model);
        	$Record = $M->find($Record['id']);
        	if(!$Record){ $this->error('找不到此记录'); }
        }
		$this->_assigns['Record'] = $Record;
		$this->_assigns['Edit'] = $this->_edit;
		$this->play('./edit');
	}


	/**
	执行方法
	**/

	private function _save_edit(){
		
		if( !empty($_FILES) ){
			$file_paths = $this->upload();
			$_POST = array_merge($_POST,$file_paths);
		}

		$M = D($this->_model);
		if(!$M->create()){ $this->error($M->getError()); }
		$result = I('post.id') ? $M->save() : $M->add();
		if(!$result){ $this->error($M->getError()); }
		$this->success('保存成功！','/Backer/'.CONTROLLER_NAME);
		exit;
	}

	//处理文件上传
	public function upload(){
	    $Upload = new \Think\Upload();// 实例化上传类
	    $Upload->maxSize = 3145728 ;// 设置附件上传大小
	    $Upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $Upload->rootPath = APP_PATH.'Backer/Static/upload/'; // 设置附件上传根目录

	    // 上传文件 
	    $files = $Upload->upload();
	    if(!$files) {//上传错误
			echo $Upload->getError();
			return false;
	    }

	    $re = array();
    	foreach ($files as $key => &$file) {
    		$re[$key] = 'http://'.$_SERVER['HTTP_HOST'].'/Backer/Static/upload/'.$file['savepath'].$file['savename'];
    	}

		//CKEditor特殊处理
		if(I('get.CKEditor')){
			$this->success($re);
			echo '<script type="text/javascript">
			window.parent.CKEDITOR.tools.callFunction('.I('get.CKEditorFuncNum').', "'.$re['upload'].'","");
			</script>';
			exit;
		}
    	return $re;
	}

	//分页获取数据
	private function pageRecords($M,$where=null,$order=null,$num=10){
		$where = $where ? $where :  I('get.');
		if(isset($where['order']))unset($where['order']);	//order为'排序'保留关键字
		$order = $order ? $order : ( I('get.order') ? I('get.order') : '-id' ) ;

		$count = $M->where($where)->count();
		$Page = new \Think\Page($count,$num);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$pageindex	= $Page->show();

		$records = $M
			->where($where)
			->order($order)
			->limit($Page->firstRow.','.$Page->listRows)
			->select();
			//->getField('mobile,email,cash,vcash');
		return array('records'=>$records,'pageindex'=>$pageindex);
	}

}