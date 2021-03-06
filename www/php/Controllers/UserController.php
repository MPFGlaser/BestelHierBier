<?php
namespace Controllers;

use Controllers\BaseController;
use Models\User;

class UserController extends BaseController
{
    // Creates a user with the entered details
    public function create($username, $email, $password)
    {
        $data = array(
            'UserName' => $username,
            'PassWord' => md5($password),
            'EMail' => $email
        );
        $this->db->insert("users", $data);
        return $this->checkPassword($username, $password);
    }

    // Gets a user based on the given id
    public function get($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $params = array('id' => $id);
        $result = $this->db->select($sql, $params);
        return new User($result[0]);
    }

    // Updates all but the password
    public function update(User $user)
    {
        $data = array(
            'UserName' => $user->get_name(),
            'EMail' => $user->get_email(),
            'admin' => $user->is_admin()
        );
        $where = "id=" . $user->get_id();
        $this->db->update("users", $data, $where);
    }

    // Updates the password of the given user
    public function updatePassword(User $user, $newPassword)
    {
        $data = array('PassWord' => md5($newPassword));
        $where = "id=" . $user->get_id();
        $this->db->update("users", $data, $where);
    }

    // Checks if the entered password matches the one found in the database
    public function checkPassword($username, $password)
    {
        $user = null;
        $sql = "SELECT * FROM users WHERE UserName = :UserName AND PassWord = :PassWord";
        $params = array(
            'UserName' => $username,
            'PassWord' => md5($password)
        );
        $result = $this->db->select($sql, $params);

        if ($result != null) {
            $user = new User($result[0]);
            $_SESSION['User'] = serialize($user);
            return true;
        }
        return false;
    }
}
