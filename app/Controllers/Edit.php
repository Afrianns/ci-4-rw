<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Edit extends BaseController
{
    use ResponseTrait;

    public function index($id)
    {
        $users = new UserModel;
        // return "hello";
		// $exist = $users->where('id', $id)->first();
        return $this->response->setJSON(['hello' => $id]);
    }
}
