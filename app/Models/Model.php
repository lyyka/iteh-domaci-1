<?php

abstract class Model
{
    protected ?int $id = null;
    private string $createdAtTimestamp;
    private string $updatedAtTimestamp;

    abstract public function getTableName() : string;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCreatedAtTimestamp(): string
    {
        return $this->createdAtTimestamp;
    }

    /**
     * @param string $createdAtTimestamp
     */
    public function setCreatedAtTimestamp(string $createdAtTimestamp): void
    {
        $this->createdAtTimestamp = $createdAtTimestamp;
    }

    /**
     * @return string
     */
    public function getUpdatedAtTimestamp(): string
    {
        return $this->updatedAtTimestamp;
    }

    /**
     * @param string $updatedAtTimestamp
     * @return Model
     */
    public function setUpdatedAtTimestamp(string $updatedAtTimestamp): Model
    {
        $this->updatedAtTimestamp = $updatedAtTimestamp;
        return $this;
    }
}
