<?php

namespace Westeast\EasyChain\Libs;

use GuzzleHttp\Client;

class RpcJson{
    protected $host, $port, $version;
    protected $id = 0;
    private $client;

    function __construct($host, $port, $version="2.0")
    {
        $this->host = $host;
        $this->port = $port;
        $this->version = $version;
        $this->client=new Client([
            'base_uri' => ($this->host.":".$this->port)
        ]);
    }

    function eth_request($method, $params=array())
    {
        $data = array();
        $data['jsonrpc'] = $this->version;
        $data['id'] = $this->id++;
        $data['method'] = $method;
        $data['params'] = $params;

        try {
            $res = $this->client->request("POST",'', [
                'headers'  => ['content-type' => 'application/json'],
                'json' => $data
            ]);
            $formatted=json_decode($res->getBody()->getContents(),true);

            if(isset($formatted->error))
            {
                throw new RPCException($formatted->error->message, $formatted->error->code);
            }
            else
            {
                return $formatted;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function format_response($response)
    {
        return @json_decode($response);
    }
}
