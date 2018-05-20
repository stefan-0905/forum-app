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

function dateDiff($date1, $date2)
{
    $date_1 = new DateTime($date1);
    $date_2 = new DateTime($date2);
    $diff = $date_1->diff($date_2);

    if ($diff->days > 365) {
        return "On ".$date_1->format('Y-m-d');
    } elseif ($diff->days > 7) {
        return "On ".$date_1->format('M d');
    } elseif ($diff->days > 1) {
        return "On ".$date_1->format('l - H:i');
    } elseif ($diff->days == 1) {
        return "Yesterday at ".$date_1->format('H:i');
    } elseif ($diff->days > 0 OR $diff->h > 1) {
        return "Today at ".$date_1->format('H:i');
    } elseif ($diff->i >= 1) {
        return $diff->i." min ago";
    } else {
        return "Just now";
    }
}