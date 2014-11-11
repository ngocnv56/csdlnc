<?php
include ('html_lib.php');
$con = mysql_connect('localhost', 'root', '123') or die('Khong ket noi duoc');
mysql_select_db('test',$con) or die('khong select duoc db');
echo formOpen();
echo tableOpen('80%', '0');
echo td('Quantity:',$width='4').td(textbox('qt',$qt,$size='6'),$width='4').
td( '<select name="op" size = "1">
     <option value="0">Random</option>
      <option value="1">First</option>
      <option value="2">Last</option>
    </select>',$width='4').
	td(cmd('ok'));
echo tableClose();
$msc = microtime(true);
if(isset($cmd)){
	if ($cmd = 'ok'){
		if($op == 0){
			$re = mysql_query('SELECT * FROM student AS r1 JOIN (SELECT (RAND() * (
			SELECT MAX(id) FROM student)) AS ids) AS r2 
			WHERE r1.id >= r2.ids ORDER BY r1.id ASC LIMIT '.$qt);		
		}
		if($op == 1){
			$re = mysql_query("select * from student limit ".$qt);
		}
		if($op == 2){
		$re = mysql_query('SELECT * FROM (SELECT * FROM student ORDER BY id DESC LIMIT '.$qt.') sub
		ORDER BY id ASC');
		}
		
	}
}

echo "--------------------------------------------
-------------------------------------------------------------------";
echo tableOpen('80%', '1');
echo tr(td('ID').td('Name').td('Email').td('Birthday').td('Address'));

while($r = mysql_fetch_array($re)){
	echo tr(td($r['id']).td($r['fullname']).td($r['email']).td($r['birthday']).td($r['address']));
}
$msc = microtime(true)-$msc;
echo tableClose();
echo formClose();
echo htopen();
echo 'TIME EXCUTE:  '.$msc. ' seconds';
echo htClose();
?>

