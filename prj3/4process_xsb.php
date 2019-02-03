<html>
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
<form name="chaxun" method="post">
输入学号查询
<input  type="text" name="id"/>
<td ></td>
<input  type="submit" name="selid" value="查询"/>
</form>
<form name="chaxun" method="post">
输入课程号查询
<input  type="text" name="kc"/>

<input  type="submit" name="selname" value="查询"/>
</form>
<a href="csvtojsb.php">批量上传成绩入口</a>
</body>
</html>
<?php
session_start();
 
echo("<h1>欢迎".$_SESSION['username']."使用管理系统<h1></br>");
$connect=@mysqli_connect('localhost:33060','teacher','teacher');
mysqli_select_db($connect,'pxscj');
mysqli_query($connect,"SET NAMES 'utf-8'");
$sql="select *from xsb";
$res=mysqli_query($connect,$sql);
/**
 * htform
 * 
 * @package   
 * @author 
 * @copyright phpadmin
 * @version 2018
 * @access public
 */

class htform {
    function  h1form()
    {   
       echo "<form method='post'><table border=\"1\">
    <tr>
    <td>学号</td>
    <td>课程号</td>
    <td>成绩</td>
    
    <td colspan=\"2\">操作</td>
    </tr>
    <tr>
    <td> <input type=\"text\" name=\"aid\"/></td>
    <td> <input type=\"text\" name=\"akc\"/></td>
    <td> <input type=\"text\" name=\"acj\"/></td>
    
    <td colspan=\"2\"> <input type=\"submit\" name=\"add\" value=\"add\"/></td>
    </tr>  </form>"; 
    }
    function hform()
    {
        echo  "<form method='post'><table border=\"1\">
    <tr>
    <td>学号</td>
    <td>课程号</td>
    <td>成绩</td>
    
    <td colspan=\"2\">操作</td>
    </tr>
        ";
    }
    function testdata($id,$kc,$cj)
    {
        if(!$id)  echo "<script>alert('学号不能为空!');location.href='4process_xsb.php';</script>";
        if(!$kc)  echo "<script>alert('名字不能为空!');location.href='4process_xsb.php';</script>";
        if(!$cj)  echo "<script>alert('生日不能为空!');location.href='4process_xsb.php';</script>";
       // if(!$pro)  echo "<script>alert('专业不能为空!');location.href='4process_xsb.php';</script>";
        //if($gender!=0||$gender!=1 )  echo "<script>alert('性别只能是男1 女0!');location.href='4process_xsb.php';</script>";
        
    }
}

 function testselid($strid )
 {
    if(!$strid)
    echo "<script>alert('学号不能为空!');location.href='4process_xsb.php';</script>";
 }
 function testselname($kc)
 {
    if(!$kc)
    echo "<script>alert('课程号不能为空!');location.href='4process_xsb.php';</script>";
 }

if(isset($_POST['selid']))
{   
    $connect=@mysqli_connect('localhost:33060','teacher','teacher');
    mysqli_select_db($connect,'pxscj');
    mysqli_query($connect,"SET NAMES 'utf-8'");
    $strid=$_POST['id'];
    testselid($strid);
    echo "关键字".$strid;
    $res=mysqli_query($connect,"select * from cjb where 教师号='$_SESSION[username]'");
    $t=new htform;
         $t->h1form();
   
while( $row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
    //print_r($row);
    if(strstr($row['学号'],$strid))
    {
         
    $t->hform();
    echo "<td > <input type=\"text\" name=\" id\" value=\"$row[学号]\"/>";
   echo " <input type=\"hidden\" name=\"hid\"value=\"$row[学号]\"/></td>";
  
    echo "<td > <input type=\"text\" name=\" kc\" value=\"$row[课程号]\"/>";
   echo " <input type=\"hidden\" name=\"hkc\"value=\"$row[课程号]\"/></td>";
    echo "<td > <input type=\"text\" name=\" cj\"value=\"$row[成绩]\"/>";
    echo "<td > <input type=\"submit\" value=\"修改\"name=\"update\"</td>";
    echo "<td > <input type=\"submit\" value=\"删除\"name=\"del\"</td></tr>";
     echo "</table></form>";
    }
    }
   

}
if(isset($_POST['selname']))
{       
     
    $sql="select *from cjb where 教师号='$_SESSION[username]'";
    //echo $sql;
    $connect=@mysqli_connect('localhost:33060','root','123456');
    mysqli_select_db($connect,'pxscj');
    mysqli_query($connect,"SET NAMES 'utf-8'");
     $res=mysqli_query($connect,$sql);
    $strname=$_POST['kc'];
     $t =new htform;
    $t->h1form();
    testselname($strname);
while( $row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
    if(strstr($row['课程号'],$strname))
    {$t->hform();
    //$strname=$_POST['k'];
       echo "<td > <input type=\"text\" name=\" id\" value=\"$row[学号]\"/>";
   echo " <input type=\"hidden\" name=\"hid\"value=\"$row[学号]\"/></td>";
  
    echo "<td > <input type=\"text\" name=\" kc\" value=\"$row[课程号]\"/>";
    echo " <input type=\"hidden\" name=\"hkc\"value=\"$row[课程号]\"/></td>";
    echo "<td > <input type=\"text\" name=\"cj\"value=\"$row[成绩]\"/>";
    echo "<td > <input type=\"submit\" value=\"修改\"name=\"update\"</td>";
    echo "<td > <input type=\"submit\" value=\"删除\"name=\"del\"</td></tr>";
     echo "</table></form>";
    }
    }
   

}
if(!$connect) echo("error!");

if(isset($_POST['add']))
{ 
    $id=$_POST['aid'];
    $kc=$_POST['akc'];
    $cj=$_POST['acj'];
    $sq="select * from cjb where 课程号='$kc'and  教师号='$_SESSION[username]'";
    
    $connect=mysqli_connect('localhost:33060','teacher','teacher');
    mysqli_select_db($connect,'pxscj');
    $sel_sql=mysqli_query($connect,$sq);

    if(!$sel_sql)
    echo (mysqli_error($connect));
    //print_r($sel_sql);
    $sel_sql1=mysqli_fetch_array($sel_sql,MYSQLI_ASSOC);
    if($sel_sql1)
    {
        $insert_sql="insert into cjb  values('$id', '$kc','$cj', '$_SESSION[username]' )";
        //echo $insert_sql;
        $r_insert=mysqli_query($connect,$insert_sql); 
           $r=mysqli_affected_rows($connect);
           
        if($r>0) 
        echo "<script>alert('添加成功!');</script>";
        else 
    {echo (mysqli_error($connect));
        echo "<script>alert('添加失败!');</script>";
        }
    }
}

if(isset($_POST['del']))
{   
    $id=$_POST['id'];
    $kc=$_POST['kc'];
      $connect=mysqli_connect('localhost:33060','teacher','teacher');
     mysqli_select_db($connect,'pxscj'); 
    $del_sql="delete from cjb where 课程号='$kc' and 学号= '$id'";
    
    $del_result=mysqli_query($connect,$del_sql) or die('删除失败！');
    $ww=mysqli_affected_rows($connect);
     //echo $ww."asdf";
    if($ww>0)  echo "<script>alert('删除成功!');location.href='4process_xsb.php';</script>";
}
if(isset($_POST['update']))
{ 
    $id=$_POST['id'];
    $hid=$_POST['hid'];
    $cj=$_POST['cj'];
    $kc=$_POST['kc'];
    $h_kc=$_POST['hkc'];
    
    $tq= new htform;
    $connect=mysqli_connect('localhost:33060','teacher','teacher'); 
    mysqli_select_db($connect,'pxscj');	
    if($id!=$hid)
    {
         echo "<script>alert('学号不能修改!');location.href='4process_xsb.php';</script>"; 
    } 
    if($kc!=$h_kc)
    {
         echo "<script>alert('课程号不能修改!');location.href='4process_xsb.php';</script>"; 
    }  
     $sql1="update cjb set 成绩='$cj' WHERE 学号='$id' and 课程号='$kc'"; 
     echo $sql1;
   mysqli_query($connect,"SET NAMES 'utf-8'");
     $res1=mysqli_query($connect,$sql1) ;
     /*if(!$res1) 
     echo (mysqli_error($connect));*/
     
     $ww=mysqli_affected_rows($connect);
     //echo $ww."asdf";
    if($ww>0)  echo "<script>alert('修改成功!');location.href='4process_xsb.php';</script>";
    else  echo "<script>alert('修改不成功!');</script>";
}

    
?>
