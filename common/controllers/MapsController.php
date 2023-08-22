<?php

namespace common\controllers;

use Yii;
use yii\web\Response;

abstract class MapsController extends BaseController
{
    public function afterAction($action, $result)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::afterAction($action, $result);
    }

    public function actionSearch()
    {
        $request = Yii::$app->request;
        /** @var \common\components\PCMiler $pcmiler */
        $pcmiler = Yii::$app->pcmiler;
        $params = [
            'query' => $request->get('query')
        ];
        if ($maxResults = $request->get('maxResults')) {
            $params['maxResults'] = $maxResults + 0;
        }
        if ($currentLonLat = $request->get('currentLonLat')) {
            $params['currentLonLat'] = $currentLonLat;
        }
        if ($maxCleanupMiles = $request->get('maxCleanupMiles')) {
            $params['maxCleanupMiles'] = $maxCleanupMiles;
        }
        if ($countries = $request->get('countries')) {
            $params['countries'] = $countries;
        }
        if ($states = $request->get('states')) {
            $params['states'] = $states;
        }

        $locations = $pcmiler->search('NA', $params);
        $result = [];
        foreach ($locations as $location) {
            $searchLocationsParams = ['list' => 1, 'region' => 4];
            $address = $location->Address;
            $coords = $location->Coords;
            $timeZone = '';
            if ($address->Zip) {
                $searchLocationsParams['postcode'] = $address->Zip;
            } else {
                $searchLocationsParams['Coords'] = "{$coords->Lon},{$coords->Lat}";
            }
            $resp = $pcmiler->searchLocations($searchLocationsParams);
            if ($resp && is_string($resp[0]->TimeZone) && $resp[0]->TimeZone) {
                $timeZone = $resp[0]->TimeZone;
            }
            array_push($result, [
                "country_abbreviation" => $address->Country,
                "state_abbreviation" => $address->State,
                "city" => $address->City,
                "zip" => $address->Zip,
                "street_address" => $address->StreetAddress,
                "address" => "{$address->StreetAddress}, {$address->City}, {$address->State}, {$address->Zip}",
                "lat" => $coords->Lat,
                "lon" => $coords->Lon,
                "time_zone" => $timeZone
            ]);
        }
        return $result;
    }
}	
