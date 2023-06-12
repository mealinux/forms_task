<?php

namespace App\Models;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['google_form_id', 'title', 'description', 'google_form_url'];

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['created_at_diff'];

   public function getCreatedAtDiffAttribute()
   {
      return Carbon::parse($this->attributes['created_at'])->diffForHumans();
   }

    public function question(){
      return $this->hasMany(Question::class);
    }
}
