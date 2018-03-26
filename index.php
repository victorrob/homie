<?php
$phtml = isset($_GET['p']) ? $_GET['p'] : 'login';
include('view/phtml/'. $phtml . '.phtml');
