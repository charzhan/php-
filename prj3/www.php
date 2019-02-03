
<!DOCTYPE html>
<html>
<head>
	<title>搜索</title>
	
</head>
<body  background="bg.gif"> 
<form   method="post">
	<table border="0">
		<tr>
			
		</tr>
	
			<td>请输入专业：<input name="Search_MAJOR" type="text"></td>
		</tr>
         <tr>
			<td>请输入课程名：<input name="Search_COURSE" type="text"></td>
		</tr>
        <tr>
			<td>请输入课程号：<input name="Search_COURSENum" type="text"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="Submit" value="搜索">
			</td>
		</tr>
	</table>
</form>
</body>
<html>

<?php
if(isset($_POST['Submit']))
{

 	
$major = $_POST['Search_MAJOR'];
echo $major;
$course = $_POST['Search_COURSE'];
echo $course;
$coursenum = $_POST['Search_COURSENum'];
echo $coursenum;
if($major!=null)//关于专业的查询
{
if($major == 'all' or $major == 'All' or $major == 'ALL')
{
$conn=@mysql_connect('localhost:33060','looking','') or die('连接失败');
mysql_select_db('PXSCJ', $conn) or die('选择数据库失败');
mysql_query("SET NAMES utf-8");
$sql="SELECT * FROM XSB;";
$result=mysql_query($sql);
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>姓名</td><td>性别</td><td>出生时间</td><td>专业</td><td>总学分</td><td>备注</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$XM,$XB,$CSSJ,$ZY,$ZXF,$BZ)=$row;
	echo "<tr><td>$XH</td><td>$XM</td><td>$XB</td><td>$CSSJ</td><td>$ZY</td><td>$ZXF</td><td>$BZ</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";
echo"<br />";
    
    
}    
else
{   
$conn=@mysql_connect('localhost:33060','looking','') or die('连接失败');
mysql_select_db('PXSCJ', $conn) or die('选择数据库失败');
mysql_query("SET NAMES utf-8");
$sql="SELECT xsb.学号,xsb.姓名,xsb.性别,xsb.专业,xsb.总学分 FROM XSB,cjb,kcb WHERE  xsb.专业 LIKE '%$major%' GROUP BY xsb.学号 ORDER BY xsb.学号; ";
$result=mysql_query($sql);
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>姓名</td><td>性别</td><td>专业</td><td>总学分</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$XM,$XB,$ZY,$ZXF)=$row;
	echo "<tr><td>$XH</td><td>$XM</td><td>$XB</td><td>$ZY</td><td>$ZXF</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";
echo"<br />";
$sql="SELECT xsb.学号,姓名,kcb.课程号,kcb.课程名,学分,cjb.成绩 FROM XSB,cjb,kcb WHERE xsb.学号=cjb.学号 AND kcb.课程号 = cjb.课程号 AND xsb.专业 LIKE '%$major%'  ORDER BY xsb.学号; ";
$result=mysql_query($sql);
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>姓名</td><td>课程号</td><td>课程名</td><td>学分</td><td>成绩</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$XM,$KCH,$KCM,$XF,$CJ)=$row;
	echo "<tr><td>$XH</td><td>$XM</td><td>$KCH</td><td>$KCM</td><td>$XF</td><td>$CJ</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";


$sql="SELECT xsb.学号,AVG(cjb.成绩),SUM(kcb.学分) FROM XSB,cjb,kcb WHERE xsb.学号=cjb.学号 AND kcb.课程号 = cjb.课程号 AND cjb.成绩 > 59 AND xsb.专业 LIKE '%$major%' GROUP BY cjb.学号 ORDER BY xsb.学号; ";
$result=mysql_query($sql);
echo"<br />";
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>平均成绩</td><td>成绩总学分</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$PJCJ,$CJZXF)=$row;
	echo "<tr><td>$XH</td><td>$PJCJ</td><td>$CJZXF</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";
}
}



if($course!=null)//关于课程名的查询
{    
$conn=@mysql_connect('localhost:33060','looking','') or die('连接失败');
mysql_select_db('PXSCJ', $conn) or die('选择数据库失败');
mysql_query("SET NAMES utf-8");
$sql="SELECT xsb.学号,xsb.姓名,xsb.性别,xsb.专业,xsb.总学分 ,cjb.成绩 FROM cjb,xsb,kcb 
WHERE xsb.学号=cjb.学号 AND cjb.课程号=kcb.课程号 AND kcb.课程名 LIKE '%$course%' ORDER BY xsb.专业 DESC,xsb.学号;";
$result=mysql_query($sql);
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>姓名</td><td>性别</td><td>专业</td><td>总学分</td><td>成绩表成绩</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$XM,$XB,$ZY,$ZXF,$CJBCJ)=$row;
	echo "<tr><td>$XH</td><td>$XM</td><td>$XB</td><td>$ZY</td><td>$ZXF</td><td>$CJBCJ</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";
echo"<br />";

}


if($coursenum!=null)//关于课程号的查询
{    
$conn=@mysql_connect('localhost:33060','looking','') or die('连接失败');
mysql_select_db('PXSCJ', $conn) or die('选择数据库失败');
mysql_query("SET NAMES utf-8");
$sql="SELECT xsb.学号,xsb.姓名,xsb.性别,xsb.专业,xsb.总学分 ,cjb.成绩 FROM cjb,xsb,kcb 
WHERE xsb.学号=cjb.学号 AND cjb.课程号=kcb.课程号 AND kcb.课程号 LIKE '%$coursenum%' ORDER BY xsb.专业 DESC,xsb.学号;";
$result=mysql_query($sql);
//echo $sql;
echo "<table border=1>";
echo "<tr><td>学号</td><td>姓名</td><td>性别</td><td>专业</td><td>总学分</td><td>成绩表成绩</td></tr>";
while($row=@mysql_fetch_row($result))
{
	list($XH,$XM,$XB,$ZY,$ZXF,$CJBCJ)=$row;
	echo "<tr><td>$XH</td><td>$XM</td><td>$XB</td><td>$ZY</td><td>$ZXF</td><td>$CJBCJ</td></tr>";
    //print_r($row);
}
//print_r($result);
echo "</table>";
echo"<br />";

}
}
?>   