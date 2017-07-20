<?php

// /esios/examples $> php examples.php

require '../vendor/autoload.php';

//Replace with your authentication token
$token = 'TOKEN';

try {
    /**********
     * Optional:
     * Setting an optional logger that must be compliant with PsrLogLoggerInterface 
     */
    $logger = new \Monolog\Logger('monolog_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    $file_handler->setLevel(\Monolog\Logger::DEBUG);

    /**********
     * Class that implements a direct call to Esios REST API
     * Returns raw data
     */
    $config = [
        'timeout' => 10,
        'timezone' => 'Europe/Madrid'    
    ]; //optional config; default 5 secs timeout
    $callService = new Esios\Service\EsiosCallService($token, $config, $logger);

    $params = [
        'start_date' => '2017-03-01',
        'end_date' => '20170303',
        'time_trunc' => 'hour'
    ];

    //Direct call to indicator 1013 (prices of rate 20A)
    $data = $callService->getData('/indicators/1013', $params);
    print_r($data);

    /***********
     * Caller classes are wrappers around EsiosCallService.
     * They receive an id of the operation as defined in EsionCallTypes 
     * and add parameter validation. 
     * Returns raw data.
     */
    $caller = new Esios\Caller\EsiosDateRangeCaller($callService);
    $data = $caller->get(Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);
    print_r($data);


    /***********
     * The formatter can be used in a standalone way to format the raw
     * results of the API call.
     * Returns an array of results.
     */
    $data = $caller->get(Esios\EsiosCallTypes::PVPC_20A_PRICES, $params);
    $formatter = new Esios\Formatter\EsiosDateValueIndicatorFormatter();
    $formatter->setDataFromJsonEncoded($data);
    if ($formatter->validate()) {
        $data = $formatter->format();
        print_r($data); //Array of date => value
    }


    /***********
     * The EsiosHelper class is a single way of combining a caller and a formatter.
     */
    $caller = new Esios\Caller\EsiosDateRangeCaller($callService);
    //$caller2 = new Esios\Caller\EsiosGenericCaller($callService); //no date validations
    $formatter = new Esios\Formatter\EsiosDateValueIndicatorFormatter();
    //$formatter2 = new Esios\Formatter\EsiosIndicatorListFormatter(); //no date formatting
    $helper = new Esios\EsiosHelper(
            Esios\EsiosCallTypes::PVPC_20A_PRICES,
            $caller,
            $formatter,
            $logger);   //optional
    $data = $helper->get($params);
    print_r($data);

    
    /*************************************
     * Helper Factory class - 
     * The easiest and shortest way
     * to call the Esios REST API
     * and get structured data.
     *************************************/

    $factory = new Esios\EsiosHelperFactory($token);
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::PVPC_20A_PRICES);
    $data = $helper->get($params);
    print_r($data);

    /**********
     * Get another helper from the factory to issue a different call.
     */
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::PVPC_20DHA_PRICES);
    $data = $helper->get($params);
    print_r($data);

    /**********
     * Another helper for a call that doesn't depend on dates (INDICATORS_LIST).
     * Internally it uses the EsiosGenericCaller and does not validate parameters
     * but it is recommended to include the 'text' parameter to filter the results.
     */
    $params = [
        'text' => 'facturacion de energia'
    ];
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::INDICATORS_LIST);
    $data = $helper->get($params);
    print_r($data);

    /***********
     * $config and $logger can be passed in the HelperFactory constructor too
     */
    $params = [
        'start_date' => '2017-03-02T21:00',
    ];
    $config = [
        'timeout' => 10
    ];
    $factory = new Esios\EsiosHelperFactory($token, $config, $logger);
    $helper = $factory->getEsiosCaller(Esios\EsiosCallTypes::PVPC_20A_PROFILES);
    $data = $helper->get($params);
    print_r($data);
    
} catch (\Exception $e) {
    $logger->error($e->getMessage());
    echo $e->getMessage();
} catch (\Error $e) {
    $logger->error($e->getMessage());
    echo $e->getMessage();
}
