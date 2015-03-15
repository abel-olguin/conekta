<?php
if(strpos($_GET['run'],'ajax')===false)
{
    include('header.php');
}

include('core/controller.php');

if(strpos($_GET['run'],'ajax')===false)
{
    require_once('footer.php');
}
?>
