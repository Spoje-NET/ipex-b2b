<?php

namespace IPEXB2B;

require_once '../testing/bootstrap.php';

$oPage     = new \Ease\TWB\WebPage('IPEX B2B Demo');
$container = $oPage->addItem(new \Ease\TWB\Container(new \Ease\Html\H1Tag(_('IPEX Connection Test'))));

$connector = new Rights();
$rights    = $connector->requestData();

$container->addItem(new \Ease\Html\PreTag(print_r($rights, true)));

$oPage->draw();
