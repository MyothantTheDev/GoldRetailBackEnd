<?php

$dns = env('QBDB_URI','mysql://root:root@localhost/quickbook_invoice_record');
$user = env('QB_USERNAME','quickbooks');
$password = env('QB_PASSWORD','password');

$map = array(
	QUICKBOOKS_ADD_CUSTOMER => array( 'QuickBooks_Custom_Services::quickbooks_custom_add_request', 'QuickBooks_Custom_Services::quickbooks_custom_add_response' ),
);

// This is entirely optional, use it to trigger actions when an error is returned by QuickBooks
$errmap = array();

// An array of callback hooks
$hooks = array();

// Logging level
$log_level = QUICKBOOKS_LOG_DEVELOP;		// Use this level until you're sure everything works!!!

// SOAP backend
$soap = QUICKBOOKS_SOAPSERVER_BUILTIN;

// SOAP options
$soap_options = array();

// Handler options
$handler_options = array(
	'authenticate' => 'QuickBooks_Custom_Services::authentication',
	'deny_concurrent_logins' => false,
);
