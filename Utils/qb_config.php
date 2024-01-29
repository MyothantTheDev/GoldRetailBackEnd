<?php

$map = array(
    QUICKBOOKS_ADD_ACCOUNT => array('_quickbooks_customer_add_request','_quickbooks_customer_add_response'),
    );

$errmap = array(
    '*' => '_quickbooks_error_catchall',
    );
$hooks = array();
$log_level = QUICKBOOKS_LOG_DEVELOP;
$soapserver = QUICKBOOKS_SOAPSERVER_BUILTIN;
$soap_options = array();
$handler_options = array(
    'deny_concurrent_logins' => false,
    'deny_reallyfast_logins' => false,
);
$driver_options = array();
$callback_options = array();
