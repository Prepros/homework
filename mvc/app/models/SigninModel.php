<?php
namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SigninModel extends Eloquent
{
    protected $table = 'users';
}









//
//namespace app\core;
//
//class SigninModel extends Model
//{
//    // Здесь перечисляются методы работы с БД для контроллера
//    // с одноименным названием
//
//    public function signinUser($login, $password)
//    {
//        try {
//            $sql = 'SELECT id FROM users WHERE login = :login AND password = :password';
//            $s = $this->pdo->prepare($sql);
//            $s->bindValue(':login', $this->func->htmlout($login));
//            $s->bindValue(':password', $this->func->htmlout($password));
//            $s->execute();
//            $result = $s->fetch(\PDO::FETCH_ASSOC);
//
//            return $result;
//        } catch (\PDOException $e) {
//            echo "Логин или пароль не верны $e->getMessage()";
//            $_SESSION['message'] = "Логин или пароль не верны $e->getMessage()";
//            return false;
//        }
//    }
//
//
////    public function getUsers()
////    {
////        $sql = $this->pdo->query("SELECT * FROM users_data");
////        $result = $sql->fetchAll();
////        //print_r($result);
////    }
//}
