<?php

namespace App\Repositories;

class GoogleClientRepository
{
    public function getClient()
    {
        $client = new \Google_Client([
            'client_id'     => config('google.clientId'),
            'client_secret' => config('google.clientSecret'),
        ]);
        $client->setRedirectUri(config('google.redirectUri'));
        
        return $client;
    }
}

