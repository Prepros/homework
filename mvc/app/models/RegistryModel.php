<?php
namespace app\core;

class RegistryModel extends Model
{
    // Здесь перечисляются методы работы с БД для контроллера
    // с одноименным названием
    public function registryUser($login, $pass, $name, $age, $about, $photo, $ip)
    {
        try {
            $sql = 'INSERT INTO users (login, password) VALUES (:login, :password)';
            $s = $this->pdo->prepare($sql);
            $s->bindValue(':login', $this->func->htmlout($login));
            $s->bindValue(':password', $this->func->htmlout($pass));
            $s->execute();

            $sql = 'INSERT INTO users_data (name, age, about, ava, ip) VALUES (:name, :age, :about, :ava, INET_ATON(:ip))';
            $s = $this->pdo->prepare($sql);
            $s->bindValue(':name', $this->func->htmlout($name));
            $s->bindValue(':age', $this->func->htmlout($age));
            $s->bindValue(':about', $this->func->htmlout($about));
            $s->bindValue(':ava', $this->func->htmlout($photo));
            $s->bindValue(':ip', $this->func->htmlout($ip));
            $s->execute();

            return true;
        } catch (\PDOException $e) {
            $_SESSION['message'] = "Ошибка регистрации пользователя $e->getMessage()";
            return false;
        }
    }

    public function issetUser($login)
    {
        try {
            $sql = 'SELECT login FROM users WHERE login = :login';
            $s = $this->pdo->prepare($sql);
            $s->bindValue(':login', $this->func->htmlout($login));
            $s->execute();
            $result = $s->fetchAll(\PDO::FETCH_ASSOC);
//            print_r($result); exit;
            if ($result) {
                return true;
            }
            return false;
        } catch (\PDOException $e) {

        }

    }
}
