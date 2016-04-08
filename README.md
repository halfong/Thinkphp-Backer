## Thinkphp-Backer

一个轻量级的Thinkphp管理后台模块，拖入+修改配置文件就可以开始运行。支持对应用数据模型进行CRU没有D相关操作，省去大量写Admin后台界面&逻辑的时间。思路及想法可以看[我的博客>](http://sunkey.me/backer-qing-liang-ji-thinkphpguan-li-hou-tai-mo-kuai/)

通过让您的访问控制器继承Backer/Core里定义好的类（而不是直接继承Think/Controller），可以直接获得Backer定义好的行为及模板视图。

- 适合：后台数据操作简单，需要快速实现可视化后台的初期项目


- 不适合：数据结构、业务操作复杂的项目


##### 注意

Thinkphp访问规则是``模块/控制器/方法``，通常模块中控制器对应对象，方法对应行为。而在Backer中恰好相反，控制器对应行为，方法对用对象（通常就是Model）。因此，在Backer中的访问路径是这样的：``/Backer/List/Order`` ``/Backer/List/User`` ``/Backer/Edit/User``。目前Backer已定义了view、edit两种Model行为，和auth及base两种框架行为。

##### 功能特性

- Auth：帐号及权限控制系统（基于配置文件的简单实现）


- List：可配置的数据展示及查询
- Edit：可配置的数据创建、创建
- 可方便拓展、修改（实际上核心逻辑只有**200行**左右，其余只是模板界面实现）




![thinkphp-Backer截图](http://sunkey.me/content/images/2016/04/QQ20160408-0-01.png)




### 模块结构

Backer为Module模块插件，它很轻。直接将Backer文件夹放入您的应用目录（Thinkphp默认为./Application）即可。Backer内文件如下：

```shell
Common/
	functions.php      	#Backer用到的函数
Conf/
	config.php			#Backer配置文件
Core/
	auth.class.php    	#帐号相关功能
	base.class.php    	#主界面基础类
	view.class.php    	#数据查询功能
	edit.class.php    	#数据编辑功能
View/               	#页面模板
	auth.html
	base.html
	index.html
	list.html
	edit.html
Static/					#静态资源可访问目录
	uploads   	 	  	#上传文件存储目录
	#...
Controller/   			#访问控制器
	AuthController.class.php	#继承实现core\auth
	IndexController.class.php	#继承core\index，请自行定义首页
	EditController.class.php	#继承实现core\edit
	ListController.class.php	#继承实现core\view
```



### 配置文件

通常情况下，您只需要修改配置文件即可让Backer正常运行起来。

打开``Backer/Conf/config.php``，你会看到Backer的配置分为4个部分 ：



##### 基础配置  BACKER

```php
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
```



##### 模型配置  BACKER_MODELS

```php
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
/*
* 继续定义其它Model
* ...
*/
```



##### 帐号/权限配置  BACKER_ACCOUNTS

```php
'sunkey'=>array(
    'name'=>'sunkey',
    'password'=>'test',
    'permissions'=>'index_*,list_order,edit_*,act_*',	//权限项格式为： (Controller)_(action|*)
),
```



##### 字典  BACKER_DICT

Backer界面将根据字典将字段key转化为对应的中文内容，默认使用内置的``dict``函数实现

```php
'name'=>'名称',	//'name' | dict
'project'=>'项目',	// 'project' | dict
'project_name'=>'项目名称', // 'name' | dict=###,'project'
'project_state_1'=>'正常', // 1 | dict=###,'project_state'
```



### 自定义行为

您可以按照Thinkphp正常的方式来拓展Controller（继承BaseController）、模板（继承base.html）。但您有时也可能需要针对List和Edit的默认行为做自定义，这很简单：



Backer的行为控制器(例如list和edit)在\_construct时准备好所有数据及配置，然后通过空操作``_empty()``来执行动作和渲染界面，因此您可以通过在控制器中定义确定的操作方法来避免_empty执行，例如：

```php
/*
** 当访问 /Backer/Edit/Order 时
** 在继承core\edit的控制器中定义Order方法，默认的_empty()将不会执行
*/
public function order(){
  /*
  ** 自定义操作
  ** 例如修改配置或数据，它们都在 $this->Assgins里
  ** 最后别忘了 $this->play('./list')
  ** play()是Backer对display的小封装
  */
}
```