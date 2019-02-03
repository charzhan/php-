<?php
class sql_conect
{
    private $user;
    private $password;
    private $sql;
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
    function get_sql()
    {
        return $this->sql;
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
	
 

?>