<html> 

<body background="bg.gif">
</body>

</html>
<?php
session_start();//批量导入成绩

    if( false==($file_handl=fopen("./c.csv","r")))
    {
        echo "read error! 上传的文件不存在 <br/>";
        
    }
    
    else{
    echo"欢迎使用上传功能(成绩批量导入) ".$_SESSION['username']."你好！</br>使用csv文件，正在批量导入数据库中</br>";
    
    $row=0; 
    $data_row_num=0;
    $sccer=array();
    require('func.php');
    $t=new sql_conect("teacher","teacher");
        
    while($data=fgetcsv($file_handl,100))
    {   if($data[0]=="end")
        break;
        if($data[0]=="学号")
        continue;
        $num=count($data);
        $insert_sql="insert into cjb  values('$data[0]', '$data[1]','$data[2]','$_SESSION[username]' )";
        //echo $insert_sql;
        $t->set_sql($insert_sql);
        $res=$t->querry_sql();
        //print_r($res);
        if(!$res)
        echo mysqli_error($t->get_con())."</br>";
        
        
    }
    
echo("</br><a href=\"4process_xsb.php\">查看你是否添加成功了</a>");

}
echo("</br><a href=\"choose.php\">回到登录界面</a>");
?>