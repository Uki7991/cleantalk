<?php

namespace Src\App\Models;

use App\Models\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'email',
        'phone',
        'manager_id',
        'notes',
    ];

    public function children()
    {
        return $this->hasMany(Employee::class, 'manager_id', 'id');
    }

    public function getChildren()
    {
        return $this->children()->get();
    }
}