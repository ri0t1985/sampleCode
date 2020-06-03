<?php

use Erik\Sample\Controller\OrderController;
use Erik\Sample\Supplier\SupplierFactory;

require_once 'vendor/autoload.php';

// Obviously this should contain routing, instead of hardcoded controllers.
// But this is sample code. Some concessions have to be made
$controller = new OrderController(new SupplierFactory());
echo $controller->placeOrder($_GET['brand'] ?? null);

