<?php
    include_once("db_connection.php");
    class db_posts extends db_connection{
        function selectPost(){
            $query = "SELECT * FROM `posts` WHERE 1";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertPost ($id_user, $title, $content, $date_added){
            $query = "INSERT INTO `posts`( `id_user`, `title`, `content`, `date_added`) VALUES  ('".$id_user."','".$title."','".$content."','".$date_added."');";
            $data = mysqli_query($this->connect, $query);
            $this->close();
        }

        function deletePost ($id_post){
            $query = "Delete from posts where id_post =".$id_post.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_post']);
            $this->close();
        }

        function updatePost ($id_post, $id_user, $title, $content, $date_added, $id_approving_employee, $approval_date){
            $query = "UPDATE `posts` SET `id_user`='".$id_user."',`title`='".$title."',`content`='".$content."',`date_added`='".$date_added."',`id_approving_employee`='".$id_approving_employee."',`approval_date`='".$approval_date."' WHERE `id_post`=".$id_post.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_post']);
            $this->close();
        }

        function selectCheckedPost (){
            $query = "SELECT `id_post`, `id_user`, `title`, `content`, `date_added`, `approval_date` FROM `posts` WHERE approval_date != 0";
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>

