// by MoreWindows( http://blog.csdn.net/MoreWindows )
//���峣��
define(DB_HOST, 'localhost');
define(DB_USER, 'root');
define(DB_PASS, '111111');
define(DB_DATABASENAME, 'test');
define(DB_TABLENAME, 't_student');
//���ݿ�������
$dbcolarray = array('id', 'name', 'age');

//mysql_connect
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("connect failed" . mysql_error());
mysql_select_db(DB_DATABASENAME, $conn);

//��ȡ���м�¼����
$sql = sprintf("select count(*) from %s", DB_TABLENAME);
$result = mysql_query($sql, $conn);
if ($result)
{
	$count = mysql_fetch_row($result);
}
else
{
	die("query failed");
}
echo "������$count[0] ����¼<br />";


$sql = sprintf("select %s from %s", implode(",",$dbcolarray), DB_TABLENAME);
$result = mysql_query($sql, $conn);
//���
echo '<table id="Table" border=1 cellpadding=10 cellspacing=2 bordercolor=#ffaaoo>'; 
//��ͷ
$thstr = "<th>" . implode("</th><th>", $dbcolarray) . "</th>";
echo $thstr;
//���е�����
while ($row=mysql_fetch_array($result, MYSQL_ASSOC))//��$row=mysql_fetch_assoc($result)�ȼ�
{
	echo "<tr>";
	$tdstr = "";
	foreach ($dbcolarray as $td)
		$tdstr .= "<td>$row[$td]</td>";
	echo $tdstr;
	echo "</tr>";
}
echo "</table>";
mysql_free_result($result);
mysql_close($conn);