<?php
include('./head_admin.php');
?>
        <div class="panel_lewy">
            <a class="przycisk" href="./book_list.php"><i class="fa-solid fa-book" style="color: #fff;"></i> Książki</a>
        </div>

        <?php
         include('../DB/db_book.php');
         $baza = new db_services();
         
            if(!empty($_GET)){                
                $baza->databaseConnect();
                $id_service=$_GET['id_service'];
                $data = $baza->selectServiceById($id_service);
                if (!empty($data)){
                    while($row = mysqli_fetch_assoc($data))
                    {
                        echo "<form class='MyForm' action='./book_list.php' method = 'get'>
							<input type=text name='id_service_type' placeholder='id_service_type' id='id_service_type' class='id_service_type' value=".$row['id_service_type']."></input>
							<input type=text  name='name' placeholder='nazwa' id='name' class='name' value=".$row['name']."></input>
							<textarea type=text name='description' placeholder='opis' id='description' class='description' value=".$row['description']."></textarea>
							<input type=month name='price' placeholder='cena' id='price' class='price' value=".$row['price']."></input>";
						echo "<input type=hidden name='id_service' id='id_service' class='id_service' value=".$row['id_service']."></input>
							<input type=hidden name='opcja' id='opcja' class='opcja' value='edytuj'></input>
							<input type='submit'></input>
							</form>";
                    }
                }
            }
        ?>

        
    </body>
</html>