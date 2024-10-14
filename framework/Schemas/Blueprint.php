<?php

namespace Framework\Schemas;

use Framework\Schemas\Interfaces\BlueprintInterface;

class Blueprint implements BlueprintInterface {
    private array $columns;

    public function __construct() {
        $this->columns = [];
    }

    public function getColumns(): array {
        return $this->columns;
    }

    public function id(string $name = 'id'): void {
        $this->columns[] = "`$name` INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
    }

    public function string(string $name, int $size = 255): static {
        $this->columns[] = "`$name` VARCHAR($size)";

        return $this;
    }

    public function timestamps(): void {
        $this->columns[] = "`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";

    }

    public function softDeletes(): void {
        $this->columns[] = "`deleted_at` TIMESTAMP NULL";
    }

    public function nullable(bool $status = true): void {
        $lastItem = array_pop($this->columns);

        if ($status) {
            $lastItem .= " NULL";
        } else {
            $lastItem .= " NOT NULL";
        }

        $this->columns[] = $lastItem;
    }

    public function unique(): static {
        $lastItem        = array_pop($this->columns);
        $lastItem        .= " UNIQUE";
        $this->columns[] = $lastItem;

        return $this;
    }
}
