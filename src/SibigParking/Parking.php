<?php  
namespace SibigParking;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class Parking extends Base
{
    public function __construct(
        $config
    )
    {
        $this->config = $config;
    }

    public function getLocations($format){
        $token = self::token($this->config,$format);
        $response = $this->actionLocation($token,$format);
        
        if ($response=="403") {
            $auth = self::auth($this->config,$format);
            $token = self::token($this->config,$format);
            $responseNd = $this->actionLocation($token,$format);
            return $responseNd->getBody();
        }elseif ($response=="429") {
            return json_encode([ 'error' => ' Anda Terkena Jumlah batasan limit tiap jam']);
        }elseif ($response->getStatusCode()=="200") {
            return $response->getBody();
        }else{
            return $response;
        }
    }

    protected function actionLocation($token,$format){
        $client = new Client();
        $accept = $format=="xml"?"xml":"json";

        try {
            $location = $client->request('GET', $this->config['url'].$this->config['version'].'/parking/locations', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept'    => 'application/'.$accept
                ],
            ]);
            return $location;
        } catch (ClientException $e) {
            return $e->getResponse()->getStatusCode();
        }  
    }

    public function singleTrans(
        $location,
        $vehicle,
        $payment,
        $enter,
        $exit,
        $plate_number,
        $amount,
        $format
    )
    {
        $token = self::token($this->config,$format);
        $response = $this->actionSingleTrans(
                                $token,        
                                $location,
                                $vehicle,
                                $payment,
                                $enter,
                                $exit,
                                $plate_number,
                                $amount,
                                $format);
        
        if ($response=="403") {
            $auth = self::auth($this->config,$format);
            $token = self::token($this->config,$format);
            $responseNd = $this->actionSingleTrans(
                                $token,        
                                $location,
                                $vehicle,
                                $payment,
                                $enter,
                                $exit,
                                $plate_number,
                                $amount,
                                $format);
            return $responseNd->getBody();
        }elseif ($response=="429") {
            return json_encode([ 'error' => ' Anda Terkena Jumlah batasan limit tiap jam']);
        }elseif ($response->getStatusCode()=="200") {
            return $response->getBody();
        }else{
            return $response;
        }
    }

    protected function actionSingleTrans(
        $token,
        $location,
        $vehicle,
        $payment,
        $enter,
        $exit,
        $plate_number,
        $amount,
        $format
    )
    {
        $client = new Client();
        $accept = $format=="xml"?"xml":"json";

        try {
            $singleTransaction = $client->request('POST', $this->config['url'].$this->config['version'].'/parking/transaction', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept'        => 'application/'.$accept,
                    'Content-Type'  => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'location' => $location,
                    'vehicle' => $vehicle,
                    'payment' => $payment,
                    'enter' => $enter,
                    'exit' => $exit,
                    'plate_number' => $plate_number,
                    'amount' => $amount,
                ]
            ]);
            return $singleTransaction;
        } catch (ClientException $e) {
            return $e->getResponse()->getStatusCode();
        }
    }

    public function multiTrans(
        $transactions,
        $format
    )
    {
        $token = self::token($this->config,$format);
        $response = $this->actionMultiTrans($token,$transactions,$format);
        
        if ($response=="403") {
            $auth = self::auth($this->config,$format);
            $token = self::token($this->config,$format);
            $responseNd = $this->actionMultiTrans($token,$transactions,$format);
            return $responseNd->getBody();
        }elseif ($response=="429") {
            return json_encode([ 'error' => ' Anda Terkena Jumlah batasan limit tiap jam']);
        }elseif ($response->getStatusCode()=="200") {
            return $response->getBody();
        }else{
            return $response;
        }
    }

    protected function actionMultiTrans(
        $token,
        $transactions,
        $format
    )
    {
        $client = new Client();
        $accept = $format=="xml"?"xml":"json";

        try {
            $location = $client->request('POST', $this->config['url'].$this->config['version'].'/parking/transactions', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept'        => 'application/'.$accept,
                    'Content-Type'  => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'transactions' => $transactions
                ]
            ]);
            return $location;   
        } catch (ClientException $e) {
            return $e->getResponse()->getStatusCode();
        }
    }
}


