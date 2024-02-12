<?php

namespace Utils\Services;

class QuickBooks_Custom_Services {

    private static $user;
    private static $pwd;
    private static $dns;

    public function __construct($user, $pwd, &$dns) {
        self::$user = $user;
        self::$pwd = $pwd;
        self::$dns = $dns;
    }

    public static function authencation($username, $password, &$qb_company_file) {
        if($username == self::$user && $password == self::$pwd) {
            $qb_company_file = "D:\Company\PoePoe\Invoice\SaleAndPawnRecords.QBW";
            return true;
        }
        return false;
    }

    public static function quickbooks_custom_add_request($requestID, $user, $action, $ID, $extra, &$err, $last_action_time, $last_actionident_time, $version, $locale)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
			<?qbxml version="2.0"?>
			<QBXML>
				<QBXMLMsgsRq onError="stopOnError">
					<CustomerAddRq>
						<CustomerAdd>
							<Name>ConsoliBYTE Solutions (' . mt_rand() . ')</Name>
							<CompanyName>ConsoliBYTE Solutions</CompanyName>
							<FirstName>Keith</FirstName>
							<LastName>Palmer</LastName>
							<BillAddress>
								<Addr1>ConsoliBYTE Solutions</Addr1>
								<Addr2>134 Stonemill Road</Addr2>
								<City>Mansfield</City>
								<State>CT</State>
								<PostalCode>06268</PostalCode>
								<Country>United States</Country>
							</BillAddress>
							<Phone>860-634-1602</Phone>
							<AltPhone>860-429-0021</AltPhone>
							<Fax>860-429-5183</Fax>
							<Email>Keith@ConsoliBYTE.com</Email>
							<Contact>Keith Palmer</Contact>
						</CustomerAdd>
					</CustomerAddRq>
				</QBXMLMsgsRq>
			</QBXML>';

		return $xml;
    }

    public static function quickbooks_customer_add_response($requestID, $user, $action, $ID, $extra, &$err, $last_action_time, $last_actionident_time, $xml, $idents)
    {
	    return;
    }
}
