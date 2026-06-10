<?php
//functionaly test, select fitler year

session_start();
requireValidSession();

$user = $_SESSION['user'];
$users = null;
if ($user->is_admin){   
    $users = User::getResultFromDataBase();
}  
?>

<form action="#" method="POST">
    <select name="period" placeholder="select the period...">
        <?php
            foreach($users as $user){
                echo "<option value='{$user->id}'>{$user->name}</option>";
            }
        ?>
    </select>
    <button>send</button>
</form>





