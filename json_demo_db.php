<?php
header("Content-Type: application/json; charset=UTF-8");
//해더("내용 유형 : json형식의 응용프로그램; 문자 UTF-8 인코딩");
$obj = json_decode($_GET["content"], false);
//obj는 json형식 디코드(x정보 얻기, false로 해야 화면에 값을 표시해줍니다.);
//(디코딩이란 부호화된 데이터를 부호화되기 전으로 되돌림을 말함)
$conn = new mysqli("localhost", "root", "1234", "test");
//conn은 mysqli에 접속한다. (localhost경로, 사용자 아이디, 비밀번호, db이름);
mysqli_query ($conn, 'SET NAMES utf8');
//mysqli_query utf8 셋팅
$stmt = $conn->prepare("SELECT * FROM $obj->table");
//DB쿼리문 입력(tableforchat 테이블에 담긴 정보를 불러옴)
$stmt->execute();
//stmt 실행
$result = $stmt->get_result();
//stmt로부터 결과값 얻고, result에 저장
$outp = $result->fetch_all(MYSQLI_ASSOC);
//출력 = 결과값을 한 행식 패치해서 담음
echo json_encode($outp);
//json 인코드(outp). echo는 하나 이상의 문자열을 출력한다.
?>