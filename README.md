# H-script

<<<<<<< HEAD
# Óñòàíîâêà:
1) lib/ - äîáàâèòü ïàïêó interkassa
=======
# Ð£ÑÑ‚Ð°Ð½Ð¾Ð²ÐºÐ°:
1) lib/ - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ Ð¿Ð°Ð¿ÐºÑƒ interkassa
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

2) images/ - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ Ð¿Ð°Ð¿ÐºÑƒ interkassa-img

3) css/ - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ interkassa.css

<<<<<<< HEAD
4) lib/psys.php - âíåñòè ñîîòâåòñòâóþùèå èçìåíåíèÿ â ôóíêöèè:

- getCIDs() - äîáàâèòü êîä è çàìåíèòü "RUB" íà âàëþòó êàññû
=======
4) lib/psys.php - Ð²Ð½ÐµÑÑ‚Ð¸ ÑÐ¾Ð¾Ñ‚Ð²ÐµÑ‚ÑÑ‚Ð²ÑƒÑŽÑ‰Ð¸Ðµ Ð¸Ð·Ð¼ÐµÐ½ÐµÐ½Ð¸Ñ Ð² Ñ„ÑƒÐ½ÐºÑ†Ð¸Ð¸:

- getCIDs() - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ ÐºÐ¾Ð´ Ð¸ Ð·Ð°Ð¼ÐµÐ½Ð¸Ñ‚ÑŒ "RUB" Ð½Ð° Ð²Ð°Ð»ÑŽÑ‚Ñƒ ÐºÐ°ÑÑÑ‹
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

```php
'IK' => array('InterKassa', 'RUB', 1, 0, 'RUB', 'ik_inv_st'),
```
<<<<<<< HEAD
- getPayFields() - óáðàòü case 'IK':

- getSCIFields() - äîáàâèòü
=======
- getPayFields() - ÑƒÐ±Ñ€Ð°Ñ‚ÑŒ case 'IK':

- getSCIFields() - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d

```php
    case 'IK':
	return array(
<<<<<<< HEAD
		'apiId' => array('User ID - Id ïîëüçîâàòåëÿ', '', 'Óêàçàí â Ëè÷íîì êàáèíåòå, ðàçäåë API'),
		'apiKey' => array('Key - Êëþ÷ Api', '', 'Óêàçàí â Ëè÷íîì êàáèíåòå, ðàçäåë API'),
		'merchantId' => array('Checkout ID - èíäåòèôèêàòîð êàññû', '', 'Óêàçàí íà ñòðàíèöå Âàøåé êàññû'),
		'secretKey' => array('Secret Key', '', 'Óêàçàí íà ñòðàíèöå íàñòðîåê Âàøåé êàññû'),
		'testKey' => array('Òåñòîâûé êëþ÷', '', 'Óêàçàí íà ñòðàíèöå íàñòðîåê Âàøåé êàññû'),
		'testMode'=>array('Èñïîëüçîâàòü òåñòîâûé ðåæèì','','Y-äà, N-íåò'),
		'enabledAPI'=>array('Èñïîëüçîâàòü API','','Y-äà, N-íåò')
		);
```

- prepareSCI() - äîáàâèòü
=======
		'apiId' => array('User ID - Id Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ', '', 'Ð£ÐºÐ°Ð·Ð°Ð½ Ð² Ð›Ð¸Ñ‡Ð½Ð¾Ð¼ ÐºÐ°Ð±Ð¸Ð½ÐµÑ‚Ðµ, Ñ€Ð°Ð·Ð´ÐµÐ» API'),
		'apiKey' => array('Key - ÐšÐ»ÑŽÑ‡ Api', '', 'Ð£ÐºÐ°Ð·Ð°Ð½ Ð² Ð›Ð¸Ñ‡Ð½Ð¾Ð¼ ÐºÐ°Ð±Ð¸Ð½ÐµÑ‚Ðµ, Ñ€Ð°Ð·Ð´ÐµÐ» API'),
		'merchantId' => array('Checkout ID - Ð¸Ð½Ð´ÐµÑ‚Ð¸Ñ„Ð¸ÐºÐ°Ñ‚Ð¾Ñ€ ÐºÐ°ÑÑÑ‹', '', 'Ð£ÐºÐ°Ð·Ð°Ð½ Ð½Ð° ÑÑ‚Ñ€Ð°Ð½Ð¸Ñ†Ðµ Ð’Ð°ÑˆÐµÐ¹ ÐºÐ°ÑÑÑ‹'),
		'secretKey' => array('Secret Key', '', 'Ð£ÐºÐ°Ð·Ð°Ð½ Ð½Ð° ÑÑ‚Ñ€Ð°Ð½Ð¸Ñ†Ðµ Ð½Ð°ÑÑ‚Ñ€Ð¾ÐµÐº Ð’Ð°ÑˆÐµÐ¹ ÐºÐ°ÑÑÑ‹'),
		'testKey' => array('Ð¢ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ ÐºÐ»ÑŽÑ‡', '', 'Ð£ÐºÐ°Ð·Ð°Ð½ Ð½Ð° ÑÑ‚Ñ€Ð°Ð½Ð¸Ñ†Ðµ Ð½Ð°ÑÑ‚Ñ€Ð¾ÐµÐº Ð’Ð°ÑˆÐµÐ¹ ÐºÐ°ÑÑÑ‹'),
		'testMode'=>array('Ð˜ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÑŒ Ñ‚ÐµÑÑ‚Ð¾Ð²Ñ‹Ð¹ Ñ€ÐµÐ¶Ð¸Ð¼','','Y-Ð´Ð°, N-Ð½ÐµÑ‚'),
		'enabledAPI'=>array('Ð˜ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÑŒ API','','Y-Ð´Ð°, N-Ð½ÐµÑ‚')
		);
```

- prepareSCI() - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ
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

- chkSCI() - äîáàâèòü

=======

- chkSCI() - Ð´Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ

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
# Íàñòðîéêà â àäìèí.ïàíåëè
1) Ïàíåëü óïðàâëåíèÿ - Ïëàòåæíûå ñèñòåìû - Äîáàâèòü - interkassa
2) Ââåñòè äàííûå êàññû è êîøåëüêà
3) Â áëîêå "Ïîïîëíåíèå" âûáðàòü "Ðåæèì" - "÷åðåç ìåð÷àíò"

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
# ÐÐ°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ð² Ð°Ð´Ð¼Ð¸Ð½.Ð¿Ð°Ð½ÐµÐ»Ð¸
1) ÐŸÐ°Ð½ÐµÐ»ÑŒ ÑƒÐ¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ - ÐŸÐ»Ð°Ñ‚ÐµÐ¶Ð½Ñ‹Ðµ ÑÐ¸ÑÑ‚ÐµÐ¼Ñ‹ - Ð”Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ - interkassa
2) Ð’Ð²ÐµÑÑ‚Ð¸ Ð´Ð°Ð½Ð½Ñ‹Ðµ ÐºÐ°ÑÑÑ‹ Ð¸ ÐºÐ¾ÑˆÐµÐ»ÑŒÐºÐ°
3) Ð’ Ð±Ð»Ð¾ÐºÐµ "ÐŸÐ¾Ð¿Ð¾Ð»Ð½ÐµÐ½Ð¸Ðµ" Ð²Ñ‹Ð±Ñ€Ð°Ñ‚ÑŒ "Ð ÐµÐ¶Ð¸Ð¼" - "Ñ‡ÐµÑ€ÐµÐ· Ð¼ÐµÑ€Ñ‡Ð°Ð½Ñ‚"
>>>>>>> 1c785470bde87e16f8550b5d403296ff07284a4d
