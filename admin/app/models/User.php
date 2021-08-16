<?php


namespace App\Models;


use App\Database\Conn;

class User extends Person
{
    private string $password;
    protected static $tableName = 'users';

    public static function getTableColumns()
    {
        return array_merge(['password'], parent::getTableColumns());
    }

    public static function check(User $user)
    {
        $pdo = Conn::getInstance();
        $stm = $pdo->prepare('SELECT * FROM users WHERE cpf LIKE :cpf AND password LIKE :password AND deleted_at IS NULL');
        $stm->bindValue(':cpf', $user->getCpf());
        $stm->bindValue(':password', $user->getPassword());
        if ($stm->execute()) {
            if ($row = $stm->fetch()) {
                $user = User::getUserFromRow($row);
                return $user;
            }
        }
        return false;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAge()
    {
        return $this->getBirthday()->diff(new \DateTime())->format('%Y');
    }

    public function save()
    {
        $pdo = Conn::getInstance();
        if (empty($this->getId())) {
            $stm = $pdo->prepare('SELECT cpf FROM users WHERE cpf like :cpf');
            $stm->bindValue(':cpf', $this->getCpf());
            if ($stm->execute()) {
                if ($row = $stm->fetch()) {
                    return [
                        'error' => 8 //CPF Já Cadastrado
                    ];
                }
            }
        }
        $stm = $pdo->prepare('INSERT INTO users SET privilege = 1, id=:id, name = :name,
                            cpf = :cpf, birthday = :birthday, password = :password, created_at = now(), updated_at = now()
                             ON DUPLICATE KEY UPDATE name = :name, birthday = :birthday, password = :password, updated_at = now()
                                ');
        $stm->bindValue(':id', $this->getId());
        $stm->bindValue(':name', $this->getName());
        $stm->bindValue(':cpf', $this->getCpf());
        $stm->bindValue(':birthday', $this->getBirthday()->format('Y-m-d'));
        $stm->bindValue(':password', $this->getPassword());
        $success = $stm->execute();
        if($success && !$this->getId()){
            $this->setId($pdo->lastInsertId());
        }
        return $success;
    }


    private static function getUserFromRow($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setName($row['name']);
        $user->setCpf($row['cpf']);
        $user->setBirthday($row['birthday']);
        $user->setCreatedAt($row['created_at']);
        $user->setUpdatedAt($row['updated_at']);
        return $user;
    }
}