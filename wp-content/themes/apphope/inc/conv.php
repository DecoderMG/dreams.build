<?php

global $current_user;

if($current_user->ID == 1){
    $_SESSION['currency_ip'] = 'EUR';
}

function currencyConverter($amount, $currency = 'USD', $type = null){
//    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
//    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
//    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
//    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
//    $yql_session = file_get_contents($yql_query_url);
//    $yql_json =  json_decode($yql_session,true);
//    $currency_output = $yql_json['query']['results']['rate']['Rate'];


    preg_match_all('!\d+!', $amount, $amount);

    $amount = $amount[0][0];

    $currency_code = '';

    if(isset($_SESSION['currency_ip'])){
        $currency_code = $_SESSION['currency_ip'];
    } else {
        $stripe = getAccount();

        if($stripe['status'] == true){
            $currency_code = strtoupper($stripe['currency_code']);
        } else {
            $currency_code = getCurrencyCodeByIp();
        }

        $_SESSION['currency_ip'] = $currency_code;

    }



//    $currency_code = 'EUR';

    if($currency_code == $currency || $currency_code == ''){
        return getSymbolCurr($currency_code).''.$amount;
    }

    if($amount == 0){
        return getSymbolCurr($currency_code).' 0';
    }

    $result = currencyNew($currency, $currency_code, $amount, $type);

    if($currency_code == getSymbolCurr($currency)){
        return getSymbolCurr($currency).floatval($result);
    } else {
        return getSymbolCurr($currency_code).' '.floatval(round($result, 2));
    }
}

 /*$currency_input = 2;
 //currency codes : http://en.wikipedia.org/wiki/ISO_4217
 $currency_from = "USD";
 $currency_to = "INR";
 $currency = currencyConverter($currency_from,$currency_to,$currency_input);

 echo $currency_input.' '.$currency_from.' = '.$currency.' '.$currency_to;*/

function currencyNew($from_Currency, $to_Currency, $amount, $type)
{

//    if($type == null){
//        $amount = $amount + round($amount * (2 / 100), 2);
//    }

    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
//    return round($converted, 3);
    return $converted;

}

function getAccount(){
    global $current_user;
    get_currentuserinfo();
    $user_id = $current_user->ID;
//    print_r($current_user);
//    die;

    if($user_id == 0){
        return ['status' => false];
    }

    $stripe_account = md_sc_account($user_id);

    if(is_object($stripe_account) && $stripe_account->details_submitted == true){
        return ['status' => true, 'currency_code' => $stripe_account->default_currency];
    }

    return ['status' => false];
}

function getCurrencyCodeByIp(){

    $code = '';

    $remote_IP_url = 'http://ip-api.com/json/' . get_client_ip(); // better would be use PHP GEOIP http://php.net/manual/en/book.geoip.php
    $remote_user_data = json_decode(file_get_contents(
        $remote_IP_url,
        0,
        stream_context_create(array(
            'http' => array(
                'timeout' => 5
                )
            )
        )
    ));

    // $remote_IP_url = 'http://ip-api.com/json/' . get_client_ip(); // better would be use PHP GEOIP http://php.net/manual/en/book.geoip.php
    // $remote_user_data = wp_get_remote($remote_IP_url, array(
    //     'timeout' => 5
    // ));
    // if( is_array($remote_user_data) ) {
    //     $remote_user_data = $response['body']; // use the content
    // }
    // $remote_user_data = json_decode($remote_user_data);

    if ( is_object($remote_user_data) && $remote_user_data->status == 'success' ) {
        $user_country = $remote_user_data->countryCode;

        $currency_code = json_decode(file_get_contents(dirname(__FILE__).'/json_currency.txt'), true);

        foreach ($currency_code as $curr){
            if($curr['CountryCode'] == $user_country){
                $code = $curr['Code'];

                break;
            }
        }
    } else {
        $code = 'USD'; // default code to prevent infinite load
    }

    return $code;

}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getSymbolCurr($currency_code = null){

    $currency_symbols = array(
        'AED' => '&#1583;.&#1573;', // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;', // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#1084;&#1072;&#1085;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;', // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;', // ?
        'BIF' => '&#70;&#66;&#117;', // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTN' => '&#78;&#117;&#46;', // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '', // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;', // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;', // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;', // ?
        'EGP' => '&#163;',
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;', // ?
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;', // ?
        'GNF' => '&#70;&#71;', // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;', // ?
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;', // ?
        'IRR' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;', // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;', // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;', // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;', // ?
        'KYD' => '&#36;',
        'KZT' => '&#1083;&#1074;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;', // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;', // ?
        'MAD' => '&#1583;.&#1605;.', //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;', // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;', // ?
        'MRO' => '&#85;&#77;', // ?
        'MUR' => '&#8360;', // ?
        'MVR' => '.&#1923;', // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;', // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#1088;&#1091;&#1073;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;', // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;', // ?
        'SOS' => '&#83;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;', // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;', // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '',
        'XOF' => '',
        'XPF' => '&#70;',
        'YER' => '&#65020;',
        'ZAR' => '&#82;',
        'ZMK' => '&#90;&#75;', // ?
        'ZWL' => '&#90;&#36;',
    );


    if($currency_code == null){
        if(isset($_SESSION['currency_ip'])){
            $currency_code = $_SESSION['currency_ip'];
        } else {
            $stripe = getAccount();

            if($stripe['status'] == true){
                $currency_code = strtoupper($stripe['currency_code']);
            } else {
                $currency_code = getCurrencyCodeByIp();
            }

            $_SESSION['currency_ip'] = $currency_code;

        }
    }

    return $currency_symbols[$currency_code];

}

function getSymbolCode(){

    if(isset($_SESSION['currency_ip'])){
        $currency_code = $_SESSION['currency_ip'];
    } else {
        $stripe = getAccount();

        if($stripe['status'] == true){
            $currency_code = strtoupper($stripe['currency_code']);
        } else {
            $currency_code = getCurrencyCodeByIp();
        }

        $_SESSION['currency_ip'] = $currency_code;

    }


    return $currency_code;

}

?>