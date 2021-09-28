<?php

namespace App\Actions\Fortify;

use App\Models\CandidateProfile;
use App\Models\EmployeeProfile;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        $url = array_reverse(explode('/', url()->previous()));

        $register_type = $url[1];

        if ($register_type === "employee") {

            Validator::make($input, [
                'company_name' => "required",
                'first_name' => "required",
                'last_name' => "required",
                "phone" => "required|size:11|unique:employee_profiles,phone",
                "logo" => "image|mimes:jpeg,png,jpg|max:1024",
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),

            ])->validate();

            if(empty($input['logo'])) {

                $image_name = 'company_logo_blank.png';
            } else {

                $image = $input['logo'];

                $image_name = date('YmdHis') .'.' . $image->getClientOriginalExtension();

                $full_path = 'assets/images/company_logo/';

                $image->move($full_path, $image_name);
            }

            $user = User::create([
                'name' => $input['first_name'] . ' ' . $input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'type' => 'employee',
            ]);

            EmployeeProfile::create([
                "first_name" => $input['first_name'],
                "last_name" => $input['last_name'],
                "company_name" => $input['company_name'],
                "phone" => $input['phone'],
                "logo" => $image_name,
                "user_id" => $user->id,
            ]);

            return $user;
        } elseif ($register_type === 'candidate') {

            Validator::make($input, [
                'first_name' => "required",
                'last_name' => "required",
                "phone" => "required|size:11|unique:employee_profiles,phone",
                "photo" => "image|mimes:jpeg,png,jpg|max:1024",
                'career' => 'required',
                "street" => "required",
                "building" => "required|integer",
                "country" => "required|max:30",
                "city" => "required|max:30",
                "region" => "required|max:30",
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),

            ])->validate();

            if(empty($input['photo'])) {

                $image_name = 'default-profile-pic.jpg';
            } else {

                $image = $input['photo'];

                $image_name = date('YmdHis') .'.' . $image->getClientOriginalExtension();

                $full_path = 'assets/images/candidate_photo/';

                $image->move($full_path, $image_name);
            }

            $careers = "";

            foreach ($input['career'] as $id => $status) {

                $careers .= $id . ',';
            }

            $location = Location::create([
                "country" => $input['country'],
                "city" => $input['city'],
                "region" => $input['region'],
                "building" => $input['building'],
                "street" => $input['street'],
            ]);


            $user = User::create([
                'name' => $input['first_name'] . ' ' . $input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'type' => 'candidate',
            ]);

            CandidateProfile::create([
                "first_name" => $input['first_name'],
                "last_name" => $input['last_name'],
                "careers" => $careers,
                "phone" => $input['phone'],
                "photo" => $image_name,
                "location_id" => $location->id,
                "user_id" => $user->id,
            ]);

            return $user;
        }


    }
}
