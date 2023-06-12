<?php

namespace App\Http\Controllers\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Forms;
use App\Models\FormsToken;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\RefreshToken;

class TokenService extends Controller
{
   protected $client;

   CONST SCOPES = [
      Forms::FORMS_BODY_READONLY, 
      Forms::FORMS_BODY, 
      Forms::FORMS_RESPONSES_READONLY, 
      Forms::DRIVE_FILE,
      Forms::DRIVE_READONLY,
      Drive::DRIVE_METADATA,
      Drive::DRIVE,
      Drive::DRIVE_APPDATA,
      Drive::DRIVE_FILE,
      Drive::DRIVE_METADATA,
      Drive::DRIVE_METADATA_READONLY,
      Drive::DRIVE_READONLY,
      Drive::DRIVE_SCRIPTS
   ];

   public function __construct()
   {
      $this->client = new Client();
      $this->client->setAuthConfig(base_path('client_credentials.json'));
      $this->client->setAccessType("offline"); 
      $this->client->addScope(self::SCOPES);
   }

   public function setAccessToken($token){

      //access_token'nin süresi 1 saat, eğer bittiyse geçerlilik süresi 
      //refresh_token ile yeni bir access_token alıyoruz
      if($this->client->isAccessTokenExpired($token)){

         $refreshToken = RefreshToken::first();
         $token = $this->client->fetchAccessTokenWithRefreshToken($refreshToken->token);

         //formsToken() altı çiziliyse intelephense'nin anlamadığından yani hata yok
         auth()->user()->formsToken()->update([
            'token' => $token['access_token']
         ]);
      }

      $this->client->setAccessToken($token);

      return $this->client;
   }

   public function redirectToGoogle()
   {
      return redirect()->to($this->client->createAuthUrl());
   }

   public function handleGoogleCallback()
   {
      $this->client->fetchAccessTokenWithAuthCode(request()->get('code'));
      $accessToken = $this->client->getAccessToken();
      $refreshToken = $this->client->getRefreshToken();

      FormsToken::updateOrCreate(['user_id' => auth()->user()->id], ['token' => $accessToken['access_token']]);

      //seed edilmiş kullanıcılar olduğu için giriş yapacak kişi kendi gmail'i ile bir refresh token alacak
      //çıkış yapıp başka bir kullanıcı ile giriş yaparsa zaten refresh_token aldığı için access_token expired olduysa
      //onunla yeni token alacak yani tamamen access_tokenin sorunsuz yenilenmesi için
      if($refreshToken && !RefreshToken::count()){
         RefreshToken::create([
            'token' => $refreshToken
         ]);
      }
      
      return redirect()->intended(RouteServiceProvider::HOME);
   }

}
