<?php

function redirect($location)
{
    header("Location: {$location}");
}

function footer($script_array) 
{
    echo 
        "<footer id='main-footer' class='text-center mt-5 p-5 text-light bg-dark'>
            <p class='m-0'>Copyright &copy; 2018</p>
        </footer>
    
        <script type='text/javascript' src='js/jquery.min.js'></script>
        <script type='text/javascript' src='js/popper.min.js'></script>
        <script type='text/javascript' src='js/bootstrap.min.js'></script>";
    
    foreach($script_array as $script)
        echo "<script type='text/javascript' src='" . $script . "'></script>";

    echo "</body></html>";
}