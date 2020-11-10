# easychain
blockchain ethereum jsonrpc api rpc api

## 安装 
```
composer require westeast/easychain

php artisan vendor:publish -provider="Westeast\EasyChain\EasyChainProvider" --tag="config"


app/config中加入provoider
Westeast\EasyChain\EasyChainProvider

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
```
