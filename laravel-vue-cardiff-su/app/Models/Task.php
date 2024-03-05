<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * These attributes can be set using the create() or update() methods.
     * By specifying which attributes are fillable, we protect against mass assignment vulnerabilities.
     *  
     * @var array
     */
    protected $fillable = [
        'user_name',
        'task_description',
        'priority',
        'due_date',
    ];
}
