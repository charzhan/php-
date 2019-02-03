<?php

/**
 * @author phpadmin
 * @copyright 2018
 */

class sql_conect
{
    public $user;
    public $password;
    public $sql="select * from xsb";
    
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
        if(!$conn) echo "connnect faild<br/>";
        mysqli_select_db($conn,"pxscj");
        mysqli_query($conn,'set names utf8');
        $res=mysqli_query($conn,$this->sql);
        return $res;
          
    }
}


?>