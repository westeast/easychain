<?php

namespace Westeast\EasyChain\Libs;

class Ethereum extends RpcJson
{
    private function ether_request($method, $params = array())
    {
        try {
            $ret = $this->eth_request($method, $params);
            return $ret['result'];
        } catch (RPCException $e) {
            throw $e;
        }
    }

    private function decode_hex($input)
    {
        if (substr($input, 0, 2) == '0x') {
            $input = substr($input, 2);
        }

        if (preg_match('/[a-f0-9]+/', $input)) {
            return hexdec($input);
        }

        return $input;
    }

    public function eth_blockNumber($decode_hex = false)
    {
        $block = $this->ether_request(__FUNCTION__);

        if ($decode_hex) {
            $block = $this->decode_hex($block);
        }

        return $block;
    }

    public function eth_getBalance($address, $block = 'latest', $decode_hex = false)
    {
        $balance = $this->ether_request(__FUNCTION__, array($address, $block));

        if ($decode_hex) {
            $balance = $this->decode_hex($balance);
        }

        return $balance;
    }

    public function eth_getStorageAt($address, $at, $block = 'latest')
    {
        return $this->ether_request(__FUNCTION__, array($address, $at, $block));
    }

    public function eth_getTransactionCount($address, $block = 'latest', $decode_hex = false)
    {
        $count = $this->ether_request(__FUNCTION__, array($address, $block));

        if ($decode_hex) {
            $count = $this->decode_hex($count);
        }

        return $count;
    }

    public function eth_getBlockTransactionCountByHash($tx_hash)
    {
        return $this->ether_request(__FUNCTION__, array($tx_hash));
    }

    public function eth_getBlockTransactionCountByNumber($tx = 'latest')
    {
        return $this->ether_request(__FUNCTION__, array($tx));
    }

    public function eth_getUncleCountByBlockHash($block_hash)
    {
        return $this->ether_request(__FUNCTION__, array($block_hash));
    }

    public function eth_getUncleCountByBlockNumber($block = 'latest')
    {
        return $this->ether_request(__FUNCTION__, array($block));
    }

    public function eth_getCode($address, $block = 'latest')
    {
        return $this->ether_request(__FUNCTION__, array($address, $block));
    }

    public function eth_sign($address, $input)
    {
        return $this->ether_request(__FUNCTION__, array($address, $input));
    }

    public function eth_sendTransaction($transaction)
    {
        if (!is_a($transaction, EthereumTransaction::class)) {
            throw new \Exception('Transaction object expected');
        } else {
            return $this->ether_request(__FUNCTION__, $transaction->toArray());
        }
    }

    public function eth_call($message, $block)
    {
        if (!is_a($message, EthereumMessage::class)) {
            throw new \Exception('Message object expected');
        } else {
            return $this->ether_request(__FUNCTION__, $message->toArray());
        }
    }

    public function eth_estimateGas($message, $block)
    {
        if (!is_a($message, EthereumMessage::class)) {
            throw new \Exception('Message object expected');
        } else {
            return $this->ether_request(__FUNCTION__, $message->toArray());
        }
    }

    public function eth_getBlockByHash($hash, $full_tx = true)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $full_tx));
    }

    public function eth_getBlockByNumber($block = 'latest', $full_tx = true)
    {
        return $this->ether_request(__FUNCTION__, array($block, $full_tx));
    }

    public function eth_getTransactionByHash($hash)
    {
        return $this->ether_request(__FUNCTION__, array($hash));
    }

    public function eth_getTransactionByBlockHashAndIndex($hash, $index)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $index));
    }

    public function eth_getTransactionByBlockNumberAndIndex($block, $index)
    {
        return $this->ether_request(__FUNCTION__, array($block, $index));
    }

    public function eth_getTransactionReceipt($tx_hash)
    {
        return $this->ether_request(__FUNCTION__, array($tx_hash));
    }

    public function eth_getUncleByBlockHashAndIndex($hash, $index)
    {
        return $this->ether_request(__FUNCTION__, array($hash, $index));
    }

    public function eth_getUncleByBlockNumberAndIndex($block, $index)
    {
        return $this->ether_request(__FUNCTION__, array($block, $index));
    }

    public function eth_compileSolidity($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    public function eth_compileLLL($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    public function eth_compileSerpent($code)
    {
        return $this->ether_request(__FUNCTION__, array($code));
    }

    public function eth_newFilter($filter, $decode_hex = false)
    {
        if (!is_a($filter, EthereumFilter::class)) {
            throw new \Exception('Expected a Filter object');
        } else {
            $id = $this->ether_request(__FUNCTION__, $filter->toArray());

            if ($decode_hex) {
                $id = $this->decode_hex($id);
            }

            return $id;
        }
    }

    public function eth_newBlockFilter($decode_hex = false)
    {
        $id = $this->ether_request(__FUNCTION__);

        if ($decode_hex) {
            $id = $this->decode_hex($id);
        }

        return $id;
    }

    public function eth_newPendingTransactionFilter($decode_hex = false)
    {
        $id = $this->ether_request(__FUNCTION__);

        if ($decode_hex) {
            $id = $this->decode_hex($id);
        }

        return $id;
    }

    public function eth_uninstallFilter($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function eth_getFilterChanges($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function eth_getFilterLogs($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function eth_getLogs($filter)
    {
        if (!is_a($filter, EthereumFilter::class)) {
            throw new \Exception('Expected a Filter object');
        } else {
            return $this->ether_request(__FUNCTION__, $filter->toArray());
        }
    }

    public function eth_submitWork($nonce, $pow_hash, $mix_digest)
    {
        return $this->ether_request(__FUNCTION__, array($nonce, $pow_hash, $mix_digest));
    }

    public function db_putString($db, $key, $value)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key, $value));
    }

    public function db_getString($db, $key)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key));
    }

    public function db_putHex($db, $key, $value)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key, $value));
    }

    public function db_getHex($db, $key)
    {
        return $this->ether_request(__FUNCTION__, array($db, $key));
    }

    public function shh_version()
    {
        return $this->ether_request(__FUNCTION__);
    }

    public function shh_post($post)
    {
        if (!is_a($post, WhisperPost::class)) {
            throw new \Exception('Expected a Whisper post');
        } else {
            return $this->ether_request(__FUNCTION__, $post->toArray());
        }
    }

    public function shh_newIdentity()
    {
        return $this->ether_request(__FUNCTION__);
    }

    public function shh_hasIdentity($id)
    {
        return $this->ether_request(__FUNCTION__);
    }

    public function shh_newFilter($to = null, $topics = array())
    {
        return $this->ether_request(__FUNCTION__, array(array('to' => $to, 'topics' => $topics)));
    }

    public function shh_uninstallFilter($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function shh_getFilterChanges($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function shh_getMessages($id)
    {
        return $this->ether_request(__FUNCTION__, array($id));
    }

    public function personal_newAccount($passphrase)
    {
        return $this->ether_request(__FUNCTION__, array($passphrase));
    }

    public function personal_listAccounts()
    {
        return $this->ether_request(__FUNCTION__);
    }

    public function personal_unlockAccount($address, $passphrase, $duration = 300)
    {
        return $this->ether_request(__FUNCTION__, array($address, $passphrase, $duration));
    }

    public function personal_lockAccount($address)
    {
        return $this->ether_request(__FUNCTION__, array($address));
    }

    public function personal_ecRecover($message, $signature)
    {
        return $this->ether_request(__FUNCTION__, array($message, $signature));
    }

    public function personal_importRawKey($keydata, $passphrase)
    {
        return $this->ether_request(__FUNCTION__, array($keydata, $passphrase));
    }

    public function personal_sendTransaction(EthereumTransaction $transaction, $passphrase)
    {
        $params = $transaction->toArray();
        array_push($params, $passphrase);
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
    public function __call($method, $parameters)
    {
        $method = str_replace('Array','',$method);
        return $this->ether_request($method, $parameters);
    }
}
