<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(FCPATH . 'vendor/autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf {
    public function __construct() {
        parent::__construct();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $this->setOptions($options);
    }
}