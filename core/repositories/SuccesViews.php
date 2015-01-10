<?php
/**
 * Created by PhpStorm.
 * User: Abel
 * Date: 10/01/2015
 * Time: 01:11 PM
 */

class repositories_SuccesViews
{
    public function getViewOxxo(){
        ob_start();
        require_once("oxxo.php");
        $data = ob_get_clean();
        return $data;
    }
    public function getViewbanorte(){
        ob_start();
        require_once("banorte.php");
        $data = ob_get_clean();
        return $data;
    }
    public function getViewTC(){
        ob_start();
        require_once("tc.php");
        $data = ob_get_clean();
        return $data;
    }
    public function getViewTCpaid(){
        ob_start();
        require_once("tcPaid.php");
        $data = ob_get_clean();
        return $data;
    }

    public function getViewDefault(){
        ob_start();
        require_once("default.php");
        $data = ob_get_clean();
        return $data;
    }
}