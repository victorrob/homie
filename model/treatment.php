<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 09/04/2018
 * Time: 16:55
 */
$sql = "SELECT * from users WHERE email=:email AND password=:password";
$request = $PDO->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$request->execute([':email' => $email, ':password' => $password]);
return [$sql, $request->fetchAll()];