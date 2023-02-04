<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $table = "employee_details";
    protected $primary_key = "id";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'profile_photo',
        'designation',
        'assigned_team',
        'company',
        // 'joinning_date',
        'gender',
        'languages',
        'intro',
    ];


}
