<?php

namespace App\Models;

use App\Models\Form;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'title', 'type', 'google_item_id'];

    public function form(){
      return $this->belongsTo(Form::class);
    }

    public function answers(){
      return $this->hasMany(Answer::class);
    }
}
