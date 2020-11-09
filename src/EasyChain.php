<?php
namespace Westeast\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;

Class EasyChain {
    private $ethernum;
    public $config;
    public function get($name = 'ethernum'){
        if($name == 'ethernum'){
            $config = $this->config[$name];
            $this->ethernum = new Ethereum(
                $config['host'],
                $config['port']
            );
            return $this->ethernum;
        }
    }

}