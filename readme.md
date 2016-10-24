SDK SI BIG PARKING
=======================

sibigparking.com API Documentation
------------

[API Doc](https://doc.sibigparking.com/)

Available API
------------

- API Daftar Lokasi
- API Kirim Transaksi Tunggal
- API Kirim Transaksi Dalam Jumlah Banyak

Requirements
------------

- PHP >=5.5
- Composer

Installation
------------

The recommended way to install Cybozu HTTP is with [Composer](https://getcomposer.org/).
Composer is a dependency management tool for PHP that allows you to declare the dependencies your project needs and installs them into your project.

```{.bash}
    $ curl -sS https://getcomposer.org/installer | php
    $ mv composer.phar /usr/local/bin/composer
```

You can add SDK Sibig Parking as a dependency using the composer

```{.bash}
    $ composer require sdksibig/sibigparking:v0.1
```

Alternatively, you can specify SDK Sibig Parking as a dependency in your project's existing composer.json file:

```{.json}
    {
       "require": {
          "sdksibig/sibigparking": "v0.1"
       }
    }
```

Setelah installing, anda membutuhkan untuk require Composer's autoloader:

```{.php}
    require_once __DIR__ . '/../vendor/autoload.php'; 
```

Atau bisa juga dengan menggunakan

```{.php}
use SibigParking\Parking;
```


Quick start
------------

```{.php}
    $siparking = new Parking(array(
      'id'  => 'Machine ID',
      'secret' => 'Machine Secret',
      'url' => 'url',
      'version' => 'v1',
    ));
    
```

Menggunakan Api Daftar Lokasi
------------
- Format Penggunaan :
    ```
       $parking->getLocations($format)
    ```
- $format :
    ```
       JSON => "json" / XML => "xml"
    ```
- contoh : 
    ```
       $parking->getLocations("json")
    ```
- Response
```{.json}
    {
       "locations": [
         {
           "location_id": "4d565e1a-bcff-4ae4-92d9-2a23cff67e27",
           "name": "Mall Bekasi Sumarecon",
           "address": "Jalan Boulevard Ahmad Yani Blok M",
           "city": "BEKASI" 
         }
       ],
      "count": 1
    }
```

Menggunakan Api Kirim Transaksi Tunggal
------------
- Format Penggunaan :
    ```
       $parking->singleTrans($location, $vehicle, $payment,$enter, $exit,$plate_number, $amount, $format);
    ```
- Format Data :
```{.bash}
    $location => 4d565e1a-bcff-4ae4-92d9-2a23cff67e27
    $vehicle  => 1 "Keterangan = 1,Motor;2:Mobil;3:Lainnya"
    $payment  => 1 "Keterangan = 1,Tunai;2:Member;3:E-Money"
    $enter    => 2016-08-01 16:15:11
    $exit     => 2016-08-01 16:15:12
    $plate_number  => AD 4567 A 
    $amount  => 2000
    $format  => 'json'
```

- contoh : 
    ```
       $parking->singleTrans('4d565e1a-bcff-4ae4-92d9-2a23cff67e27',1,1,'2016-08-01 16:15:11','2016-08-01 16:15:12','AD 4567 A ',2000,'json')
    ```
- Response
```{.json}
    {
        "message": "Successfully add transaction."
    }
```

Menggunakan Api Kirim Transaksi Dalam Jumlah Banyak
------------
- Format Penggunaan :
    ```
       $parking->multiTrans($transactions, $format)
    ```
- Format Data:
    - $trans = Array Json
    - $format = xml/json
- Contoh data $trans
```{.json}
        [  
           {  
              "location":"4d565e1a-bcff-4ae4-92d9-2a23cff67e27",
              "vehicle":1,
              "payment":1,
              "enter":"2016-08-03 16:15:11",
              "exit":"2016-08-03 19:15:12",
              "plate_number":"2222",
              "amount":"2000"
           },
           {  
              "location":"4d565e1a-bcff-4ae4-92d9-2a23cff67e27",
              "vehicle":1,
              "payment":1,
              "enter":"2016-08-03 16:15:11",
              "exit":"2016-08-03 18:15:12",
              "plate_number":"2222",
              "amount":"2000"
           }
        ]
```
- contoh : 
    ```
       $parking->multiTrans($trans,"json")
    ```
- Response
```{.json}
    {
        "message": "Successfully add transactions.",
        "sent": 2,
        "succeed": 1,
        "failed": 1
    }
```

TODO
------------

- English documentation.

License
------------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.