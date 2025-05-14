<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ManagementUsers extends BaseController
{
    public function getUser($id)
    {
        $users = new UserModel();
        // return "hello";
		// $exist = $users->where('id', $id)->first();
        return $this->response->setJSON(['hello' => $id]);
  
    }

    	public function update($id)
	{
		if (! $this->validate([
            'email' => 'permit_empty|is_unique[m_users.username,id,'.$id.']',
            'password' => 'permit_empty|min_length[6]',
        ])) {
            return $this->response->setJSON(['success' => false, "message" => \Config\Services::validation()->getErrors()]);
        }

		$db = new UserModel;
		$exist = $db->where('id', $id)->first();

		if( !$exist )
		{
			return $this->response->setJSON(['success' => false, "message" => 'User not found']);
		}
		
        $update = [
            'username' => $this->request->getVar('username') ? $this->request->getVar('username') : $exist['username'],
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $exist['password'],
			'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $exist['name'],
			'naaddressme' => $this->request->getVar('address')  ? $this->request->getVar('address') : $exist['address'],
			'phone' => $this->request->getVar('phone') ? $this->request->getVar('phone') : $exist['phone']
        ];

        $db = new UserModel;
        $save  = $db->update( $id, $update);

        return $this->response->setJSON(['success' => true,'message' => 'OK']);
	}

	public function deleteUser($id)
	{
		$db = new UserModel;
		$db->where('id', $id);
		$db->delete();
		
		return $this->response->setJSON( ['sucess'=> true, 'mesage' => 'OK'] );
	}

}
