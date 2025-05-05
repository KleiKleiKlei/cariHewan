<?php

function getAddressFromBingMaps($lat, $lng)
{
    $bingMapsKey = 'AhxkjpzOgxUNak7N5k9sJRQDv5EM8ZjVCsnI9ud9ZY6ZSpgXtJFxNnLnaIf1b0WE';
    $url = "http://dev.virtualearth.net/REST/v1/Locations/{$lat},{$lng}?key={$bingMapsKey}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if ($data && 
        isset($data['resourceSets'][0]['resources'][0]['address']['formattedAddress'])) {
        return $data['resourceSets'][0]['resources'][0]['address']['formattedAddress'];
    }
    
    return "$lat, $lng"; // Fallback to coordinates if geocoding fails
}