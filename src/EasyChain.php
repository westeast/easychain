<?php
namespace Westeast\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;

Class EasyChain {
    private Ethereum $ethernum;
    public $config;
    public function get($name = 'ethernum'){
        if($name == 'ethernum'){
            if(empty($this->ethernum)){
                $config = $this->config[$name];
                $this->ethernum = new Ethereum(
                    $config['host'],
                    $config['port']
                );
            }
            return $this->ethernum;
        }
    }

}

namespace Westeast\EasyChain\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;
class Ether extends Ethereum{

}