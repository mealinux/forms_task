<?php

namespace App\Http\Controllers\Repositories;

use App\Models\Form;
use App\Models\Answer;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ManagerController;

class FormRepository extends Controller
{
   protected $manager;
   
   public function __construct()
   {
      $this->manager = new ManagerController();
   }

   public function getForm($formId){
     return Form::with('question.answers')->findOrFail($formId);
   }

   public function getForms(){

      $forms = Form::paginate(5);
      
      if($forms->isEmpty()){
         $this->manager->formManager();

         $forms = Form::paginate(5);
      }

      return $forms;
   }

   public function saveForms(object $form, string $googleFormId): Form{

      $savedForm = Form::updateOrCreate(
         ['google_form_id' => $googleFormId],
         [
            'title' => $form->info->title,
            'description' => $form->info->description ?? '',
            'google_form_url' => $form->responderUri
         ]
      );

      return $savedForm;
   }

   public function saveQuestion(object $googleQuestion, string $savedFormId, string $questionType): Question{

      $question  = Question::updateOrCreate(
         ['google_item_id' => $googleQuestion->itemId],
         [
            'form_id' => $savedFormId,
            'title' => $googleQuestion->title ?? '',
            'type' => $questionType
         ]
      );

      return $question;
   }

   public function saveAnswers(object $answer, string $questionId): void{

      Answer::updateOrCreate(
         ['value' => $answer->value],
         [
            'question_id' => $questionId,
         ]
      );
   }
}
