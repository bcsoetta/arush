<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlokirKhusus extends Model
{
    protected $table = 'blokir_khusus';

    public function setNoIdentitasAttribute($value)
    {
        $this->attributes['no_identitas'] = preg_replace('/[^0-9a-zA-Z]/', '', $value);
    }
}
