<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
error_reporting(E_ALL);

ini_set("display_errors", 1);
$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$member_id = $_GET["d_ID"];

mysqli_query($conn, 'set autocommit = 0');
mysqli_query($conn, 'set transaction isolation level read uncommitted');
mysqli_query($conn, 'begin');

$ret = mysqli_query($conn, "delete from member where member_id = '$member_id'");

if(!$ret)
{
	mysqli_query($conn, "rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{	
	mysqli_query($conn, "commit");
    s_msg ('GOOD BYE');
    echo "<meta http-equiv='refresh' content='0;url=logout.php'>";
}

?>