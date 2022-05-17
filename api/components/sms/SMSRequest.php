<?php

namespace api\components\sms;

use Psr\Http\Client\ClientExceptionInterface;
use Yii;
use api\components\HttpException;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Credentials\Container;
use Vonage\Client;
use Vonage\Verify\Request;

class SMSRequest
{
    private $basic;
    private $client;
    private $brand_name;
    const STATUS_SUCCESS = 0;

    public function __construct()
    {
        $this->brand_name = Yii::$app->params['BRAND_NAME'];
        $this->basic = new Basic(Yii::$app->params['SMS_API_KEY'], Yii::$app->params['SMS_API_SECRET']);
        $this->client = new Client(new Container($this->basic));
    }

    /**
     * @throws HttpException
     * @throws ClientExceptionInterface
     */
    public function verify($mobile_number)
    {
        $request = new Request($mobile_number, $this->brand_name);
        $request_id = $this->getRequestID($request);
        Yii::$app->cache->set($mobile_number, $request_id, 300);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws HttpException
     */
    public function getRequestID($request)
    {
        try {
            $result = $this->client->verify()->start($request);
        } catch (\Exception $e) {
            throw new HttpException(400, [
                'error_text' => $e->getMessage(),
            ]);
        }
        return $result->getRequestId();
    }

    /**
     * @throws HttpException
     */
    public function verifyCheck($model)
    {
        try {
            $request_id = Yii::$app->cache->get($model->mobile_number);
            $response = $this->client->verify()->check($request_id, $model->code);
            return $response->getResponseData();
        } catch (\Exception $e) {
            throw new HttpException(400, [$model->formName() => $e->getMessage()]);
        } catch (ClientExceptionInterface $e) {
            throw new HttpException(400, [$model->formName() => $e->getMessage()]);
        }
    }

}