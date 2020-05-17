<?php
namespace Laraws\Express;

use GuzzleHttp\Client;
use Laraws\Express\Exceptions\HttpException;
use Laraws\Express\Exceptions\InvalidArgumentException;

class Express
{
    protected $key;
    protected $guzzleOptions = [];

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
    public function getExpress(string $number, string $type = 'auto', string $mobile = '')
    {
        $url = 'https://api.jisuapi.com/express/query';

//        if (!in_array(strtolower($number), ['xml', 'json'])) {
//            throw new \Laraws\Express\Exceptions\InvalidArgumentException('Invalid response format: ' . $format);
//        }

        if (!in_array(strtolower($type), ['auto', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): '.$type);
        }

        $query = array_filter([
            'appkey' => $this->key,
            'number' => $number,
            'type' => $type,
            'mobile' => $mobile
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query
            ])->getBody()->getContents();
            $responseArr = json_decode($response, true);
            $a = $responseArr['result'];
            return $a;
        } catch (\Exception $e) {
            throw new \Laraws\Express\Exceptions\HttpException($e->getMessage(), $e->getCode(), $e);
        }

    }
}