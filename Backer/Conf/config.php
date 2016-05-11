<?php
return array(
	'URL_HTML_SUFFIX'=>null,	//仅仅是偏好
	'DEFAULT_C_LAYER'=>'Core',	//Backer/Core将接管访问请求，Hold不住的释放到Backer/Contrller（您自己的定义）
	'BACKER'=>array(
		'title'=>'Backer管理后台',
		'logo'=>null,	//例如: /Public/img/backer_logo.png
		'static_path'=>'/Jinrong/Backer/Static/',	//一般无需更改，用于模板获取静态资源(js/css)

		//左侧菜单
		'menu'=>array(
			'示例模型'=>array(
				'link'=>'/Backer/Xmodel',
				'sub_menu'=>array(
					'新建Xmodel'=>array('link'=>'/Backer/Xmodel/edit'),
				),
			),
			'无子菜单'=>array(
				'link'=>'/Backer/#',
			),
			'不可点击'=>array(
				'sub_menu'=>array(
					'新建项目'=>array('link'=>'/Backer/#'),
				),
			),
		),

		//帐号配置
		'accounts'=>array(
			'sunkey'=>array(
				'name'=>'sunkey',
				'password'=>'test',
				'permissions'=>array(
					'index'=>'/^.+$/',
					'edit'=>'/^.+$/',
				),
			),
		),

		//字典
		'dict'=>array(
			'id'=>'ID',
			'uid'=>'用户ID',
			'state'=>"状态",
			'state_1'=>'成功',
			'state_2'=>'失败',
			'Xmodel_state_1'=>'[示例模型]成功',
			'Xmodel_state_2'=>'[示例模型]失败',
		),
	),
);