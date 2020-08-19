<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['title','body'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Mutator always start with set and then column name and then attribute keywords
    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=Str::slug($value);
    }
}
