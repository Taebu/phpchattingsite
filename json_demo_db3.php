<?php
header("Content-Type: application/json; charset=UTF-8");
//�ش�("���� ���� : json������ �������α׷�; ���� UTF-8 ���ڵ�");
$obj = json_decode($_GET["content"], false);
//obj�� json���� ���ڵ�(x���� ���, false�� �ؾ� ȭ�鿡 ���� ǥ�����ݴϴ�.);
//(���ڵ��̶� ��ȣȭ�� �����͸� ��ȣȭ�Ǳ� ������ �ǵ����� ����)
$conn = new mysqli("localhost", "root", "1234", "test");
//conn�� mysqli�� �����Ѵ�. (localhost���, ����� ���̵�, ��й�ȣ, db�̸�);
mysqli_query ($conn, 'SET NAMES utf8');
//mysqli_query utf8 ����
$chatpassword = addslashes($obj->chatpassword);
//�������ø� ���� ���¿��� ��й�ȣ ������ $chatpassword�� ������
$stmt = $conn->prepare("DELETE FROM $obj->table WHERE num='$obj->num' AND chatpassword='$chatpassword'");
//DB������ �Է�(��ȣ�� ��й�ȣ�� ��ġ�ϴ� tableforchat ���̺� ��� ������ ������)
$stmt->execute();
//stmt ����
$result = $stmt->get_result();
//stmt�κ��� ����� ���, result�� ����
$outp = $result->fetch_all(MYSQLI_ASSOC);
//��� = ������� �� ��� ��ġ�ؼ� ����
echo json_encode($outp);
//json ���ڵ�(outp). echo�� �ϳ� �̻��� ���ڿ��� ����Ѵ�.
?>