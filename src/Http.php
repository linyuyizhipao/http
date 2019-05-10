<?php
namespace Lingyuyizhipao;
use GuzzleHttp\Client;
/**
 * @property Http static $_instance
 * @property \GuzzleHttp\Client $http
 */
class Http extends Base
{
    private static $_instance;
    private $http;
    private $error = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
            self::$_instance->http = new Client();
        }
        return self::$_instance;
    }

    public function get(string $url,array $param=[])
    {
        try{
            $client = $this->http;
            $response = $client->request('GET', $url,['query'=>$param]);
            return json_decode($response->getBody(),true);
        }catch (\Exception $e){
            $this->error[] = $e->getMessage();
            return false;
        }

    }

    public function post($url,$param=[])
    {
        try{
            $client = $this->http;
            $response = $client->request('POST', $url,[
                'form_params'=>$param
            ]);
            return json_decode($response->getBody(),true);
        }catch (\Exception $e){
            $this->error[] = $e->getMessage();
            return false;
        }
    }

    public function getError()
    {
        return $this->error;
    }
    public function getFirstError()
    {
        return $this->error[0]??'';
    }
}