<div class=" col-xs-8 col-lg-8 col-md-8 col-xs-offset-2 col-lg-offset-2 col-md-offset-2" style="font-size:14px; background:#fff !important;">

<?php
switch($origen) {
    case 'cash':
        $this->set_view('oxxo');
        break;
    case 'bank':
        $this->set_view('banorte');
        break;

    case 'card':
        if (status == "paid") {
            $this->set_view('tcPaid');
        } else {
            $this->set_view('tc');
        }
        break;
    default:
        $this->set_view('default');
        break;
}
?>



			</div>

