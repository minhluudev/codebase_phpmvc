<?php

namespace Core\Model;

trait QueryModelTrait
{
    private static string $query = '';
    private static string $select = '*';
    private static array $where = [];
    private static array $orderBy = [];

    public static function select(array $columns = ['*']): static
    {
        $instance = new static();
        self::$select = implode(', ', $columns);
        return $instance;
    }

    public static function where(string $column, string $operator, string $value): static
    {
        self::$where[] = "`$column`" . ' ' . $operator . ' ' . $value;
        return new static();
    }

    public static function whereIn(string $column, array $values): static
    {
        $values = implode(', ', $values);
        self::$where[] = "`$column` IN ($values)";
        return new static();
    }



    public function get(): string
    {
        $query = 'SELECT ' . self::$select . ' FROM ' . $this->getTableName();
        if (!empty(self::$where)) {
            $query .= ' WHERE ' . implode(' AND ', self::$where);
        }

        return $query;
    }

}