<?php
return array(
	'URL_HTML_SUFFIX'=>null,
	'DEFAULT_C_LAYER'=>'Core',
	
	'BACKER'=>array(

		'title'=>'管理后台',	//后台名称
		'logo'=>'/Public/img/logo.png',	//logo地址,确保资源能访问到
		'static_path'=>'/Jinrong/Backer/Static/',	//URI，根据您的proxy设置，确保静态资源(包含上传的文件)能访问到

		//左侧菜单
		'menu'=>array(
			'订单查询'=>array(
				'link'=>'/Backer/Order',
			),
			'用户管理'=>array(
				'link'=>'/Backer/User',
			),
			'投资项目'=>array(
				'link'=>'/Backer/Project',
				'sub_menu'=>array(
					'新建项目'=>array('link'=>'/Backer/Project/edit'),
				),
			),
			'新闻管理'=>array(
				'link'=>'/Backer/Content/Index/type/1',
				'sub_menu'=>array(
					'新建新闻'=>array('link'=>'/Backer/Content/edit/type/1'),
				),
			),
			'公告管理'=>array(
				'link'=>'/Backer/Content/Index/type/2',
				'sub_menu'=>array(
					'新建公告'=>array('link'=>'/Backer/Content/edit/type/2'),
				),
			),
			'网站内容'=>array(
				'sub_menu'=>array(
					'FAQ'=>array('link'=>'/Backer/Content/Index/type/3'),
					'操作流程'=>array('link'=>'/Backer/Content/Index/type/4'),
					'关于我们'=>array('link'=>'/Backer/Content/Index/type/5'),
					'联系我们'=>array('link'=>'/Backer/Content/Index/type/6'),
					'首页banner'=>array('link'=>'/Backer/Content/Index/type/7'),
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
			'order'=>'订单',
			'user'=>'用户',
			'product'=>'产品',
			'uid'=>'用户ID',
			'ctime'=>'创建时间',
			'etime'=>'修改时间',
			'id'=>'ID',
			'p_name'=>'项目名称',
			'u_mobile'=>'用户手机号',
			'mobile'=>'手机号',
			'email'=>'邮箱',
			'amount'=>'订单总额',
			'earnings'=>'预期收益',
			'rate'=>'年化收益率(%)',
			'p_rate'=>'年化收益率',
			'state'=>'状态',
			'acash'=>'现金余额',
			'vcash'=>'虚拟余额',
			'start_time'=>'起息日期',
			'end_time'=>'结息日期',
			'title'=>'标题',
			'content'=>'内容',
			'type'=>'类型',
			'cate'=>'类别',
			'password'=>'密码',

			'active'=>'是否上线',
			'active_0'=>'未上线',
			'active_1'=>'已上线',

			'project'=>'项目',
			'project_name'=>'项目名称',
			'project_sold'=>'已售',
			'project_price'=>'单份价格',
			'project_order_amount_limit'=>'单笔限额',
			'project_detail'=>'项目详情',

			'project_state_1'=>'正在招标',
			'project_state_2'=>'投资中',
			'project_state_3'=>'已过期',
			'project_cate_1'=>'新手',
			'project_cate_2'=>'电票',
			'project_cate_3'=>'纸票',

			'content'=>'内容',
			'content_type_1'=>'新闻',
	        'content_type_2'=>'公告',
	        'content_type_3'=>'FAQ',
	        'content_type_4'=>'操作流程',
	        'content_type_5'=>'关于我们',
	        'content_type_6'=>'联系我们',
	        'content_type_7'=>'首页Banner',

	        'order_p_end_time'=>'结息时间',
	        'order_state_1'=>'未支付',
	        'order_state_2'=>'支付成功',
	        'order_state_3'=>'已结息',
	        'order_state_9'=>'已失效',

			'cash_change'=>'动帐',
			'cash_info'=>'说明',
			'cash_state_0'=>"处理中",
			'cash_state_1'=>"成功",
			'cash_state_2'=>"失败",
			'cash_state_3'=>"已取消",
		),

	),
);