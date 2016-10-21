SDK SI BIG PARKING
==================

## Installing
```bash
composer require sdksibig/sibigparking:v0.1
```

Usage : 

```php    
//Make sure to include the Composer autoloader at the top of your script.
require_once __DIR__ . '/../vendor/autoload.php'; 
```

```php    
//Declaration
use SibigParking\Parking;
```

```php    
// Using Constructor
// url = http://sandbox.sibigparking.com (Demo Version) atau http://sandbox.sibigparking.com (Live Version)
$siparking = new Parking(array(
  'id'  => 'Machine ID',
  'secret' => 'Machine Secret',
  'url' => 'url',
  'version' => 'v1',
));
```
```php    
// Lokasi
// format : JSON ("json") / XML ("xml")
$parking->getLocations($format);
```
   - [api documentation](http://doc-sandbox.sibigparking.com/#lokasi)

```php    
//send single transaction
// format : JSON ("json") / XML ("xml")
$parking->singleTrans($location, $vehicle, $payment,$enter, $exit,$plate_number, $amount, $format);
```
   - [api documentation](http://doc-sandbox.sibigparking.com/#transaksi-tunggal) for fields parameter

```php
//send many transaction
// transactions : Array JSON dari kumpulan data single transaction
// format : JSON ("json") / XML ("xml")
$parking->multiTrans($transactions, $format);
```
 - [api documentation](http://doc-sandbox.sibigparking.com/#transaksi-jumlah-besar) for transactions parameter

## Help and docs

- [Documentation](http://doc-sandbox.sibigparking.com/)

## Updating Repository
```bash
curl -XPOST -H'content-type:application/json' 'https://packagist.org/api/update-package?username=Abdulhmid&apiToken=J3CPYd5EIS52A7Oay6cP' -d'{"repository":{"url":"https://github.com/Abdulhmid/sibig-php-sdk.git"}}'
```