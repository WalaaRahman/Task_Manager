 
 <?php

    function printMessages($txt){

        if(isset($_SESSION['Message'])){
            foreach($_SESSION['Message'] as $key => $value){
                echo '*'.$value.'<br>';
            }
            unset($_SESSION['Message']);
        }
        else{
            echo $txt;
        }
    }


    
function url($url){

    return "http://".$_SERVER['HTTP_HOST']."/TaskManagement/layouts/sidebar-07/".$url;
}
// http://localhost/TaskManagement/layouts/sidebar-07/
?> 