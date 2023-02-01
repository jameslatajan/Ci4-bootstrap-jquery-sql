<?php


namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{

    public function index()
    {
        $data['pageTitle'] = 'Home';

        $umodel = new UserModel();
        $builder = $umodel->table('users_tb');
        $query   = $builder->get();
        $data['listUsers'] = $query;

       return view('dashboard/home',$data);

    }

    public function profile(){
        $data['pageTitle'] = 'Profile';
       return view('dashboard/profile',$data);
    }
}
