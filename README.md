# easychain
blockchain ethereum jsonrpc api rpc api

## 安装 
```
composer require westeast/easychain

php artisan vendor:publish --provider="Westeast\EasyChain\EasyChainServiceProvider"
输出如下内容
Copied File [/vendor/westeast/easychain/config/easychain.php] To [/config/easychain.php]
Publishing complete.


app/config中加入provoider  > laravel 5.4时不加也生效
Westeast\EasyChain\EasyChainProvider

如果 有问题记得清理一下config cache;

```


## 使用
```
# app调用
app('easychain')->get('ethereum')->net_version()
app('easychain')->get('ethereum')->miner_start()
app('easychain')->get('ethereum')->eth_mining()
app('easychain')->get('ethereum')->eth_accounts()

app('easychain')->get('ethereum')->eth_getBalance('0x385f27d936066839407c0b90066be28672bde05d','latest') 

#用Facade调用
>>> Westeast\EasyChain\Facade\Ethereum::eth_mining()
=> false
>>> Westeast\EasyChain\Facade\Ethereum::miner_start()
=> null
>>> Westeast\EasyChain\Facade\Ethereum::eth_mining()
=> true
>>> Westeast\EasyChain\Facade\Ethereum::miner_stop()

Westeast\EasyChain\Facade\Ethereum::eth_accounts()

#可以在原始方法中加个Origin来按原始方法传参数
$data = [
     "from" => "0x9b66f06b7b1a11e9c5df474d3a9496ad0544dcea",
     "to" => "0x4f51b91da422e2336da73c9b40cf228bbfea30ad",
     "gas" => "0x6691b7",
     "data" => "0x70f2a971",
   ];
$data = [
     "from" => "0x9b66f06b7b1a11e9c5df474d3a9496ad0544dcea",
     "to" => "0x4f51b91da422e2336da73c9b40cf228bbfea30ad",
     "gas" => "0x6691b7",
     "data" => "0x217520980000000000000000000000000000000000000000000000000000000000000001000000000000000000000000000000000000000000000000000000000000000100000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000001000000000000000000000000000000000000000000000000000000000000000100000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd0000000000000000000000000000000000000000000000000000e4b8ade59bbd",
   ];
Westeast\EasyChain\Facade\Ethereum::eth_callOrigin($data,'latest')
```
