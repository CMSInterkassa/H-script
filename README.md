# H-script

���������:
1) lib/ - �������� ����� interkassa

2) images/ - �������� ����� interkassa-img

3) css/ - �������� interkassa.css

4)lib/psys.php

- getCIDs() - ��������, "RUB" �������� �� ������ �����
		'IK' => array('InterKassa', 'RUB', 1, 0, 'RUB', 'ik_inv_st'),

- getPayFields() - ������ case 'IK':

- getSCIFields() - ��������
case 'IK':
	return array(
        	'apiId' => array('User ID - Id ������������', '', '������ � ������ ��������, ������ API'),
                'apiKey' => array('Key - ���� Api', '', '������ � ������ ��������, ������ API'),
                'merchantId' => array('Checkout ID - ������������� �����', '', '������ �� �������� ����� �����'),
                'secretKey' => array('Secret Key', '', '������ �� �������� �������� ����� �����'),
                'testKey' => array('�������� ����', '', '������ �� �������� �������� ����� �����'),
                'testMode'=>array('������������ �������� �����','','Y-��, N-���'),
                'enabledAPI'=>array('������������ API','','Y-��, N-���')
	);

- prepareSCI() - ��������
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

- chkSCI() - ��������
case 'IK':
	$r = array(
                'ik_co_id' => $arr['ik_co_id'],
                'batch' => $arr['ik_inv_id'],
                'ik_inv_st' => $arr['ik_inv_st'],
                'tag' => $arr['ik_pm_no'],
                'correct' => true
	);
        return $r;


��������� � �����.������
1) ������ ���������� - ��������� ������� - �������� - interkassa
2) ������ ������ ����� � ��������
3) � ����� "����������" ������� "�����" - "����� �������"