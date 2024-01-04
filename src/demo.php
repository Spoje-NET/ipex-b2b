<?php

namespace IPEXB2B;

require_once '../testing/bootstrap.php';


$connector = new Rights();
$rights    = $connector->requestData();
print_r($rights);
