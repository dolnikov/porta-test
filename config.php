<?php

class Config {

    static public $param = [
        "VERSION" => "45",

        //Настройки подключени к PORTA
        //For MR70
        "api_url_70"   => "https://172.16.120.12/rest",
        //"api_url_70"   => "https://staging1-pweb.porta.local/rest",
        "api_login_70" => "CAPI_MTTBSNS",
        "api_token_70" => "54c29099-ca76-413d-a1a7-64f3c18e1f31",

        //For MR45
        "api_url_45"   => "https://80.75.132.201/rest",
        //"api_url_45"   => "https://80.75.132.116/rest",
        "api_login_45" => "CAPI_MTTBSNS",
        "api_password_45" => "60mhvkxe",

        //////////////////////////////////////////////
        /////////КОНФИГИ КАСТОМЕРА ДЛЯ ТЕСТОВ/////////
        //////////////////////////////////////////////

        //stage
//        "i_customer" => "45155782",
//        "i_account" => "110065453",

        //prod
        "i_customer" => "45206387",
        "i_account" => "113091160",
    ];
}