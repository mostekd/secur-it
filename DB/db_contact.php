<?php
    include_once("db_connection.php");
    class db_contact extends db_connection{
        function selectContact(){
            $query = 'SELECT cf.*, u.first_name AS ufn, u.last_name AS uln, cc.country_code FROM `contact_form` AS cf
            LEFT JOIN users AS u ON u.id_employee = cf.id_employee
            JOIN country_codes AS cc ON cc.id_country_code = cf.id_country_code
            WHERE 1;';
            $this->wQueryToFile($query);
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertContact ($first_name, $last_name, $email, $id_country_code, $phone_number, $title, $message, $consent){
            $query = "INSERT INTO `contact_form` (`first_name`, `last_name`, `email`, `id_country_code`, `phone_number`, `title`, `message`, `consent`) VALUES ('".$first_name."','".$last_name."','".$email."','".$id_country_code."','".$phone_number."','".$title."','".$message."','".$consent."');";
            $data = mysqli_query($this->connect, $query);
            if ($data) {
                $this->close();
                $$_GET = array();
                return 1; // Wiadomosc wysłana
            }
        }

        function deleteContact($id_contact_form){
            $query = "Delete from contact_form where id_contact_form =".$id_contact_form.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateContact($id_contact_form, $first_name, $last_name, $email, $id_country_code, $phone_number, $title, $message, $consent, $id_employee){
            $query = "UPDATE `contact_form` SET `first_name`=".$first_name.",`last_name`=".$last_name.",`email`=".$email.",`id_country_code`=".$id_country_code.",`phone_number`=".$phone_number.",`title`=".$title.",`message`=".$message.",`consent`=".$consent.",`id_employee`=".$id_employee." WHERE  `id_contact_form`=".$id_contact_form.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_contact_form']); 
            $this->close();
        }

        function selectContactByID($id_contact_form){
            $query = "SELECT * FROM `contact_form` WHERE id_contact_form =".$id_contact_form;
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }

        function updateContactSetEmployee($id_contact_form, $id_employee){
            $query = "UPDATE `contact_form` SET `id_employee`=".$id_employee." WHERE  `id_contact_form`=".$id_contact_form.";";
            $this->wQueryToFile($query);    
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_contact_form']); 
            $this->close();
        }
    }
?>