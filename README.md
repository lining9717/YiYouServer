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
   		"isguide": String,（只有yes和no，yes代表是导游，no代表不是导游）
   		"guideid": int,
   		"star": int,
   		"password": String
   		"guiderealname": String,
   		"guideIDnumbr": String,
   		"guideNumber": String,
   		"guideservercity": String,
   		"guidestar": int
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

   |  参数名称   | 参数类型 |                             说明                             |
   | :---------: | :------: | :----------------------------------------------------------: |
   |     tel     |  String  |                     用户手机号，不可为空                     |
   |  realname   |  String  |                    用户真实姓名，不可为空                    |
   |  IDnumber   |  String  |                    用户身份证号，不可为空                    |
   | guidenumber |  String  |                      导游证号，不可为空                      |
   | servercity  |  String  | 服务城市，不可为空<br/>注意：省市区间用**一个空格**间隔<br/>（如：重庆市 沙坪坝区或四川省 成都市 高新区） |

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

   |  参数名称  | 参数类型 |                             说明                             |
   | :--------: | :------: | :----------------------------------------------------------: |
   |  IDNumber  |  String  |                        向导的身份证号                        |
   | servercity |  String  | 服务城市<br/>注意：省市区间用**一个空格**间隔<br/>（如：重庆市 沙坪坝区或四川省 成都市 高新区） |

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

6. **用户发布订单接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/ReleaseOrder.php

   参数：

   |    参数名称    | 参数类型 |                             说明                             |
   | :------------: | :------: | :----------------------------------------------------------: |
   |      tel       |  String  |                     用户手机号，不可为空                     |
   |     place      |  String  | 目的地，不可为空，<br/>注意：省市区间用**一个空格**间隔<br/>（如：重庆市 沙坪坝区或四川省 成都市 高新区） |
   |      date      |  String  |               日期，不可为空，格式为YYYY-MM-DD               |
   | numberOfPeople |   int    |                      同行人数，不可为空                      |
   |  description   |  String  |                        备注，不可为空                        |

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

7. **获取用户订单信息接口**

   请求类型：POST请求

   闲置（idle）订单URL地址：http://118.89.18.136/YiYou/UserGetIdleOrders.php

   已接受（accepted）订单URL地址：http://118.89.18.136/YiYou/UserGetAcceptedOrders.php

   正在进行（begin）订单URL地址：http://118.89.18.136/YiYou/UserGetBeginOrders.php

   已完成（finished）订单URL地址：http://118.89.18.136/YiYou/UserGetFinishedOrders.php

   参数：

   | 参数名称 | 参数类型 |         说明         |
   | :------: | :------: | :------------------: |
   |   tel    |  String  | 用户手机号，不可为空 |

   返回结果：Json格式如下

   ```
   {
   	"code": int,
   	"message": String,
   	"data": [{
   		"orderID": int,
   		"status": String,
   		"place": String,
   		"date": String,
   		"numberOfPeople": int,
   		"note": Strig,
   		"userNickname": String
   	},{
   		"orderID": int,
   		"status": String,
   		"place": String,
   		"date": String,
   		"numberOfPeople": int,
   		"note": Strig,
   		"userNickname": String
   	},
   	...
   	]
   }
   ```

   | Json数据项 |   类型   |                             说明                             |
   | :--------: | :------: | :----------------------------------------------------------: |
   |    code    |   int    |              若为1，代表成功；<br/>否则为不成功              |
   |  message   |  String  |                      返回的状态信息说明                      |
   |    data    | 自定义类 | 若无订单，data项为空；否则具体返回类型见上图；<br/>status有四种状态:idle(闲置)、accepted(已被向导接单)、<br/>begin(用户选择了向导开始进行)、finished(已完成)；<br/>note代表用户对订单的备注 |

   ​

8. **向导获得订单信息接口**

   请求类型：POST请求

   向导获取服务城市订单信息URL地址：http://118.89.18.136/YiYou/GuideGetNearbyOrders.php

   向导获取接受（accepted）订单信息接口：http://118.89.18.136/YiYou/GuideGetAcceptedOrders.php

   向导获取正在进行（begin）订单信息接口：http://118.89.18.136/YiYou/GuideGetBeginOrders.php

   向导获取已完成（finished）订单信息接口：http://118.89.18.136/YiYou/GuideGetFinishedOrders.php

   参数：

   | 参数名称 | 参数类型 |          说明          |
   | :------: | :------: | :--------------------: |
   | IDnumber |  String  | 向导身份证号，不可为空 |

   返回结果：Json格式如下

   ```
   {
   	"code": int,
   	"message": String,
   	"data": [{
   		"orderID": int,
   		"status": String,
   		"place": String,
   		"date": String,
   		"numberOfPeople": int,
   		"note": Strig,
   		"userNickname": String
   	},{
   		"orderID": int,
   		"status": String,
   		"place": String,
   		"date": String,
   		"numberOfPeople": int,
   		"note": Strig,
   		"userNickname": String
   	},
   	...
   	]
   }
   ```

   | Json数据项 |   类型   |                     说明                     |
   | :--------: | :------: | :------------------------------------------: |
   |    code    |   int    |      若为1，代表成功；<br/>否则为不成功      |
   |  message   |  String  |              返回的状态信息说明              |
   |    data    | 自定义类 | 若无订单，data项为空；否则具体返回类型见上图 |

   ​

9. **向导接单接口**

   请求类型：POST请求

   URL地址：http://118.89.18.136/YiYou/GuideAcceptOrder.php

   参数：

   | 参数名称 | 参数类型 |          说明          |
   | :------: | :------: | :--------------------: |
   | orderID  |   int    |    订单ID，不可为空    |
   | IDNumber |  String  | 向导身份证号，不可为空 |

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

   说明：该接口会更新订单的状态信息，从“idle”更新为“accepted”状态

   ​

10. **用户获取已接单向导信息接口**

  请求类型：POST请求

  URL地址：http://118.89.18.136/YiYou/UserGetAcceptGuides.php

  参数：

  | 参数名称 | 参数类型 |       说明       |
  | :------: | :------: | :--------------: |
  | orderID  |   int    | 订单ID，不可为空 |

  返回结果：Json格式如下

  ```
  {
  	"code": ,
  	"message": ,
  	"data": [{
  		"realname": String,
  		"guideNumber": int,
  		"servercity": String,
  		"star": int,
  		"headphoto":String,
  		"guideIntro":String
  	}, {
  		"realname": String,
  		"guideNumber": int,
  		"servercity": String,
  		"star": int,
  		"headphoto":String,
  		"guideIntro":String
  	}，
  	...
  	]
  }
  ```

  | Json数据项 |   类型   |                       说明                        |
  | :--------: | :------: | :-----------------------------------------------: |
  |    code    |   int    |        若为1，代表成功；<br/>否则为不成功         |
  |  message   |  String  |                返回的状态信息说明                 |
  |    data    | 自定义类 | 若无订单，data项为空；<br/>否则具体返回类型见上图 |

  ​

11. **用户选择向导开始订单接口**

    请求类型：POST请求

    URL地址：http://118.89.18.136/YiYou/UserBeginOrder.php

    参数：

    |  参数名称   | 参数类型 |        说明        |
    | :---------: | :------: | :----------------: |
    |   orderID   |   int    |  订单ID，不可为空  |
    | guideNumber |  String  | 导游证号，不可为空 |

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

12. **用户完成订单接口**

    请求类型：POST请求

    URL地址：http://118.89.18.136/YiYou/UserFinishOrder.php

    参数：

    | 参数名称 | 参数类型 |              说明              |
    | :------: | :------: | :----------------------------: |
    | orderId  |   int    |        订单ID，不可为空        |
    |   star   |   int    | 用户对导游的评级星级，不可为空 |

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
