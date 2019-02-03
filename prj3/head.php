<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
	<title>课程信息更新</title>
	<style type="text/css">
	<!--
		.STYLE1 {font-size: 15px; font-family: "幼圆";}
	-->
	div{
		text-align:center;
		font-family:"幼圆";
		font-size:24px;
		font-weight:bold;
		color:"#008000";
	}
	table{
		width:300px;
	}
	</style>
</head>
<body background="bg.gif">
<div>课程表操作</div>
<form name="frm1" method="post">
	<table align="center">
		<tr>
			<td width="120"><span class="STYLE1">根据课程号查询:</span></td>
			<td>
				<input name="KCNumber" id="KCNumber" type="text" size="10">
				<input type="submit" name="test" class="STYLE1" value="查找">
			</td>
		</tr>
	</table>
    
</form>
<?php

class sql_conect
{
    public $user;
    public $password;
    public $sql="select * from kcb";
    private $con;
    function __construct($user,$password)
    {
        $this->user=$user;
        $this->password=$password;
        
    }
    function set_sql($sql)
    {
        $this->sql=$sql;
    }
    function querry_sql()
    {
        $conn=mysqli_connect("localhost:33060","$this->user","$this->password");
        $this->con=$conn;
        if(!$conn) echo "connnect faild<br/>";
        mysqli_select_db($conn,"pxscj");
        mysqli_query($conn,'set names utf8');
        $res=mysqli_query($conn,$this->sql);
        
        return $res;
          
    }
    function get_con()
    {
        return $this->con;
    }
}
						 
$KCNumber=@$_POST['KCNumber'];
									//获取课程号
$t=new sql_conect("root","123456");

$sql="select * from KCB where 课程号='$KCNumber'";	
$t->set_sql($sql);			//查找课程信息
$result=$t->querry_sql();
//print_r($result);	
$row=@mysqli_fetch_array($result,MYSQLI_ASSOC);								//取得查询结果
if(($KCNumber!==NULL)&&(!$row))									//判断课程是否存在
	echo "<script>alert('没有该课程信息！')</script>";

?>
<form name="frm2" method="post">
	<table bgcolor="#CCCCCC" border="1" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td bgcolor="#CCCCCC" width="90"><span class="STYLE1">课程号:</span></td>
			<td>
				<input name="KCNum" type="text" class="STYLE1" value="<?php echo $row['课程号']; ?>">
				<input name="h_KCNum" type="hidden" value="<?php echo $row['课程号']; ?>">
			</td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC" width="90"><span class="STYLE1">课程名:</span></td>
			<td><input name="KCName" type="text" class="STYLE1"	value="<?php echo $row['课程名']; ?>"></td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC"><span class="STYLE1">开课学期:</span></td>
			<td><input name="KCTerm" type="text" class="STYLE1"	value="<?php echo $row['开课学期']; ?>"></td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC"><span class="STYLE1">学时:</span></td>
			<td><input name="KCtime" type="text" class="STYLE1"	value="<?php echo $row['学时']?>"></td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC"><span class="STYLE1">学分:</span></td>
			<td><input name="KCCredit" type="text" class="STYLE1" value="<?php echo $row['学分'];?>"></td>
		</tr>
		<tr>
			<td align="center" colspan="2" bgcolor="#CCCCCC">
				<input name="b" type="submit" value="修改" class="STYLE1">&nbsp;
				<input name="b" type="submit" value="添加" class="STYLE1"/>&nbsp;
				<input name="b" type="submit" value="删除" class="STYLE1">&nbsp;
			</td>
		</tr>
        <tr><td colspan="2">
        <a href="xsb.php"> 学生信息管理链接</a></td></tr>
        <tr><td colspan="2">
        <a href="www.php"> 智能查询链接</a></td></tr>
        <tr><td colspan="2">
        <a href="csvtojsb.php"> 批量导入课程信息链接</a></td></tr>
        <tr><td colspan="2">
        <a href="file.php"> 批量导入学生信息链接</a></td></tr>
	</table>
</form>
</body>
</html>
<?php
 echo"</br><a href=\"choose.php\">回到登录界面</a>"; 
$KCH=@$_POST['KCNum'];							//课程号
$h_KCH=@$_POST['h_KCNum'];						//表单中原有的隐藏文本中的课程号
$KCM=@$_POST['KCName'];							//课程名
$KKXQ=@$_POST['KCTerm'];						//开课学期
$XS=@$_POST['KCtime'];							//学时
$XF=@$_POST['KCCredit'];						//学分
//简单的验证函数，验证表单数据的正确性
function test($KCH,$KCM,$KKXQ,$XF)
{
	if(!$KCH)									//判断课程号是否为空
		echo "<script>alert('课程号不能为空!');location.href='head.php';</script>";
   	elseif(!$KCM)								//判断课程名是否为空
   		echo "<script>alert('课程名不能为空!');location.href='head.php';</script>";
   	elseif($KKXQ>8||$KKXQ<1)					//判断开课学期是否在1-8之间
       	echo "<script>alert('开课学期必须为1-8的数字!');location.href='head.php';</script>";
   	elseif(!is_numeric($XF))					//判断学分是否为数字
       	echo "<script>alert('学分必须为数字!');location.href='head.php';</script>";
}
//单击【修改】按钮
if(@$_POST["b"]=='修改')									
{    
	test($KCH,$KCM,$KKXQ,$XF);					//检查输入信息
	if($KCH!=$h_KCH)							//判断用户是否修改了原来的课程号值
		echo "<script>alert('课程号与原数据有异，无法修改!');</script>";
	else
	{						  	
		$update_sql="update KCB set 课程名='$KCM',开课学期=$KKXQ,学时=$XS,学分=$XF WHERE 课程号='$KCH'";		
									//获取课程号
    $t=new sql_conect("root","123456");    	
    $t->set_sql($update_sql);			//查找课程信息
    $result=$t->querry_sql();
        //$update_result=mysql_query($update_sql);
        						
     	if(mysqli_affected_rows($t->get_con())!=0)
			echo "<script>alert('修改成功!');</script>";
		else
			echo "<script>alert('信息未修改!');</script>";
	}
}
//单击【添加】按钮
if(@$_POST["b"]=='添加')						
{
	test($KCH,$KCM,$KKXQ,$XF);	
    
    $t=new sql_conect("root","123456");    	
    			 
   
    				
	$s_sql="select 课程号 from KCB where 课程号='$KCH'";
    $t->set_sql($s_sql);	
    $result=$t->querry_sql();
	$s_row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($s_row)									//若要添加的课程已经存在则提示
		echo "<script>alert('课程已存在，无法添加!');</script>";
	else
	{
		$insert_sql="insert into KCB(课程号,课程名,开课学期,学时,学分) values('$KCH', '$KCM', $KKXQ, $XS, $XF)";
	
        $t->set_sql($insert_sql) ;
       	$insert_result=$t->querry_sql();
            
		if(mysqli_affected_rows($t->get_con())!=0){
     	 	echo "<script>alert('添加成功!');</script>";
              }else  	echo "<script>alert('添加不成功!');</script>";
	}
}
//单击【删除】按钮
if(@$_POST["b"]=='删除')						
{
	if(!$KCH)
	{
		echo "<script>alert('请输入要删除的课程号!');</script>";
	}
	else
	{
		$d_sql="select 课程号 from KCB where 课程号='$KCH'";	
		$t=new sql_conect("root","123456");    	
        $t->set_sql($d_sql);
        
        $d_result=$t->querry_sql();	
		$d_row=mysqli_fetch_array($d_result,MYSQLI_ASSOC);
		if(!$d_row)								//课程如果不存在则提示
			echo "<script>alert('课程号不存在，无法删除!');</script>";
		else
		{
			$del_sql="delete from KCB where 课程号='$KCH'";
            $t->set_sql($del_sql);
			$del_result=$t->querry_sql();
			if(mysqli_affected_rows($t->get_con())!=0)
				echo "<script>alert('删除课程".$KCH."成功!');</script>";
		}
	}
}
?>
