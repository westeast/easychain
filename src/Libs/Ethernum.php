<?php 
namespace Westeast\EasyChain\Libs;


class Ethereum extends RpcJson
{
    private function ether_request($method, $params=array())
    {
        try
        {
            $ret = $this->eth_request($method, $params);
            return $ret['result'];
        }
        catch(RPCException $e)
        {
            throw $e;
        }
    }

    private function decode_hex($input)
    {
        if(substr($input, 0, 2) == '0x')
            $input = substr($input, 2);

        if(preg_match('/[a-f0-9]+/', $input))
            return hexdec($input);

        return $input;
    }

    function eth_blockNumber($decode_hex=FALSE)
    {
        $block = $this->ether_request(__FUNCTION__);

        if($decode_hex)
            $block = $this->decode_hex($block);

        return $block;
    }

    function eth_getBalance($address, $block='latest', $decode_hex=FALSE)
    {
        $balance = $this->ether_request(__FUNCTION__, array($address, $block));

        if($decode_hex)
            $balance = $this->decode_hex($balance);

        return $balance;
    }

    function eth_getStorageAt($address, $at, $block='latest')
    {
        return $this->ether_request(__FUNCTION__, array($address, $at, $block));
    }

    function eth_getTransactionCount($address, $block='latest', $decode_hex=FALSE)
    {
        $count = $this->ether_request(__FUNCTION__, array($address, $block));

        if($decode_hex)
            $count = $this->decode_hex($count);

        return $count;
    }

    function eth_getBlockTransactionCountByHash($tx_hash)
    {
        return $this->ether_request(__FUNCTION__, array($tx_hash));
    }

    function eth_getBlockTransactionCountByNumber($tx='latest')
    {
        return $this->ether_request(__FUNCTION__, array($tx));
    }

    function eth_getUncleCountByBlockHash($block_hash)
    {
        return $this->ether_request(__FUNCTION__, array($block_hash));
    }

    function eth_getUncleCountByBlockNumber($block='latest')
    {
        return $this->ether_request(__FUNCTION__, array($block));
    }

    function eth_getCode($address, $block='latest')
    {
        return $this->ether_request(__FUNCTION__, array($address, $block));
    }

    function eth_sign($address, $input)
    {
        return $this->ether_request(__FUNCTION__, array($address, $input));
    }

    function eth_sendTransaction($transaction)
    {
        if(!is_a($transaction, EthereumTransaction::class))
        {
            throw new \Exception('Transaction object expected');
        }
        else 
        {
            return $this->ether_request(__FUNCTION__, $transaction->toArray());
        }
    }

    function eth_call($message, $block)
    {
        if(!is_a($message, EthereumMessage::class))
        {
            throw new \Exception('Message object expected');
        }
        else
        {
            return $this->ether_request(__FUNCTION__, $message->toArray());
        }
    }

    function eth_estimateGas($message, $block)
    {
        if(!is_a($message, EthereumMessage::class))
        {
            throw new \Exception('Message object expected');
        }
        else
        {
            return $this->ether_request(__FUNCTION__, $message->toArray());
        }
    }

    function eth_getBlockByHash($hash, $full_tx=TRUE)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $full_tx));
    }

    function eth_getBlockByNumber($block='latest', $full_tx=TRUE)
    {
        return $this->ether_request(__FUNCTION__, array($block, $full_tx));
    }

    function eth_getTransactionByHash($hash)
    {
        return $this->ether_request(__FUNCTION__, array($hash));
    }

    function eth_getTransactionByBlockHashAndIndex($hash, $index)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $index));
    }

    function eth_getTransactionByBlockNumberAndIndex($block, $index)
    {
        return $this->ether_request(__FUNCTION__, array($block, $index));
    }

    function eth_getTransactionReceipt($tx_hash)
    {
        return $this->ether_request(__FUNCTION__, array($tx_hash));
    }

    function eth_getUncleByBlockHashAndIndex($hash, $index)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $index));
    }

    function eth_getUncleByBlockNumberAndIndex($block, $index)
    {
        return $this->ether_request(__FUNCTION__, array($block, $index));
    }

    function eth_compileSolidity($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    function eth_compileLLL($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    function eth_compileSerpent($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    function eth_newFilter($filter, $decode_hex=FALSE)
    {
        if(!is_a($filter, EthereumFilter::class))
        {
            throw new \Exception('Expected a Filter object');
        }
        else
        {
            $id = $this->ether_request(__FUNCTION__, $filter->toArray());

            if($decode_hex)
                $id = $this->decode_hex($id);

            return $id;
        }
    }

    function eth_newBlockFilter($decode_hex=FALSE)
    {
        $id = $this->ether_request(__FUNCTION__);

        if($decode_hex)
            $id = $this->decode_hex($id);

        return $id;
    }

    function eth_newPendingTransactionFilter($decode_hex=FALSE)
    {
        $id = $this->ether_request(__FUNCTION__);

        if($decode_hex)
            $id = $this->decode_hex($id);

        return $id;
    }

    function eth_uninstallFilter($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function eth_getFilterChanges($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function eth_getFilterLogs($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function eth_getLogs($filter)
    {
        if(!is_a($filter, EthereumFilter::class))
        {
            throw new \Exception('Expected a Filter object');
        }
        else
        {
            return $this->ether_request(__FUNCTION__, $filter->toArray());
        }
    }

    function eth_submitWork($nonce, $pow_hash, $mix_digest)
    {
        return $this->ether_request(__FUNCTION__, array($nonce, $pow_hash, $mix_digest));
    }

    function db_putString($db, $key, $value)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key, $value));
    }

    function db_getString($db, $key)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key));
    }

    function db_putHex($db, $key, $value)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key, $value));
    }

    function db_getHex($db, $key)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key));
    }

    function shh_version()
    {
        return $this->ether_request(__FUNCTION__);
    }

    function shh_post($post)
    {
        if(!is_a($post, WhisperPost::class))
        {
            throw new \Exception('Expected a Whisper post');
        }
        else
        {
            return $this->ether_request(__FUNCTION__, $post->toArray());
        }
    }

    function shh_newIdentity()
    {
        return $this->ether_request(__FUNCTION__);
    }

    function shh_hasIdentity($id)
    {
        return $this->ether_request(__FUNCTION__);
    }

    function shh_newFilter($to=NULL, $topics=array())
    {
        return $this->ether_request(__FUNCTION__, array(array('to'=>$to, 'topics'=>$topics)));
    }

    function shh_uninstallFilter($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function shh_getFilterChanges($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function shh_getMessages($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    function personal_newAccount($passphrase){
        return $this->ether_request(__FUNCTION__, array($passphrase));
    }

    function personal_listAccounts(){
        return $this->ether_request(__FUNCTION__);
    }

    function personal_unlockAccount($address,$passphrase,$duration=300){
        return $this->ether_request(__FUNCTION__, array($address,$passphrase,$duration));
    }

    function personal_lockAccount($address){
        return $this->ether_request(__FUNCTION__, array($address));
    }

    function personal_ecRecover($message, $signature){
        return $this->ether_request(__FUNCTION__, array($message,$signature));
    }

    function personal_importRawKey($keydata, $passphrase){
        return $this->ether_request(__FUNCTION__, array($keydata,$passphrase));
    }

    function personal_sendTransaction(EthereumTransaction $transaction,$passphrase){
        $params=$transaction->toArray();
        array_push($params,$passphrase);
        return $this->ether_request(__FUNCTION__, $params);
    }

    /**
     * web3_clientVersion
     * miner_start
     * miner_stop
     * web3_sha3
     * net_version
     * net_listening
     * net_peerCount
     * eth_protocolVersion
     * eth_coinbase
     * eth_mining
     * eth_hashrate
     * eth_gasPrice
     * eth_accounts
     * eth_getCompilers
     * eth_getWork
     * 所有的 ethernum方法都可以使用此方法调用 $parameters对应着param=[];
     */
    function __call($method, $parameters){
        return $this->ether_request($method,$parameters);
    }


}