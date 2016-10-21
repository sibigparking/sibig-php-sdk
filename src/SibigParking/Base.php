<?php 
namespace SibigParking;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Base
{
    public function __construct()
    {
    }

    public function token($config,$format){
        $filename = realpath(dirname(__FILE__))."/token.txt";
        $handle = fopen($filename, "r");
        if ((int)filesize($filename) < 1) {
            $contents = $this->auth($config,$format);
        }
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        
        return $contents;
    }

    public function auth(
        $config,
        $format
    )
    {
        $client = new Client();
        $accept = $format=="xml"?"xml":"json";

        $response = $client->request('POST', $config['url'].$this->config['version'].'/auth', [
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($config['id'].":".$config['secret']),
                'Accept'    => 'application/'.$accept
            ]
        ]);

        try {
            $jsonResponse = $response->getBody();
            $this->saveToken(json_decode($jsonResponse)->token);
            return json_decode($jsonResponse);
        } catch (Exception $e) {
            return "Error Login";           
        }
    }

    protected function saveToken($token){
        $file = fopen(realpath(dirname(__FILE__))."/token.txt","w");
        fwrite($file,$token);
        fclose($file);
    }
}
