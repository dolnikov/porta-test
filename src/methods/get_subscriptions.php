<?php

namespace Src;

use Config;
use Src\interfaces\MethodsInterface;

class get_subscriptions implements MethodsInterface
{
    public $time;

    public function __construct($session_id, $countQuery)
    {
        $curl      = curl_init();
        $rand      = uniqid();
        $post_data = [
            'auth_info' => json_encode(['session_id' => $session_id]),
            'params'    => json_encode([
                "i_account"        => "166544382",
            ]),
        ];

        curl_setopt_array($curl,
            [
                CURLOPT_URL            => Config::$param['api_url_' . Config::$param['VERSION']] . '/Account/get_subscriptions',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($post_data),
            ]
        );

        $start_timer = microtime(true);
        $reply       = curl_exec($curl);
        $end_timer   = microtime(true);

        if (!$reply) {
            echo curl_error($curl);
            curl_close($curl);
            exit;
        }


        $response = json_decode($reply);
        if ($response->faultcode) {
            var_dump($reply);
        }


        if($countQuery == 0){
            echo "<div class='ResponseRequest'><b>Request: </b>" . json_encode($post_data) . "<br><br>";
            echo "<b>Response: </b>" . $reply. "<br></div>";
            $this->conutQuery = 1;
        }

        $time = number_format($end_timer - $start_timer, 3) * 1000;

        echo $time . ' ms<br>';
        $this->time = $time;
        curl_close($curl);
    }

    public function res()
    {
        return $this->time;
    }

}