<?php
return array(
	'BACKER'=>array(
		'title'=>'管理后台',	//后台名称
		'logo'=>'/Public/img/logo.png',	//logo地址,确保资源能访问到
		'static_path'=>'/Jinrong/Backer/View/static/',	//根据您的proxy设置，确保静态资源能访问到
		'reveal'=>'auth_*',	//无需权限验证的 Cotroller_[Action|Model]
		'menu'=>array(
		    '用户管理'=>array(
		        'link'=>'/Backer/List/User/',
		        'sub_menu'=>array(
		            '新建用户'=>array('link'=>'/Backer/Edit/User/'),
		        ),
		    ),
		    //...
		)
	),
	//数据交互、功能配置（目前支持List和Edit）
	'BACKER_MODELS'=>array(
		'project'=>array(
		  	//将通过Home模块的Project Model来进行数据操作
		    'refer'=>'Home/Project',
		    
		  	//数据展示、查询功能配置
		    'list'=>array(
		        'table'=>array(			//数据显示
		            'id'=>null,
		            'name'=>null,
		            'cate'=>"dict,###,cate",	//执行函数,格式为'fn[,arguments]'，###代替字段值
		            'rate'=>null,
		            'amount'=>null,
		            'sold'=>null,
		            'start_time'=>"date,Y-m-d,###",
		            'end_time'=>"date,Y-m-d,###",
		            'active'=>"dict,###,active",
		            'state'=>"dict,###,state",
		        ),
		        'filter'=>array(		//筛选
		          	'mobile'=>array('type'=>'input'),	//输入控件
		            'state'=>array('type'=>'tab','case'=>array(1,2,3)),	//切换控件
		          	'type'=>array('type'=>'hidden','case'=>array(1,2,3,4,5,6,7)), //隐藏参数
		        ),
		        'acts'=>array(   //针对每条Record的自定义操作
		          	//值只能是执行函数表达式，结果应为URL链接(###为Record数据)
		            '自定义操作'=>'U,/Backer/YourController/CustomAction,###',
		        ),
		    ),
		  
		  	//数据修改功能配置
		    'edit'=>array(
		        'form'=>array(
		            'id'=>array('type'=>'hidden'),	//隐藏项
		            'name'=>array('type'=>'input'), //input输入项
		            'cate'=>array('type'=>'radio','case'=>array(1,2,3)),  //单项选择
		            'start_time'=>array('type'=>'date'),  //日期选择
		            'detail'=>array('type'=>'richtext'),   //富文本(含图片上传)
		            'pic'=>array('type'=>'file'),   //文件
		        ),
		    )
		),
		//继续定义其它Model ..
	),
	//后台帐号
	'BACKER_ACCOUNTS'=>array(
		'sunkey'=>array(
		    'name'=>'sunkey',
		    'password'=>'test',
		    'permissions'=>'index_*,list_order,edit_*,act_*',	//权限项格式为： (Controller)_(action|*)
		),
	),
	//翻译字典
	'BACKER_DICT'=>array(
		'name'=>'名称',	//'name' | dict
		'project'=>'项目',	// 'project' | dict
		'project_name'=>'项目名称', // 'name' | dict=###,'project'
		'project_state_1'=>'正常', // 1 | dict=###,'project_state'
	),
);