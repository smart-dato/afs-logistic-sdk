<?php

namespace SmartDato\AfsLogistic;

use Illuminate\Support\Facades\Http;

class AfsLogistic
{
    public function __construct(public string $clientId, public string $orgunitId, public string $authToken) {}

    public function tracking(string $shipmentMatchingNumber)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'client-id' => $this->clientId,
            'orgunit-id' => $this->orgunitId,
            'auth-token' => $this->authToken,
        ])->post(config('afs-logistic-sdk.tracking'), [
            'ShipmentMatching' => [
                'Number' => $shipmentMatchingNumber,
            ],
            'RequestedFields' => [
                'Shipment' => [
                    'Codes' => true,
                    'Status' => true,
                    'Shipper' => false,
                    'Recipient' => false,
                    'LoadingPoint' => false,
                    'UnloadingPoint' => false,
                    'FreightPayer' => false,
                    'CustomsDutyPayer' => false,
                    'StartDepot' => false,
                    'EndDepot' => false,
                    'Number' => true,
                    'DeliveryCarrierID' => true,
                    'PickupCarrierID' => true,
                ],
                'Collo' => [
                    'Codes' => true,
                    'Status' => true,
                    'TrackingLink' => true,
                    'Number' => true,
                    'TrackingNumber' => true,
                ],
            ],
        ])->json();

    }
}
