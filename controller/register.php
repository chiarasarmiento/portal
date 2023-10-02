<?php
require '../model/userModel.php';
$user = new User();
 
if (isset($_POST['First_Name']) && isset($_POST['Last_Name']) && isset($_POST['Email_Address']) && isset($_POST['Password']) && isset($_POST['Confirm_Password'])) {
  $first_name = $_POST['First_Name'];
  $last_name = $_POST['Last_Name'];
  $email = $_POST['Email_Address'];
  $password = $_POST['Password'];
  $confirm_password = $_POST['Confirm_Password'];

  $checkUser = $user->ifEmailExists($email);
  if($checkUser == 0){
    if($password == $confirm_password){
      $register = $user->createUser($first_name,$last_name,$email,md5($password));

      if($register == true) {
        $r['message'] = "success";
      }else{
        $r['message'] = "failed";
      }
    }else{
      $r['message'] = "password-error";
    }
  }else{
    $r['message'] = "exists";
  }
}
echo json_encode($r);

?>