<?php
/**
 * 在类名的上面可以定义对象里面属性的数据类型 (通过@property)
 * @property string $example
 */
class Object{
    protected $example;
    private static $_instance = [];
    protected $error = [];
    /**
    * 私有化构造方法保持单例
    */
    private function __construct()
    {
    }
    /**
     * 私有化克隆方法保持单例
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 定义函数返回的数据类型
    * @param  string $key 定义传参的数据乐星
    * @return  Object
    */
    public static function getInstance($key = 'default')
    {
        if(!self::$_instance[$key]){
           self::$_instance[$key] = new self();
        }
           return self::$_instance[$key];
    }
    /**
    *  这里来点方法备注
    * @param string $param 参描
    * @param string $url 完整http地址
    * @author  hugo
    * @return array
    */
    public function run($param,$url)
    {
        //接管异常
        set_error_handler(function ($errno, $errstr, $errfile, $errline, array $errcontext) {
            restore_error_handler();//还原异常接管
        });
        return [$param,$url];
    }

    /**
    * @return array
    */
    public function getError()
    {
        return $this->error;
    }
    /**
     * @param  string $message 错误信息
     * @return array
     */
    public function setError($message)
    {
        $this->error = $message;
    }
}