<?php
namespace Westeast\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;

Class EasyChain {
    public $config;
    public function get($name = 'ethereum'){
        $config = $this->config[$name];
        Ethereum::$config = $config;
        if(empty($this->$name)){            
            $this->$name= Ethereum::getInstance();
        }
        return $this->$name;
    }

}

namespace Westeast\EasyChain\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;
class Ether extends Ethereum{

}
