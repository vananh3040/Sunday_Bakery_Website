<?php
    include './DBConnect/DBConnect.php';
 
    function Insert($table, $data, $except)
    {
        global $con;
        $field = "";
        $values = "";

        if(is_array($data))
        {
            $i = 0;
            foreach($data as $key => $value)
            {
                if($key != $except)
                {
                    $i++;
                    if($i == 1)
                    {
                        $field .= $key;
                        $values .= "'" . $value . "'";
                    }
                    else
                    {
                        $field .= "," . $key;
                        $values .= ",'" . $value . "'";
                    }
                }
            }
            $SQL_Insert = "INSERT INTO $table($field) VALUES($values)";
            mysqli_query($con, $SQL_Insert) or die("Error: Fail Query!");
            $id = mysqli_insert_id($con);
            return $id;          
        }
    }
 
?>