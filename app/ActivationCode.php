<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    //

    protected $fillable = ['code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Laravel ap utilise colonne code la pito au lio de id a pou li retourne informations yo
    public function getKeyName()
    {
        return 'code';
    }
}
