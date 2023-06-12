<?php

namespace App\Http\Controllers\Services;

use Google\Service\Drive;
use Google\Service\Forms;
use App\Http\Controllers\Controller;

class ApiService extends Controller
{
   protected $tokenService;
   protected $client;

   public function __construct()
   {
      $this->tokenService = new TokenService();
   }

   private function getAuthUserAccessToken(){
      return auth()->user()->formsToken?->token;
   }

   public function getFormList()
   { 
      $this->client = $this->tokenService->setAccessToken($this->getAuthUserAccessToken());

      $service = new Drive($this->client);

      $forms = $service->files->listFiles([
         'q' => "mimeType='application/vnd.google-apps.form'",
         'fields' => 'files(id, name)',
     ]);

      return $forms->files;
   }

   public function getForm(string $formId)
   {
      $this->client = $this->tokenService->setAccessToken($this->getAuthUserAccessToken());

      $service = new Forms($this->client);

      return $service->forms->get($formId);
   }
}
