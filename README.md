# H-script

<<<<<<< HEAD
# ���������:
1) lib/ - �������� ����� interkassa
=======
# Установка:
1) lib/ - добавить папку interkassa
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

2) images/ - добавить папку interkassa-img

3) css/ - добавить interkassa.css

<<<<<<< HEAD
4) lib/psys.php - ������ ��������������� ��������� � �������:

- getCIDs() - �������� ��� � �������� "RUB" �� ������ �����
=======
4) lib/psys.php - внести соответствующие изменения в функции:

- getCIDs() - добавить код и заменить "RUB" на валюту кассы
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

```php
'IK' => array('InterKassa', 'RUB', 1, 0, 'RUB', 'ik_inv_st'),
```
<<<<<<< HEAD
- getPayFields() - ������ case 'IK':

- getSCIFields() - ��������
=======
- getPayFields() - убрать case 'IK':

- getSCIFields() - добавить
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

```php
    case 'IK':
	return array(
<<<<<<< HEAD
		'apiId' => array('User ID - Id ������������', '', '������ � ������ ��������, ������ API'),
		'apiKey' => array('Key - ���� Api', '', '������ � ������ ��������, ������ API'),
		'merchantId' => array('Checkout ID - ������������� �����', '', '������ �� �������� ����� �����'),
		'secretKey' => array('Secret Key', '', '������ �� �������� �������� ����� �����'),
		'testKey' => array('�������� ����', '', '������ �� �������� �������� ����� �����'),
		'testMode'=>array('������������ �������� �����','','Y-��, N-���'),
		'enabledAPI'=>array('������������ API','','Y-��, N-���')
		);
```

- prepareSCI() - ��������
=======
		'apiId' => array('User ID - Id пользователя', '', 'Указан в Личном кабинете, раздел API'),
		'apiKey' => array('Key - Ключ Api', '', 'Указан в Личном кабинете, раздел API'),
		'merchantId' => array('Checkout ID - индетификатор кассы', '', 'Указан на странице Вашей кассы'),
		'secretKey' => array('Secret Key', '', 'Указан на странице настроек Вашей кассы'),
		'testKey' => array('Тестовый ключ', '', 'Указан на странице настроек Вашей кассы'),
		'testMode'=>array('Использовать тестовый режим','','Y-да, N-нет'),
		'enabledAPI'=>array('Использовать API','','Y-да, N-нет')
		);
```

- prepareSCI() - добавить
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

```php
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
```
<<<<<<< HEAD

- chkSCI() - ��������

=======

- chkSCI() - добавить

>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d
```php
case 'IK':
	$r = array(
                'ik_co_id' => $arr['ik_co_id'],
                'batch' => $arr['ik_inv_id'],
                'ik_inv_st' => $arr['ik_inv_st'],
                'tag' => $arr['ik_pm_no'],
                'correct' => true
	);
        return $r;
```

<<<<<<< HEAD
# ��������� � �����.������
1) ������ ���������� - ��������� ������� - �������� - interkassa
2) ������ ������ ����� � ��������
3) � ����� "����������" ������� "�����" - "����� �������"

5bd2effa3b1eafbe508b456c
abJqFcXDc9GMU5UL
h42b7xAbQTnvGBA2
5bd2ed2e3c1eaf743c8b4568
j6liXicYuDS76NyWDyJjVYRt6kBnkISU
5d7d74b41ae1bd15008b4569
Smqvd9nJuKf5dhbiZx6ce7UDuIalpXpu
5d7d74fe1ae1bd9b6a8b4567
27b07lDHJH0eYp12
=======
# Настройка в админ.панели
1) Панель управления - Платежные системы - Добавить - interkassa
2) Ввести данные кассы и кошелька
3) В блоке "Пополнение" выбрать "Режим" - "через мерчант"
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d
