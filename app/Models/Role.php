<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name'];

    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }

    public function getPermissionsAttribute()
    {
        return $this->attributes['permissions'] ? json_decode($this->attributes['permissions'], true) : [];
    }

    public function setPermissionsAttribute($permissions)
    {
        $this->attributes['permissions'] = json_encode($permissions);
    }

    public function hasPermissionTo($permission)
    {
        return in_array($permission, $this->getPermissionsAttribute());
    }

    public function can($permission)
    {
        return $this->hasPermissionTo($permission);
    }

    public function isAdmin()
    {
        return $this->name === 'admin';
    }
    public function isClient()
    {
        return $this->name === 'client';
    }

    public function isUser()
    {
        return $this->name === 'user';
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
