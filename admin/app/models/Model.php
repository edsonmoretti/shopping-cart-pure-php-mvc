<?php


namespace App\Models;

use App\Database\Conn;
use DateTime;

class Model extends AbstractClass
{
    private $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?DateTime $deletedAt;
    protected static $tableName;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = new \DateTime($createdAt);
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt ?? null;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = new \DateTime($updatedAt);
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt ?? null;
    }

    /**
     * @param DateTime $deletedAt
     */
    public function setDeletedAt($deletedAt): void
    {
        $this->deletedAt = new \DateTime($deletedAt);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public static function getTableColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

    public static function all($withDeleted = false)
    {
        $models = new \ArrayObject();
        $pdo = Conn::getInstance();
        $stm = $pdo->prepare("SELECT * FROM " . static::$tableName . ($withDeleted ? '' : ' WHERE deleted_at IS NULL'));
        if ($stm->execute()) {
            while ($row = $stm->fetch()) {
                $models->append(self::getModelFromRow($row));
            }
        }
        return $models;
    }

    public static function findById($id, $class = null)
    {
        $pdo = Conn::getInstance();
        $stm = $pdo->prepare("SELECT * FROM " . ($class ? $class::$tableName : static::$tableName) . " WHERE id = :id");
        $stm->bindValue(':id', $id);

        if ($stm->execute()) {
            if ($row = $stm->fetch()) {
                return self::getModelFromRow($row);
            }
        }
        return false;
    }

    public function destroy()
    {
        $pdo = Conn::getInstance();
        $stm = $pdo->prepare("UPDATE " . static::$tableName . " SET deleted_at = now() WHERE id = :id");
        $stm->bindValue(':id', $this->getId());
        if ($stm->execute()) {
            return $this;
        }
        return false;
    }

    public function toArray()
    {
        $class = static::class;
        $return = [];
        foreach (array_merge(Model::getTableColumns(), $class::getTableColumns()) as $columName) {
            $var = '';
            foreach (explode('_', $columName) as $str) {
                $var .= ucfirst(strtolower($str));
            }
            $setMethod = 'get' . ucfirst($var);
            $return[$columName] = $this->$setMethod();
        }
        return $return;
    }

    private static function getModelFromRow($row)
    {
        $class = static::class;
        $model = new $class();

        foreach (array_merge(Model::getTableColumns(), $class::getTableColumns()) as $columName) {
            $var = '';
            foreach (explode('_', $columName) as $str) {
                $var .= ucfirst(strtolower($str));
            }
            $setMethod = 'set' . ucfirst($var);
            $model->$setMethod($row[$columName]);
        }
        return $model;
    }

}