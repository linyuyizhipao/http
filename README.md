# http
根据guzzle拓展加了2个常用的方法,推送到composer，后期项目使用方便

```code
Http::getInstance()->get($uri,$param); // 返回的是数组
Http::getInstance()->post($uri,$param); // 返回的是数组
Http::getInstance()->getError(); // 获取错误，无错误则未空数组
Http::getInstance()->getFirstError(); // 获取第一个错误，无错误则未空数组
```
get,post比较常用，直接用guzzle的client的话new什么的还有个返回值的转化过程就省略了
并且我们可以参考src\Http.php里面继续拓展封装，guzzle很灵活很强大，业务场景定制化
往往帮我们少些代码

好了现在你可以直接在你的项目代码；里面执行下面命令，便可以使用get,post方法调取api了
我已经将项目添加到composer了

### 安装：composer require lingyuyizhipao/http
