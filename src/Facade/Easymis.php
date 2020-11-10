<?php 
namespace Westeast\EasyChain\Facade;
use Illuminate\Support\Facades\Facade;

class Ethereum extends Facade
{
    protected static function getFacadeAccessor()
    {
        return app('easychain')->get('ethereum');
    }

}

class Bitcoin extends Facade 
{
    protected static function getFacadeAccessor()
    {
        return app('easychain')->get('ethereum');
    }
}