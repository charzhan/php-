<html> 

<body background="bg.gif">
</body>
</html>

<?php

/**
 * @author phpadmin
 * @copyright 2018
 */
class user
{
    private $user;
    
    function __construct($user)
    {
        $this->user=$user;
        
    }
    function sel()
    {
        require('func.php');
        $y=new sql_conect("student","student");
        $y->set_sql("select * from cjb where 学号='$this->user'");
        $res=$y->querry_sql();
        if(!$res)
        echo mysqli_error($y->get_con());
        
        return $res;
    }
    
}


session_start();
$t=new user($_SESSION['username']);
$res_g=$t->sel();
echo "<table border=\"1\"><tr>
<td> 学号</td>
<td> 课程号</td>
<td> 成绩</td>
</tr>";
while($row=mysqli_fetch_array($res_g,MYSQLI_BOTH))
{
    echo "<tr><td> $row[学号]</td>
         <td> $row[课程号]</td>
         <td> $row[成绩]</td>   
    </tr>";
    
}
echo "</table>";


/*class out{
    private $var1;
    private $var2;
    private $var3;
    private $var4;
    private $var5;
    function __construct($var1,$var2=0,$var3=0,$var4=0,$var5=0)
    {
        $this->var1=$var1;
        $this->var2=$var2;
        $this->var3=$var3;
        $this->var4=$var4;
        $this->var5=$var5;
    }
    function out_s()
    {
        echo "<table border=\"1\"> <tr> <td>$this->var1</td> ";
        if($this->var2!=0)
        echo " <td>$this->var2 </td>";
        if($this->var3!=0)
        echo "  <td> $this->var3 </td>";
        if($this->var4!=0)
        echo " <td> $this->var4 </td>";
        if($this->var5!=0)
        echo " <td> $this->var5 </td>";
        echo "</tr>";
        
    }
}
*/


?>














