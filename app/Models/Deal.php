<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Model.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/Product.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/ContactModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Models/SalesPerson.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/DealRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/SalesPeopleRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ProductRepo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Repositories/ContactModelRepo.php";

class Deal extends Model
{
    private int $contactId;
    private int $productId;
    private int $salesPersonId;
    private ?float $dealValue;
    private ?string $dealValueCurrency;
    private ?string $notes;

    /**
     * @throws Exception
     */
    public function save() : void
    {
        (new DealRepo)->save($this);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function delete() : void
    {
        (new DealRepo)->delete($this);
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'deals';
    }

    public function getContact() : ?ContactModel
    {
        if($id = $this->getContactId()) {
            return (new ContactModelRepo())->getById($id);
        }

        return null;
    }

    public function getProduct() : ?Product
    {
        if($id = $this->getProductId()) {
            return (new ProductRepo())->getById($id);
        }

        return null;
    }

    public function getSalesPerson() : ?SalesPerson
    {
        if($id = $this->getSalesPersonId()) {
            return (new SalesPeopleRepo())->getById($id);
        }

        return null;
    }

    /**
     * @return string
     */
    public function getDealValueLabel() : string
    {
        if($this->getDealValue()) {
            return "{$this->getDealValueCurrency()} {$this->getDealValue()}";
        }

        return '/';
    }

    /**
     * @return int
     */
    public function getContactId(): int
    {
        return $this->contactId;
    }

    /**
     * @param int $contactId
     */
    public function setContactId(int $contactId): void
    {
        $this->contactId = $contactId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getSalesPersonId(): int
    {
        return $this->salesPersonId;
    }

    /**
     * @param int $salesPersonId
     */
    public function setSalesPersonId(int $salesPersonId): void
    {
        $this->salesPersonId = $salesPersonId;
    }

    /**
     * @return float|null
     */
    public function getDealValue(): ?float
    {
        return $this->dealValue;
    }

    /**
     * @param float|null $dealValue
     */
    public function setDealValue(?float $dealValue): void
    {
        $this->dealValue = $dealValue;
    }

    /**
     * @return string|null
     */
    public function getDealValueCurrency(): ?string
    {
        return $this->dealValueCurrency;
    }

    /**
     * @param string|null $dealValueCurrency
     */
    public function setDealValueCurrency(?string $dealValueCurrency): void
    {
        $this->dealValueCurrency = $dealValueCurrency;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string|null $notes
     */
    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }
}
