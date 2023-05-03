<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    use HasFactory;
    protected $table = 'agents';
    public $timestamps = false;
    protected $fillable = [
        'masterId', 'agentUserId', 'cscId',
         'requestType', 'email', 'mobile',
          'firstName', 'middleName','lastName','dob','address',
          'office_address', 'cityId', 'stateId','countryId','pincode',
          'officePinCode','panNumber', 'gender', 'status', 'created', 'updated'
    ];
    const CREATED_AT = 'created';
}
