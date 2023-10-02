<?php
require '../model/userModel.php';
$user = new User();
 
if (isset($_POST['Email_Address']) && isset($_POST['Password'])) {
  $email = $_POST['Email_Address'];
  $password = $_POST['Password'];
  
  $checkUser = $user->ifEmailExists($email);
  if($checkUser > 0){
    $checkCredentials = $user->ifUserExists($email, $password);
    if($checkCredentials !== null){
      $name = $checkCredentials['user_firstName'] . " " . $checkCredentials['user_lastName'];
      $email = $checkCredentials['user_email'];

      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['login_status'] = 1;
      $r['message'] = "success";

    }else{
      $r['message'] = "incorrect-access";
    }
  }else{
    $r['message'] = "email-not-found";
  }


}
echo json_encode($r);
?>

 
