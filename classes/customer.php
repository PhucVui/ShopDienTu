<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" ||
            $address == "" || $country == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'>Properties is not empty</span>";
            return $alert;
        } else {
            $check_mail = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_mail);
            if ($result_check) {
                $alert = "<span class ='error'>Email already exits</span>";
                return $alert;
            }
            $query = "INSERT INTO tbl_customer(name, city, zipcode, email, address, country, phone, password) VALUES('$name',
                    '$city','$zipcode','$email','$address','$country','$phone', '$password')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Create account successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Create account not success</span>";
                return $alert;
            }
        }
    }
    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == "" || $password == "") {
            $alert = "<span class='error'>Email and Password must be not empty</span>";
            return $alert;
        } else {
            $check = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $result_check = $this->db->select($check);
            if ($result_check) {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:order.php');
            } else {
                $alert = "<span class ='error'>Email or Password not match</span>";
                return $alert;
            }
        }
    }
    public function show_customer($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_customer($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if ($name == "" || $email == "" ||
            $address == "" || $phone == "") {
            $alert = "<span class='error'>Properties is not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer SET name='$name', email ='$email', address = '$address',  phone='$phone' WHERE id = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Customer updated successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Create updated not success</span>";
                return $alert;
            }
        }
    }
}