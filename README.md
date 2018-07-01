# YiYouServer
### 服务端接口说明

1. **登录接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/Login.php

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

   URL地址：http://118.89.18.136/YiYou/Register.php

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

   ​

3. **用户信息修改接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/UpdateUserInfo.php

   参数：

   | 参数名称  | 参数类型 |                             说明                             |
   | :-------: | :------: | :----------------------------------------------------------: |
   |    tel    |  String  |                     用户手机号，不可为空                     |
   | password  |  String  |                      用户密码，不可为空                      |
   | nickname  |  String  |                      用户昵称，不可为空                      |
   |    sex    |  String  |                      用户性别，不可为空                      |
   | introduce |  String  |                    用户个人简介，不可为空                    |
   | imageInfo |  String  | 是否重新上传头像，不可为空<br/>如重新上传，imageInfo=update；<br/>否则imageInfo为其他值 |
   |   file    |   File   |                     用户新头像，可以为空                     |

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
   |    data    | String |   更新用户信息不返回结果集，为空；    |

   ​

4. **用户申请成为向导**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/BecomeGuide.php

   参数：

   |  参数名称   | 参数类型 |          说明          |
   | :---------: | :------: | :--------------------: |
   |     tel     |  String  |  用户手机号，不可为空  |
   |  realname   |  String  | 用户真实姓名，不可为空 |
   |  IDnumber   |  String  | 用户身份证号，不可为空 |
   | guidenumber |  String  |   导游证号，不可为空   |
   | servercity  |  String  |   服务城市，不可为空   |

   返回结果：Json格式如下

   ```
   {
   	"code": ,
   	"message": ,
   	"data": ""
   }
   ```

   | Json数据项 |  类型  |                说明                |
   | :--------: | :----: | :--------------------------------: |
   |    code    |  int   | 若为1，代表成功；<br/>否则为不成功 |
   |  message   | String |         返回的状态信息说明         |
   |    data    | String |        不返回结果集，为空；        |

   ​

5. **向导信息修改接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/UpdateGuideInfo.php

   参数：

   |  参数名称  | 参数类型 |      说明      |
   | :--------: | :------: | :------------: |
   |  IDNumber  |  String  | 向导的身份证号 |
   | servercity |  String  |    服务城市    |

   返回结果：Json格式如下

   ```
   {
   	"code": ,
   	"message": ,
   	"data": ""
   }
   ```

   | Json数据项 |  类型  |                说明                |
   | :--------: | :----: | :--------------------------------: |
   |    code    |  int   | 若为1，代表成功；<br/>否则为不成功 |
   |  message   | String |         返回的状态信息说明         |
   |    data    | String |        不返回结果集，为空；        |
