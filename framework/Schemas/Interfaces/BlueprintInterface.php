<?php

namespace Framework\Schemas\Interfaces;

interface BlueprintInterface {
    public function getColumns(): array;

    public function id(string $name = 'id'): void;

    public function string(string $name, int $size = 255): static;

    public function timestamps(): void;

    public function softDeletes(): void;

    public function nullable(bool $status = true): void;

    public function unique(): static;
}