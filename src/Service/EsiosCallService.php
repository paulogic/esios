<?php

namespace Esios\Service;

use Esios\EsiosBase as EsiosBase;
use Esios\Esios_Call_Exception as Esios_Call_Exception;
use Psr\Log\LoggerInterface as PsrLogLoggerInterface;

/**
 * Simple class that makes the http call to the Esios API.
 */
class EsiosCallService extends EsiosBase implements EsiosCallServiceInterface {

    private $token;
    private $config = [
        'host' => 'api.esios.ree.es',
        'timeout' => 5,
        'version' => 'v1',
        'timezone' => 'Europe/Madrid'
    ];

    /**
     * 
     * @param String $token
     * @param array $config
     * @param PsrLogLoggerInterface $logger
     */
    public function __construct($token, Array $config = [], PsrLogLoggerInterface $logger = null) {

        parent::__construct($logger);
        $this->token = $token;
        $this->config = array_merge($this->config, $config);
        date_default_timezone_set($this->config['timezone']);
    }

    /**
     * @param String $url
     * @param array $headers
     * @param array $params
     * @return String
     * @throws Esios_Call_Exception
     */
    protected function curl_call($url, Array $headers = [], Array $params = []) {

        $this->debug("Calling [$url] with params: " . json_encode($params));

        $defaults = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_POST => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => $this->config['timeout'],
            CURLOPT_HTTPHEADER => $headers,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        if (!$result = curl_exec($ch)) {
            $msg = "Error connecting to: [$url] - " . curl_error($ch);
            throw new Esios_Call_Exception($msg);
        } else {
            $this->debug("Success connecting to: [$url] response: [$result]");
        }
        curl_close($ch);
        return $result;
    }

    /**
     * 
     * @return Array
     */
    protected function getHeaders() {

        return array(
            'Accept: application/json; application/vnd.esios-api-' . $this->config['version'] . '+json',
            'Content-Type: application/json',
            'Host: ' . $this->config['host'],
            'Authorization: Token token="' . $this->token . '"',
            'Cookie: ');
    }

    /**
     * @param String $path
     * @param Array $params
     * @return String
     * @throws Exception
     */
    public function getData($path, Array $params) {

        try {
            $url = 'https://' . $this->config['host'] . $path;
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
            return $this->curl_call($url, $this->getHeaders(), $params);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            throw $e;
        }
    }

}
