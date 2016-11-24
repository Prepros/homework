<?php
namespace app\core;

class UsersModel extends Model
{
    public function getUsersAll()
    {
        try {
            $sql = 'SELECT * FROM users_data ORDER BY age ASC';
            $s = $this->pdo->query($sql);
            $result['users'] = $s->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            $_SESSION['message'] = "Что то пошло не так $e->getMessage()";
            return false;
        }
    }
}