# YiYouServer
###服务端接口说明

1. **登录接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/YiYouImg/Login.php

   参数：

   | 参数名称 | 参数类型 |         说明         |
   | :------: | :------: | :------------------: |
   |   tel    |  String  | 登陆手机号，不可为空 |
   | password |  String  |  登陆密码，不可为空  |

   返回结果：Json格式如下

   ```
   {
   	"code": ,
   	"message": ,
   	"data": {
   		"nickname": String,
   		"telephone": String,
   		"sex": String,
   		"headphoto": String,
   		"introduce": String,
   		"isguide": String,
   		"guideid": int,
   		"collectguideid": int,
   		"collecteassyid": int,
   		"star": int,
   		"password": String
   	}
   }
   ```

   | Json数据项 |   类型   |                      说明                       |
   | :--------: | :------: | :---------------------------------------------: |
   |    code    |   int    |      若为0，代表失败；<br/>若为1，代表成功      |
   |  message   |  String  |               返回的状态信息说明                |
   |    data    | 自定义类 | 返回的用户信息结果集<br/>类中的变量类型如上所示 |

   ​

2. **注册接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/YiYouImg/Register.php

   参数：

   | 参数名称  | 参数类型 |                             说明                             |
   | :-------: | :------: | :----------------------------------------------------------: |
   | username  |  String  |                      用户昵称，不可为空                      |
   | password  |  String  |                      用户密码，不可为空                      |
   |    tel    |  String  |                     用户手机号，不可为空                     |
   | imageInfo |  String  | 是否上传了头像，不可为空，<br/>若没有上传头像，则设定为default；<br/>若有上传头像，则设定为其他值，不可为default |
   |   file    |   File   |                     用户的头像，可以为空                     |

   返回结果：Json格式如下

   ```
   {
   	"code": ,
   	"message": ,
   	"data": ""
   }
   ```

   | Json数据项 |  类型  |                 说明                  |
   | :--------: | :----: | :-----------------------------------: |
   |    code    |  int   | 若为0，代表失败；<br/>若为1，代表成功 |
   |  message   | String |          返回的状态信息说明           |
   |    data    | String |       注册不返回结果集，为空；        |