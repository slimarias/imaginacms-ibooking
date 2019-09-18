<?php

namespace Modules\Ibooking\Events\Handlers;
use Illuminate\Http\Request;

class UserCreate
{
   
    public $userRepository;
    public $roleRepository;
    //public $fieldApiRepository;
   
    public function __construct()
    {
       $this->userRepository = app('Modules\User\Repositories\UserRepository');
       $this->roleRepository = app('Modules\User\Repositories\RoleRepository');
       $this->fieldApiRepository = app('Modules\Iprofile\Http\Controllers\Api\FieldApiController');
    }

    public function handle($event)
    {

        $data = $event->data;
       
        if(!isset($data["customer_id"])){
            $exist = \DB::table('users')->where('email', $data["email"])->first();
            if (!$exist) {

                $roleCustomer = $this->roleRepository->findByName('User');
                $data['password'] = str_random(8);

                $user = $this->userRepository->createWithRoles($data, $roleCustomer, true);
            
                $data["customer_id"] = $user->id;

                // add fields
                if(isset($data["fields"])){
                    $field = [];
                    foreach ($data["fields"] as $key => $value) {
                        if(!empty($value) && $value!=null){
                            $field['user_id'] = $user->id;// Add user Id
                            $field['value'] = $value;
                            $field['name'] = $key;

                            $this->fieldApiRepository->create(new Request(['attributes' => $field]));

                        }
                    }
                }

            }else{
                $data["customer_id"] = $exist->id;
            }
           
        }

        return $data;

    }

    

}
