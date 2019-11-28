<?php

namespace Src;

use Config;

class Porta
{
    private $sessionId;

    public function __construct($v)
    {
        if(isset($v)){
            Config::$param['VERSION'] = $v;
        }

        $this->login();
    }


    private function login()
    {
        if (Config::$param['VERSION'] == "70") {
            $post_data = [
                'params' => json_encode([
                    'login' => Config::$param['api_login_70'],
                    'token' => Config::$param['api_token_70'],
                ]),
            ];
        } else {
            $post_data = [
                'params' => json_encode([
                    'user'     => Config::$param['api_login_45'],
                    'password' => Config::$param['api_password_45'],
                ]),
            ];
        }

        $curl = curl_init();
        curl_setopt_array($curl,
            [
                CURLOPT_URL            => Config::$param['api_url_'.Config::$param['VERSION']] . '/Session/login',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($post_data),
            ]
        );

        $reply = curl_exec($curl);
        if (!$reply) {
            curl_close($curl);
            exit;
        }


        $data            = json_decode($reply);
        $this->sessionId = $data->{'session_id'};
        curl_close($curl);



//        if (Config::$param['VERSION'] == "70") {
//            $this->sessionId = "427291111d980e728a81096fda169057";
//        } else {
//            $this->sessionId = "23f3190544500bcd429f85cfb01b3cbe";
//        }

        echo "<h2>PORTA v." . Config::$param['VERSION'] . "</h2>";
    }


    public function exec($methodName, $repeat = 1)
    {

        echo "<div class='item'><b>" . $methodName . "</b> (x" . $repeat . ")<br><br>";

        $totalTime = 0;
        for ($i = 0; $i < $repeat; $i++) {
            switch ($methodName) {
                case "get_full_vd_counter_info":
                    $totalTime += (new get_full_vd_counter_info($this->sessionId, $i))->res();
                    break;
                case "get_customer_info":
                    $totalTime += (new get_customer_info($this->sessionId, $i))->res();
                    break;
                case "get_account_info":
                    $totalTime += (new get_account_info($this->sessionId, $i))->res();
                    break;
                case "add_account":
                    $totalTime += (new add_account($this->sessionId, $i))->res();
                    break;
                case "add_followme_number":
                    $totalTime += (new add_followme_number($this->sessionId, $i))->res();
                    break;
                case "update_account":
                    $totalTime += (new update_account($this->sessionId, $i))->res();
                    break;
            }
        }


        echo "<br>--------------------------<br>Среднее время: <b>" . $totalTime / $i . " ms</b><br></div>";
    }

}
