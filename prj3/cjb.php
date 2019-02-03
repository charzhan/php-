<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
	<title>学信息更新</title>
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
<div>学生表操作</div>
<form name="frm1" method="post">
	<table align="center">
		<tr>
			<td width="120"><span class="STYLE1">根据课程号查询:</span></td>
			<td>
				<input name="ID" id="ID" type="text" size="10">
				<input type="submit" name="test" class="STYLE1" value="查找">
			</td>
		</tr>
	</table>
</form>
</body>
<?php
class sql_conect
{
    private $user;
    private $password;
    public $sql="select * from   cjb";
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
						 
$ID=@$_POST['ID'];
									//获取学号
$t=new sql_conect("teacher","teacher");

$sql="select * from   cjb where 学号='$ID'";	
$t->set_sql($sql);			//查找学信息
$result=$t->querry_sql();
//print_r($result);	
$row=@mysqli_fetch_array($result,MYSQLI_ASSOC);								//取得查询结果
if(($ID!==NULL)&&(!$row))									//判断学是否存在
	echo "<script>alert('没有该学生成绩信息！')</script>";

?>
<form name="frm2" method="post">
	<table bgcolor="#CCCCCC" border="1" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td bgcolor="#CCCCCC" width="90"><span class="STYLE1">学号:</span></td>
			<td>
				<input name="sid" type="text" class="STYLE1" value="<?php echo $row['学号']; ?>">
				<input name="h_sid" type="hidden" value="<?php echo $row['学号']; ?>">
			</td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC" width="90"><span class="STYLE1">课程号:</span></td>
			<td>
				<input name="skc" type="text" class="STYLE1" value="<?php echo $row['课程号']; ?>">
				<input name="h_skc" type="hidden" value="<?php echo $row['课程号']; ?>">
			</td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC"><span class="STYLE1">成绩:</span></td>
			<td><input name="cj" type="text" class="STYLE1"	value="<?php echo $row['成绩']; ?>"></td>
		</tr>
		
		<tr>
			<td align="center" colspan="2" bgcolor="#CCCCCC">
				<input name="b" type="submit" value="修改" class="STYLE1">&nbsp;
				<input name="b" type="submit" value="添加" class="STYLE1"/>&nbsp;
				<input name="b" type="submit" value="删除" class="STYLE1">&nbsp;
			</td>
		</tr>
        <tr><td colspan="2">
        <a href="head.php"> 课程信息管理链接</a></td></tr>
	</table>
</form>
</body>
</html>
<?php
$id=@$_POST['sid'];							//学号
$h_sid=@$_POST['h_sid'];						//表单中原有的隐藏文本中的学号
$kc=@$_POST['skc'];
$h_kc=@$_POST['h_skc'];							//学名;
$cj=@$_POST['cj'];
 
//简单的验证函数，验证表单数据的正确性
function test($id,$kc,$cj)
{
	if(!$id)									//判断学号是否为空
		echo "<script>alert('学号不能为空!');location.href='cjb.php';</script>";
   	elseif(!$kc)								//判断学名是否为空
   		echo "<script>alert('学名不能为空!');location.href='cjb.php';</script>";
   	elseif(!$cj)					//判断性别是否在1-8之间
       	echo "<script>alert('性别必须为数字!');location.href='cjb.php';</script>";
   
}
//单击【修改】按钮
if(@$_POST["b"]=='修改')									
{    
	test($id,$kc,$cj);					//检查输入信息
	if($id!=$h_sid)							//判断用户是否修改了原来的学号值
		echo "<script>alert('学号与原数据有异，无法修改!');</script>";
	else
	{						  	
		$update_sql="update   cjb set 姓名='$kc',课程号='$kc' WHERE 学号='$id'";		
		//echo $update_sql;							//获取学号
    $t=new sql_conect("teacher","teacher");    	
    $t->set_sql($update_sql);			//查找学信息
    $result=$t->querry_sql();
    print_r($result);
        //$update_result=mysql_query($update_sql);
        						
     	if(mysqli_affected_rows($t->get_con())>0)
			echo "<script>alert('修改成功!');</script>";
		else
			echo "<script>alert('信息未修改!');</script>";
	}
}
//单击【添加】按钮
if(@$_POST["b"]=='添加')						
{
	test($id,$kc,$cj );	
    
    $t=new sql_conect("teacher","teacher");    	
    			 
   
    				
	$s_sql="select 课程号 from   cjb where 课程号='$kc'";
    $t->set_sql($s_sql);	
    $result=$t->querry_sql();
	$s_row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if($s_row)									//若要添加的学已经存在则提示
		echo "<script>alert('学号已存在，无法添加!');</script>";
	else
	{
		$insert_sql="insert into   cjb values('$id', '$kc', '$cj', ' ', '$zy','$XF','$bz')";
	
        $t->set_sql($insert_sql) ;
       	$insert_result=$t->querry_sql();
            
		if(mysqli_affected_rows($t->get_con())>0){
     	 	echo "<script>alert('添加成功!');</script>";
              }else  	echo "<script>alert('添加不成功!');</script>";
	}
}
//单击【删除】按钮
if(@$_POST["b"]=='删除')						
{
	if(!$id)
	{
		echo "<script>alert('请输入要删除的学号!');</script>";
	}
	else
	{
		$d_sql="select 学号 from   cjb where 学号='$id'";	
		$t=new sql_conect("teacher","teacher");    	
        $t->set_sql($d_sql);
        
        $d_result=$t->querry_sql();	
		$d_row=mysqli_fetch_array($d_result,MYSQLI_ASSOC);
		if(!$d_row)								//学如果不存在则提示
			echo "<script>alert('学号不存在，无法删除!');</script>";
		else
		{
			$del_sql="delete from   cjb where 学号='$id'";
            $t->set_sql($del_sql);
			$del_result=$t->querry_sql();
			if(mysqli_affected_rows($t->get_con())!=0)
				echo "<script>alert('删除学号".$id."成功!');</script>";
		}
	}
}
?>
