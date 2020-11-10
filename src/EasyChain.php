<?php
namespace Westeast\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;

Class EasyChain {
    private Ethereum $ethereum;
    public $config;
    public function get($name = 'ethereum'){
        if($name == 'ethereum'){
            if(empty($this->ethereum)){
                $config = $this->config[$name];
                Ethereum::$config = $config;
                $this->ethereum = Ethereum::getInstance();
            }
            return $this->ethereum;
        }
    }

}

namespace Westeast\EasyChain\EasyChain;
use Westeast\EasyChain\Libs\Ethereum;
class Ether extends Ethereum{

}