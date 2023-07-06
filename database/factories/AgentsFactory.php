<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agents>
 */
class AgentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'masterId'=>1, 
            'agentUserId'=>'WCSC00000',
            'cscId'=>null, 
            'email'=>9711393536, 
            'mobile'=>9711393536, 
            'firstName'=>'NDLS', 
            'middleName'=>'TATA', 
            'lastName'=>'', 
            'dob'=>'', 
            'address'=>'2023-08-04', 
            'office_address'=>'10:40', 
            'cityId'=>'17:00', 
            'stateId'=>1, 
            'countryId'=>'', 
            'pincode'=>'', 
            'officePinCode'=>'', 
            'panNumber'=>'', 
            'gender'=>99, 
            'status'=>'', 
            ];
    }
}
