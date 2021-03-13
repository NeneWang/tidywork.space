<?php

header("Content-Type:application/json");
if(isset($_POST["submit"])){
    //works
    echo ( json_encode($_POST) );
    
}
     

?>