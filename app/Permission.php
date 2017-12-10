<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = strtoupper($value);
    }

    public function setLabelAttribute($value)
    {
        return $this->attributes['label'] = strtoupper($value);
    }
    
}
