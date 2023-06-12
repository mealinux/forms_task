<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\ApiService;
use App\Http\Controllers\Repositories\FormRepository;

class ManagerController extends Controller
{
   protected $formRepository;
   protected $apiService;

   public function __construct()
   {
      $this->formRepository = new FormRepository();
      $this->apiService = new ApiService();
   }

   //google dan gelen formları DB'ye kaydeden fonksiyon
   public function formManager()
   {
      $googleFormList = $this->apiService->getFormList();

      foreach ($googleFormList as $googleForm) {

         //google'dan çektiğimiz form
         $form = $this->apiService->getForm($googleForm->getId());

         //DB'ye kaydedilen form
         $savedForm = $this->formRepository->saveForms($form, $googleForm->getId());

         if (!count($form->items)) {
            continue;
         }

         foreach ($form->items as $googleQuestion) {

            $questionItems = $googleQuestion->questionItem->question?->choiceQuestion;

            if (!$questionItems) {
               continue;
            }

            //DB'ye kaydedilen formun soruları
            $question = $this->formRepository->saveQuestion($googleQuestion, $savedForm->id, $questionItems->type);

            if (!count($questionItems->options)) {
               continue;
            }

            foreach ($questionItems->options as $answer) {

               //DB'ye kaydedilen soruların cevapları
               $this->formRepository->saveAnswers($answer, $question->id);
            }
         }
      }

      return true;
   }
}
