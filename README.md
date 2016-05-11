## Thinkphp-Backer v0.9.0

一个轻量级的Thinkphp管理后台模块``Module``（实际上核心代码不到300行），利用APP已有的Model实现数据浏览、查询及修改操作，省去大量写Admin后台界面&逻辑的时间。

- 适合：后台数据操作简单，需要快速实现可视化数据后台（对应数据库）的初期项目


- 不适合：数据结构、业务操作复杂的项目


##### 当前实现的功能

- Auth：帐号及权限控制系统（基于配置文件的简单实现）


- Index：可配置的数据展示及查询
- Edit：可配置的数据创建、更新




![thinkphp-Backer截图](http://sunkey.me/content/images/2016/04/QQ20160408-0-01.png)





### 开始使用

- 将``Backer``模块放到您的APP目录下（通常是``/Applications/``，与``Home``模块同级）
- 修改``Backer/Conf/config.php``中的配置[查看文件](Backer/Conf/config.php)
- 根据需要展示/处理的数据，对应的在``Backer/Controller/``下继承``Core/ModelCOre``添加控制器,查看[示例文件](Backer/Controller/Xmodel.php)
- 访问``yourdomain.com/Backer``开始使用吧（访问地址根据您的proxy配置可能会有不同）



### 目录结构

Backer遵循Thinkphp标准模块目录，唯一的区别是将**访问控制器目录配置为``/Core``**。这意味着对Backer的所有访问将先通过Core文件处理，无法处理的访问再分发到``/Controller``，也就是您自定义的控制器。

```css
Backer/
  Common/
      functions.php			/*Backer用到的函数*/
  Conf/
      config.php			/*Backer配置文件*/
  Core/
      AuthCore.class.php    	/*帐号与登录*/
      BaseCore.class.php    	/*继承Think\Controller的基础类，被所有其它Core继承*/
      EmptyCore.class.php    	/*分发无法处理的请求到Controller*/
      IndexCore.class.php    	/*首页内容，强烈建议自定义一下*/
      ModelCore.class.php    	/*核心类，数据功能、视图实现*/
  View/						/*模板文件夹*/
	  ...
  Static/					/*静态资源目录*/
      uploads   	 	  	/*默认的上传文件存储目录，注意将目录文件设置为777*/
      ...
  Controller/   			/*用户自定义控制器*/
	  空					  /*继承Backer/Core/ModelCore来添加控制器*/
```
