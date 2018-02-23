# Esios Access Library

This library offers some utilities to access the information from
the *Esios* platform (*Sistema de información del operador del sistema*).

* Version 1.0

## Set up ###

* Installation

        composer require paulogic/esios

        
* Dependencies

    - php >=5.6 with curl
    
## How to use ###

### Using an EsiosHelperFactory

The simplest way to make a call and receive a formatted response (php array of dates-values) is by means of the included Helper Factory class:

    
```
#!php

    $token = 'AUTHENTICATION TOKEN';
    
    //Prepare the factory
    $factory = new Esios\EsiosHelperFactory($token);

    //Create a helper to issue calls to obtain the list of prices
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::PVPC_20A_PRICES);
    $params = [
         'start_date' => '2017-04-01T01:00',
         'end_date' => '2017-04-01T05:00'
    ];
    $data = $helper->get($params);

    //Create a helper to issue calls to obtain the list of indicators
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::INDICATORS_LIST);
    $params = [
        'text' => 'facturacion de energia'
    ];
    $data = $helper->get($params);
```

The list of possible call types is defined inside the abstract class EsiosCallTypes:

* PVPC_20A_PRICES
* PVPC_20DHA_PRICES
* PVPC_20DHS_PRICES
* PVPC_20A_PROFILES
* PVPC_20DHA_PROFILES
* PVPC_20DHS_PROFILES
* PVPC_20A_PEAJESACCESO
* PVPC_20DHA_PEAJESACCESO
* PVPC_20DHS_PEAJESACCESO
* INDICATORS_LIST

New call types can be added to EsiosCallTypes along with the corresponding url paths.

### Direct call to the Esios REST API

You can issue a direct call to the REST API with the utility class EsiosCallService:

```
#!php

    $token = 'AUTHENTICATION TOKEN';
    //optional config, may be empty
    $config = [
        'timeout' => 10,
        'timezone' => 'Atlantic/Canary'    
    ];
    $callService = new Esios\Service\EsiosCallService($token, $config);

    $params = [
        'start_date' => '2017-04-23',
        'end_date' => '2017-04-24',
    ];

    //Direct call to indicator 1013 (prices of rate 20A)
    $data = $callService->getData('/indicators/1013', $params);
```




## Examples ###

You may find a list of functional examples on how to use the classes separately:

- Creating the accessor to the API and return raw data
- Creating a formatter to format the raw data
- Using a custom logger

Check the examples file:

        examples/examples.php

## Running tests ###

        vendor/bin/phpunit

### Check API response tests

There is a group of tests that check the response format of the actual Esios API calls.
They require online connection and a valid authentication token.
To activate these tests:

* Modify phpunit.xml :
    - Remove the exclude group 'onlinecheck'
    - Replace TOKEN with the authentication token issued by Esios
