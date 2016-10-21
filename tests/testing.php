<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use SibigParking\Parking;

$siparking = new Parking(array(
  'id'  => '13591b6b-65da-4f84-82ce-a5c23c6d0a99',
  'secret' => 'WRniEDnsxEw7lvV8J2GST0O4ZyLvyDQ1',
  'url' => 'http://sandbox.sibigparking.com/',
  'version' => 'v1',
));

echo $siparking->getLocations('json');

echo $siparking->singleTrans(
		'8487645d-d358-4fd6-ba23-ed4f18baddfc',
		1,
		1,
		'2016-08-01 16:15:12',
		'2016-08-01 17:15:12',
		'AD5579RQ',
		2000,
		'json');
$data = [];
for ($i=1; $i <=3 ; $i++) { 
	$array['location'] = '6d9858d0-ebf3-473e-85c2-5c036d85a030';
	$array['vehicle'] = 1;
	$array['payment'] = 1;
	$array['enter'] = '2016-08-01 16:15:12';
	$array['exit'] = '2016-08-01 18:15:12';
	$array['plate_number'] = 'AD5579RQ';
	$array['amount'] = 3000*$i;
	array_push($data, $array);
}
$json = json_encode($data);
echo $siparking->multiTrans($json,'json');
