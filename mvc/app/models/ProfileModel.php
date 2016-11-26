<?php
namespace app\models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ProfileModel extends Eloquent
{
    protected $table = 'users';
}




//
//namespace app\core;
//
//class ProfileModel extends Model
//{
//    // Здесь перечисляются методы работы с БД для контроллера
//    // с одноименным названием
//    public function getProfile($id)
//    {
//        try {
//            $sql = 'SELECT *, inet_ntoa(ip) as ip
//                    FROM users
//                    LEFT JOIN users_data
//                    ON users.id = users_data.id
//                    WHERE users.id = :id';
//            $s = $this->pdo->prepare($sql);
//            $s->bindValue(':id', $this->func->htmlout($id));
//            $s->execute();
//            $result = $s->fetch(\PDO::FETCH_ASSOC);
//            return $result;
//        } catch (\PDOException $e) {
//            $_SESSION['message'] = 'Не удалось получить данные пользователя!';
//            exit;
//        }
//    }
//
//    public function insertPhoto($photo, $id)
//    {
//        try {
//            $sql = 'INSERT INTO users_upload (id, photo) VALUES (:id, :photo)';
//            $s = $this->pdo->prepare($sql);
//            $s->bindValue(':id', $this->func->htmlout($id));
//            $s->bindValue(':photo', $this->func->htmlout($photo));
//            $s->execute();
//            return true;
//        } catch (\PDOException $e) {
//            $_SESSION['message'] = "Ошибка добавления картинки $e->getMessage()";
//            return false;
//        }
//    }
//
//    public function getAllPhoto($id)
//    {
//        try {
//            $sql = 'SELECT photo FROM users_upload WHERE id = :id';
//            $s = $this->pdo->prepare($sql);
//            $s->bindValue(':id', $id);
//            $s->execute();
//            $result = $s->fetchALL(\PDO::FETCH_ASSOC);
//            return $result;
//        } catch (\PDOException $e) {
//            $_SESSION['message'] = 'Ошибка выборки фото';
//            exit;
//        }
//    }
//}