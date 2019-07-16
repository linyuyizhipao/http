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

    /**
     *
     * @param string $url api完整http地址
     * @param array $param get方式调取api的参数
     * @return string
     */
    public function get($url, $param = [])
    {
        try {
            $client = $this->http;
            $response = $client->request('GET', $url, ['query' => $param]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
            return false;
        }

    }

    /**
     * @param string $url api完整http地址
     * @param array $param post方式调取api的参数
     * @return string
     */
    public function post($url, $param = [])
    {
        try {
            $client = $this->http;
            $response = $client->request('POST', $url, [
                'form_params' => $param
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $this->error[] = $e->getMessage();
            return false;
        }
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getFirstError()
    {
        return $this->error[0] ?? [];
    }
}