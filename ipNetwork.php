<?php

namespace HTTPTestingUtilities;

$common_php_dir = '../php_common';
$common_autoload_file = $common_php_dir.'/autoload.php';
require($common_autoload_file);


$php_cli_dir = '../php_cli';
$php_cli_autoload_file = $php_cli_dir.'/autoload.php';
require($php_cli_autoload_file);


require ('./lib/autoload.php');

use HTTPTestingUtilities\lib\network\validate\NetworkCLIOpt;
use HTTPTestingUtilities\lib\network\CIDR;

\common\Config::obj(__DIR__.'/config/config.ini');

$opt = new NetworkCLIOpt();
$opt->exchangeArray(array_slice($argv, 1));

if ($opt->cidr !== null && $opt->ip !== null) {
    $network = new CIDR($opt->ip, $opt->cidr);
    
    printf("CIDR: %s\n", $network->cidr);
    printf("HOST IP: %s\n", $network->ip['octetString']);
    printf("Network: %s\n", $network->networkIp['octetString']);
    printf("Subnet Mask: %s\n", $network->subnetMaskIp['octetString']);
    printf("Number of Hosts: %s\n", $network->numHosts);
    printf("First host: %s\n", $network->firstHostIp['octetString']);
    printf("Last host: %s\n", $network->lastHostIp['octetString']);
    
} else {
    exit(\common\logging\Logger::obj()->write("You must enter a CIDR and IP.  Use --cidr and --ip.\n", -1, TRUE));
}