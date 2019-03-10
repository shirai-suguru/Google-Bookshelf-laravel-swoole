<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Repositories\GoogleClientRepository;

class IndexController extends Controller
{
    /**
     * GoogleClientRepository
     */
    protected $googleClient;

    /**
     *
     * @param  GoogleClientRepository  $googleClient
     * @return void
     */
    public function __construct(GoogleClientRepository $googleClient)
    {
        $this->googleClient = $googleClient;
    }

    public function login()
    {
        $client = $this->googleClient->getClient();
        $scopes = [ \Google_Service_Oauth2::USERINFO_PROFILE ];
        $authUrl = $client->createAuthUrl($scopes);

        return redirect($authUrl);
    }
    
    /**
     * @param Request $request
     */
    public function callback(Request $request)
    {
        $code = $request->query('code');
        $client = $this->googleClient->getClient();
        $authResponse = $client->fetchAccessTokenWithAuthCode($code);

        if ($client->getAccessToken()) {
            $userInfo = $client->verifyIdToken();

            $request->session()->put('user', [
                'id'      => $userInfo['sub'],
                'name'    => $userInfo['name'],
                'picture' => $userInfo['picture'],
            ]);
        }
        return redirect("/", 302);
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}

