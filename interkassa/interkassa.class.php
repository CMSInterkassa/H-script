<?php
ini_set('display_errors', 1);

class Interkassa
{
    public function __construct($params2)
    {

        $this->apiId = $params2['apiId'];//'5bd2ed2e3c1eaf743c8b4568';
        $this->apiKey = $params2['apiKey'];//'j6liXicYuDS76NyWDyJjVYRt6kBnkISU';
        $this->merchantId = $params2['merchantId'];//'5c3f457e3b1eaf78238b456a';
        $this->testMode = strtoupper($params2['testMode']);//'yes';
        $this->secretKey = $params2['secretKey'];//'M2Xhk62iapbRY5k8';
        $this->testKey = $params2['testKey'];//'xERBUnBWKf0KZI42';
        $this->enabledAPI = strtoupper($params2['enabledAPI']);//'yes';

        $this->key = $this->secretKey;
    }

    // Проверяет поддерживаеться ли валюта магазина,
    // возвращает ошибку или код валюты
    public function getCurrencyVerification($cur_shop)
    {
        $remote_url_ik = 'https://api.interkassa.com/v1/currency';
        $cur_ik = $this->getData($this->apiId, $this->apiKey, $remote_url_ik);

        if (empty($cur_ik)) {
            $mes['error'] = 'Не получены валюты от Интеркассы';
            return $mes;
        }

//        var_dump($cur_shop);
        if (empty($cur_shop)) {
            $mes['error'] = 'Не получены валюты от магазина';
            return $mes;
        }

        $cur_for_mes = '';
        foreach ($cur_ik->data as $key => $item) {
            if ($cur_shop == $key) {
                return $key;
            } elseif ($cur_shop == 'RUR') {
                return 'RUB';
            } else {
                $cur_for_mes .= $key . ' ';
            }
        }

        $mes['error'] = 'Интеркасса не поддерживает валюту магазина - ' . $cur_shop . '. Доступные валюты: ' . $cur_for_mes;
        return $mes;
    }

    public function generate_form($tag, $sum, $memo, $cur_shop, $urlok, $urlfail, $urlproc)
    {
        $order_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'] . '/operation?id=' . $tag;// . '&pay';
        $cur = $this->getCurrencyVerification($cur_shop);
        if (!is_array($cur)) {
            $action_adr = "https://sci.interkassa.com/";

            $FormData = array(
                'ik_am' => $sum,
                'ik_cur' => $cur,
                'ik_co_id' => $this->merchantId,
                'ik_pm_no' => $tag,
                'ik_desc' => $memo,
                'ik_ia_u' => $urlok,
                'ik_suc_u' => $order_url,//$urlproc,//$this->url_modul,
                'ik_fal_u' => $urlfail,//$this->url_modul,
            );

            if ($this->testMode == 'Y')
                $FormData['ik_pw_via'] = 'test_interkassa_test_xts';

            $FormData["ik_sign"] = $this->IkSignFormation($FormData, $this->key);
            $hidden_fields = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>'
                . '<form name="payment_interkassa" id="InterkassaForm" action="javascript:selpayIK.selPaysys()" method="POST" class="">';
            foreach ($FormData as $key => $value) {
                $hidden_fields .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
            }
            $hidden_fields .= '<input type="submit" value="Перейти к оплате" style="display:block" class="button-green"></form>';
            $url_host = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url_location=$order_url;
//            $cancel_url = '<a class="button cancel" href="' . $order_url . '">Отказаться от оплаты & вернуться в корзину</a>';
        } else {
            $error_mes = $cur['error'];
            $cancel_url = '<a class="button cancel" href="' . $order_url . '">Вернуться к заказу</a>';
        }
        include_once 'tpl.php';
        return array('html' => $hidden_fields);
    }

    public function ajaxSign_generate()
    {

        //if (!empty($data['ik_pw_via']) && $data['ik_pw_via'] == 'test_interkassa_test_xts')
        //    $new_ik_sign = $data["ik_sign"];
        //else
        //    $new_ik_sign = $this->IkSignFormation($data, $this->secret);

        header("Pragma: no-cache");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
        header("Content-type: text/plain");
        $request = $_POST;

        if (isset($request['ik_act']) && $request['ik_act'] == 'process') {
//                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/t.txt', 'getAnswerFromAPI   ' . "\r\n", FILE_APPEND);

            $request['ik_sign'] = $this->IkSignFormation($request, $this->key);
            $data = $this->getAnswerFromAPI($request);
        } else {
//            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/t.txt', 'IkSignFormation   ' . "\r\n", FILE_APPEND);
            $data = $this->IkSignFormation($request, $this->key);

        }
        return $data;
    }

    public function IkSignFormation($data, $secret_key)
    {
        if (!empty($data['ik_sign'])) unset($data['ik_sign']);

        $dataSet = array();
        foreach ($data as $key => $value) {
            if (!preg_match('/ik_/', $key)) continue;
            $dataSet[$key] = $value;
        }

        ksort($dataSet, SORT_STRING);
        array_push($dataSet, $secret_key);
        $arg = implode(':', $dataSet);
        $ik_sign = base64_encode(md5($arg, true));
        return $ik_sign;
    }

    public function getAnswerFromAPI($data)
    {
        $ch = curl_init('https://sci.interkassa.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        echo $result;
        exit;
    }

    public function getData($login, $pass, $url)
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode($login . ':' . $pass)
            )
        );

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        $json_data = json_decode($response); // оплачиваемый заказ
        return $json_data;
    }

    function getIkPaymentSystems()
    {
        $remote_url = 'https://api.interkassa.com/v1/paysystem-input-payway?checkoutId=' . $this->merchantId;

        $json_data = $this->getData($this->apiId, $this->apiKey, $remote_url);

        if (empty($json_data))
            return '<strong style="color:red;">Error!!! System response empty!</strong>';

        if ($json_data->status != 'error') {
            $payment_systems = array();
            if (!empty($json_data->data)) {
                foreach ($json_data->data as $ps => $info) {
                    $payment_system = $info->ser;
                    if (!array_key_exists($payment_system, $payment_systems)) {
                        $payment_systems[$payment_system] = array();
                        foreach ($info->name as $name) {
                            if ($name->l == 'en') {
                                $payment_systems[$payment_system]['title'] = ucfirst($name->v);
                            }
                            $payment_systems[$payment_system]['name'][$name->l] = $name->v;
                        }
                    }
                    $payment_systems[$payment_system]['currency'][strtoupper($info->curAls)] = $info->als;
                }
            }
            return !empty($payment_systems) ? $payment_systems : '<strong style="color:red;">API connection error or system response empty!</strong>';
        } else {
            if (!empty($json_data->message))
                return '<strong style="color:red;">API connection error!<br>' . $json_data->message . '</strong>';
            else
                return '<strong style="color:red;">API connection error or system response empty!</strong>';
        }
    }
}