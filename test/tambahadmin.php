<?php
class Pw_db {
   public function PwGenerate($input) {
    $password = $input;
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    return $hashedPassword;
   }
   
}

$pw_db = new Pw_db();
$inputUsername = readline("Masukkan Username :");
$inputPassword = readline("Masukkan Password :");
$hashedPassword = $pw_db->PwGenerate($inputPassword);

print_r("Username: $inputUsername");
echo " \r\n";
print_r("Password Yang Di HASH : $hashedPassword");
echo "\r\n";

// verify 
$Username = readline("Masukkan User Tadi :");
$Password = readline("Masukkan PW Tadi :");

if ($Username === $inputUsername) {
    if($Password === $inputPassword) {
        echo "Berhasil LOGIN >>>>>>>";
    } else {
        echo "Password salah";
    }
} else {
    echo "Username Salah";
}

?>