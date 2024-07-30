<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }


    protected $fillable = [
        'name' ,
       'email' ,
        'subject',
        'message'
        
    ];
}
