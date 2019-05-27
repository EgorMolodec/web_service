<?php 

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
                        && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
                        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                $db_host = "127.0.0.1";
                $db_user = "root";
                $db_password = "";
                //$db_base = "database";
                $db_base = "servis";

                $link = mysql_connect($db_host, $db_user, $db_password) or die("Ошибка соединения: " . mysql_error());
                mysql_select_db($db_base);

                mysql_set_charset('utf8',$link);


                $result = mysql_query("SELECT * FROM tblTask WHERE `intCourseID`='".$_POST["intCourseID"]."' ");

                   echo"<option value=''>Выберете задание</option>";

                while ($row = mysql_fetch_array($result))  // mysql_fetch_array
                {
                   echo "<option value='".$row["intTaskID"]."'>".$row["txtTaskName"]."</option>";
                }


        } 
        

?>

