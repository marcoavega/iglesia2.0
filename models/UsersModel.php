<?php
class UsersModel extends Model
{
    public function set($user_data = array())
    {
        foreach ($user_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $user = test_input($_POST['user']);
        $password = test_input($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->query = "REPLACE INTO users (id_user, user, password, img, role) VALUES ('$id_user', '$user', '$password', '$img', '$role')";
        $this->set_query();
    }

    public function get($user = '')
    {
        $this->query = ($user != '')
            ? "SELECT * FROM users WHERE user = '$user'"
            : "SELECT * FROM users";

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($user = '')
    {
        $this->query = "DELETE FROM users WHERE user = '$user'";
        $this->set_query();
    }

    public function validate_user($user, $password)
    {

        function test_input_validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $user = test_input_validate($user);
        $password = test_input_validate($password);

        $this->query = "SELECT * FROM users WHERE user = '$user'";
        $this->get_query();

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }


        if (password_verify($password, $value['password'])) {
            return $data;
        }
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}