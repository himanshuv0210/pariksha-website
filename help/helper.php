<?php 
function sanitize($dirty)
{
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function proper_date($date)
{
    return date("M d,Y (h:i A)",strtotime($date));
}
?>