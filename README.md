# H-script

Установка:
1) lib/ - добавить папку interkassa

2) images/ - добавить папку interkassa-img

3) css/ - добавить interkassa.css

4)lib/psys.php

- getCIDs() - добавить, "RUB" заменить на валюту кассы
		'IK' => array('InterKassa', 'RUB', 1, 0, 'RUB', 'ik_inv_st'),

- getPayFields() - убрать case 'IK':

- getSCIFields() - добавить
case 'IK':
	return array(
        	'apiId' => array('User ID - Id пользователя', '', 'Указан в Личном кабинете, раздел API'),
                'apiKey' => array('Key - Ключ Api', '', 'Указан в Личном кабинете, раздел API'),
                'merchantId' => array('Checkout ID - индетификатор кассы', '', 'Указан на странице Вашей кассы'),
                'secretKey' => array('Secret Key', '', 'Указан на странице настроек Вашей кассы'),
                'testKey' => array('Тестовый ключ', '', 'Указан на странице настроек Вашей кассы'),
                'testMode'=>array('Использовать тестовый режим','','Y-да, N-нет'),
                'enabledAPI'=>array('Использовать API','','Y-да, N-нет')
	);

- prepareSCI() - добавить
case 'IK':
	require_once('interkassa/interkassa.class.php');
        $Interkassa = new Interkassa($params2);
        if (!empty($_POST['ik_inv_st']) && $_POST['ik_inv_st'] == 'success') {
        	require_once('lib/inet.php');
                inet_request(fullURL(moduleToLink('balance/status'), false), $_POST);
                header('Location:' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/operation?id=' . $tag);
        } elseif (!empty($_POST['ik_sign'])) {
                echo $Interkassa->ajaxSign_generate();
                exit;
        } else return $Interkassa->generate_form($tag, $sum, $memo, $c[4], $urlok, $urlfail, $urlproc);

- chkSCI() - добавить
case 'IK':
	$r = array(
                'ik_co_id' => $arr['ik_co_id'],
                'batch' => $arr['ik_inv_id'],
                'ik_inv_st' => $arr['ik_inv_st'],
                'tag' => $arr['ik_pm_no'],
                'correct' => true
	);
        return $r;


Настройка в админ.панели
1) Панель управления - Платежные системы - Добавить - interkassa
2) Ввести данные кассы и кошелька
3) В блоке "Пополнение" выбрать "Режим" - "через мерчант"