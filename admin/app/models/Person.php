<?php


namespace App\Models;


use ArrayObject;
use DateTime;

class Person extends Model
{
    private string $name;
    private string $cpf;
    private DateTime $birthday;
    private ?ArrayObject $addresses;
    private ?ArrayObject $phones;
    private ?ArrayObject $emails;

    public static function getTableColumns()
    {
        return ['name', 'cpf', 'birthday'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name??'';
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
    public function getCpf(): string
    {
        return $this->cpf??'';
    }

    /**
     * @param string $cpf
     */
    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): ?DateTime
    {
        return $this->birthday??null;
    }

    public function setBirthday($birthday): void
    {
        $this->birthday = new \DateTime($birthday);
    }

    /**
     * @return ArrayObject|null
     */
    public function getAddresses(): ?ArrayObject
    {
        return $this->addresses;
    }

    /**
     * @param ArrayObject|null $addresses
     */
    public function setAddresses(?ArrayObject $addresses): void
    {
        $this->addresses = $addresses;
    }

    /**
     * @return ArrayObject|null
     */
    public function getPhones(): ?ArrayObject
    {
        return $this->phones;
    }

    /**
     * @param ArrayObject|null $phones
     */
    public function setPhones(?ArrayObject $phones): void
    {
        $this->phones = $phones;
    }

    /**
     * @return ArrayObject|null
     */
    public function getEmails(): ?ArrayObject
    {
        return $this->emails;
    }

    /**
     * @param ArrayObject|null $emails
     */
    public function setEmails(?ArrayObject $emails): void
    {
        $this->emails = $emails;
    }



}