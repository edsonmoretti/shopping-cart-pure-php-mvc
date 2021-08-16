<?php


namespace App\Models;


use App\Database\Conn;

class Product extends Model
{
    private string $name;
    private string $gtin;
    private string $description;
    private $price;
    private $stockQuantity;
    private $image;

    protected static $tableName = 'products';

    public static function getTableColumns()
    {
        return [
            'name',
            'gtin',
            'description',
            'price',
            'stock_quantity',
            'image'
        ];
    }

    /**
     * @return string
     */
    public function getGtin(): ?string
    {
        return $this->gtin ?? null;
    }

    /**
     * @param string $gtin
     */
    public function setGtin(string $gtin): void
    {
        $this->gtin = $gtin;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name ?? '';
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description ?? '';
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getStockQuantity()
    {
        return $this->stockQuantity;
    }

    /**
     * @param mixed $stockQuantity
     */
    public function setStockQuantity($stockQuantity): void
    {
        $this->stockQuantity = $stockQuantity;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image ?? null;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function save()
    {
        $pdo = Conn::getInstance();
        $stm = $pdo->prepare('INSERT INTO products SET
                                        id = :id, 
                                        gtin = :gtin, 
                                        name = :name, 
                                        description = :description, 
                                        price = :price, 
                                        stock_quantity = :stock_quantity, 
                                        ' . ($this->getImage() ? 'image = :image,' : '') . ' 
                                        created_at = now(), 
                                        updated_at = now()
                                       ON DUPLICATE KEY UPDATE 
                                        name = :name,
                                        gtin = :gtin, 
                                        description = :description, 
                                        price = :price, 
                                        stock_quantity = :stock_quantity, 
                                        ' . ($this->getImage() ? 'image = :image,' : '') . ' 
                                        updated_at = now()
                                       ');
        $stm->bindValue(':id', $this->getId());
        $stm->bindValue(':name', $this->getName());
        $stm->bindValue(':gtin', $this->getGtin());
        $stm->bindValue(':description', $this->getDescription());
        $stm->bindValue(':price', $this->getPrice());
        $stm->bindValue(':stock_quantity', $this->getStockQuantity());
        if ($this->getImage())
            $stm->bindValue(':image', $this->getImage());

        $success = $stm->execute();
        if ($success && !$this->getId()) {
            $this->setId($pdo->lastInsertId());
        }
        return $success;
    }
}