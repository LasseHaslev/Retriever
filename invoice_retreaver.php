#! /usr/bin/env php

<?php

use Symfony\Component\Console\Application;
use LasseHaslev\Console\Commands\MailFetcher;

require 'vendor/autoload.php';

$app = new Application( 'InvoiceRetreaver', '0.1' );

$app->add( new MailFetcher );

$app->run();
