<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Repositories\FormRepository;

class FormsController extends Controller
{
   protected $formRepository;

   public function __construct()
   {
      $this->formRepository = new FormRepository();
   }

   public function index(){
      return view('dashboard');
   }

   public function getForms(){

      $forms = $this->formRepository->getForms();

      return view('forms', compact('forms'));
   }

   public function getForm(string $formId){

      $form = $this->formRepository->getForm($formId);
     
      return view('form-detail', compact('form'));
   }
}
