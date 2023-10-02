<?php
require '../model/userModel.php';
$user = new User();
 
if (isset($_POST['Email_Address']) && isset($_POST['Old_Password']) && isset($_POST['New_Password'])) {
  $email = $_POST['Email_Address'];
  $old_password = $_POST['Old_Password'];
  $new_password = $_POST['New_Password'];
  
  $checkUser = $user->ifEmailExists($email);
  if($checkUser > 0){
    $checkCredentials = $user->ifUserExists($email, $old_password);
    if($checkCredentials !== null){
        if(md5($old_password) == $checkCredentials['user_password']){
            $updatePassword = $user->updateUserPassword($email, $new_password);
            if($updatePassword == true){
                $r['message'] = "success";
            }
        }else{
            $r['message'] = "incorrect-old-pass";
        }
    }else{
      $r['message'] = "incorrect-old-pass";
    }
  }else{
    $r['message'] = "email-not-found";
  }

}
echo json_encode($r);
?>

 
