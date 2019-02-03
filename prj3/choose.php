<html>
<head> 
<style type="text/css">
	<!--
		.STYLE1 {font-size: 15px; font-family: "幼圆";}
	-->
	body{
		text-align:center;
		font-family:"幼圆";
		font-size:24px;
		font-weight:bold;
		color:"#008000";
	}
	table{
		width:300px;
	}
	</style></head>
<body background="bg.gif" text-align="center">
<form  method="post"  >
选择你的用户角色：<br />
<label>账号 <input type="text" name="id" /> </label><br />
<label> 密码 <input  type="password" name="password"/></label><br />
<label><input name="q" type="radio" value="h" />教务 </label> 
<label><input name="q" type="radio" value="t" />老师 </label> 
<label><input name="q" type="radio" value="s" />学生 </label> <br />
<label><input  name="post" type="submit" value="选择"/> </label> 
<label><input  name="res" type="reset" value="重置"/> </label> 
</form>
</body>
</html>

<?php
session_start();



class check {
    private $user;
    private $pw;
    private $sel;
    
    function __destruct()
    {
        
    }
    function __construct($user,$pw,$s)
    
    {
        $this->pw=$pw;
        $this->user=$user;
        $this->sel=$s;
    }
    
    function check_user($js)
    {
        require('func.php');
        $c=new sql_conect("login","");
        $c->set_sql("select $this->sel from $js ");
        
        $res=$c->querry_sql();
        echo $c->get_sql();
        if(!$res)
        echo (mysqli_error($c->get_con()));
        while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
        {
            if($this->user==$row[$this->sel])
                return 1;
        }
        return 0;
    }
}

if(isset($_POST['post']))
{   
       $id=@$_POST['id'];
       $_SESSION['username'] = $id;
       
       $pw=@$_POST['password'];    
    $t=@$_POST['q'];
    
    if($pw==="123"){
    if($t=="h")
    {   $ret=new check($id,$pw,"工号");
        $temp=$ret->check_user("jwb");
        if($temp==1)
        header("location:head.php"); 
        else
        echo "<script>alert('账户或密码错误!');</script>";
    }
    elseif($t=="t")
    {   
        $ret=new check($id,$pw,"教师号");
        $temp=$ret->check_user("jsb");
        if($temp==1)
        header("location:4process_xsb.php"); 
        else
        echo "<script>alert('账户或密码错误!');</script>";
    } 
    elseif($t=="s")
    {
        $ret=new check($id,$pw,"学号");
        $temp=$ret->check_user("xsb");
        if($temp==1)
        header("location:student.php"); 
        else
        echo "<script>alert('账户或密码错误!');</script>";
    }
    
}
}
?>