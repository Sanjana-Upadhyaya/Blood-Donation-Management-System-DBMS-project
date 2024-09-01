<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "bdms";
    $conn= "";

    

    try{
        $conn = mysqli_connect ( $db_server,
                            $db_user,
                            $db_pass,
                            $db_name,
                            3306);//default port is 3306 for mysql but our port is 3307 so mentioning is req
    }
    catch(mysqli_sql_exception)
    {
        echo"no connection<br>";
    }

    /*if($conn)
    {
        echo"u r connected<br>";
    }*/
    
?>