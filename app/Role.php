<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label'];
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

     /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
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
