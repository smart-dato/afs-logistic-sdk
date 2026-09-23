<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use SmartDato\AfsLogistic\AfsLogistic;
use SmartDato\AfsLogistic\Facades\AfsLogistic as AfsLogisticFacade;

it('posts the tracking request to the default endpoint', function () {
    Http::fake(['*' => Http::response(['Shipment' => ['Number' => 'SHIP-1']])]);

    $response = (new AfsLogistic('client', 'orgunit', 'token'))->tracking('SHIP-1');

    expect($response)->toBe(['Shipment' => ['Number' => 'SHIP-1']]);

    Http::assertSent(fn (Request $request): bool => $request->url() === 'https://shippingnet01.ondot.at/afs/dataservice/publicapi/v1/shipment/retrieve'
        && $request->header('client-id') === ['client']
        && $request->header('orgunit-id') === ['orgunit']
        && $request->header('auth-token') === ['token']
        && $request['ShipmentMatching']['Number'] === 'SHIP-1');
});

it('reads the credentials from the config', function () {
    config()->set('afs-logistic-sdk.client_id', 'config-client');
    config()->set('afs-logistic-sdk.orgunit_id', 'config-orgunit');
    config()->set('afs-logistic-sdk.auth_token', 'config-token');

    Http::fake();

    AfsLogisticFacade::tracking('SHIP-1');

    Http::assertSent(fn (Request $request): bool => $request->header('client-id') === ['config-client']
        && $request->header('orgunit-id') === ['config-orgunit']
        && $request->header('auth-token') === ['config-token']);
});
