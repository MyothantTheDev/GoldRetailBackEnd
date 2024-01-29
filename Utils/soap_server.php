<?
use QuickBooks_WebConnector_Server;
require dirname(__FILE__).'qb_config.php';

$Server = new QuickBooks_WebConnector_Server($dsn, $map, $errmap, $hooks, $log_level, $soapserver,
                QUICKBOOKS_WSDL, $soap_options, $handler_options, $driver_options, $callback_options);

$Server->handle(true, true);
