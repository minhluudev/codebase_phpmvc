<?php

namespace Framework\Databases\Traits;

use PDOException;

trait StaticModelTrait {
    private static string $query   = '';
    private static string $select  = '*';
    private static string $where   = '';
    private static array  $orderBy = [];

    public static function create(array $data) {
        $instance      = new static();
        $table         = $instance->getTableName();
        $fields        = implode('`, `', $instance->fillable);
        $convertValues = array_map(fn($value) => $data[$value] ?? null, $instance->fillable);
        $values        = implode("', '", $convertValues);
        $query         = "INSERT INTO $table (`$fields`) VALUES ('$values')";

        try {
            $stmt = $instance->pdo->prepare($query);
            $stmt->execute();
            $lastInsertId = $instance->pdo->lastInsertId();

            return self::findById($lastInsertId);
        } catch ( PDOException $e ) {
            return $e->getMessage();
        } finally {
            self::resetProperties();
        }
    }

    public static function findById(int $id) {
        $instance = new static();
        $table    = $instance->getTableName();
        $query    = "SELECT * FROM $table WHERE id = $id";

        try {
            $stmt = $instance->pdo->prepare($query);
            $stmt->execute();

            return $stmt->fetch();
        } catch ( PDOException $e ) {
            return $e->getMessage();
        } finally {
            self::resetProperties();
        }
    }

    private static function resetProperties(): void {
        self::$query   = '';
        self::$select  = '*';
        self::$where   = '';
        self::$orderBy = [];
    }

    public static function all(): static {
        return new static();
    }

    public static function select(array $columns = ['*']): static {
        $instance     = new static();
        self::$select = implode(', ', $columns);

        return $instance;
    }

    public static function where(string $column, string $operator, mixed $value): static {
        $instance = new static();
        $where    = "$column $operator '$value'";
        if (self::$where) {
            self::$where .= " AND $where";
        } else {
            self::$where = $where;
        }

        return $instance;
    }

    public static function whereLike(string $column, mixed $value): static {
        $instance = new static();
        $where    = "$column LIKE '%$value%'";
        if (self::$where) {
            self::$where .= " AND $where";
        } else {
            self::$where = $where;
        }

        return $instance;
    }

    public static function orWhere(string $column, string $operator, mixed $value): static {
        $instance = new static();
        $where    = "$column $operator '$value'";
        if (self::$where) {
            self::$where .= " OR $where";
        } else {
            self::$where = $where;
        }

        return $instance;
    }

    public static function orderByAsc(string $column): static {
        $instance        = new static();
        self::$orderBy[] = "$column ASC";

        return $instance;
    }

    public static function orderByDesc(string $column): static {
        $instance        = new static();
        self::$orderBy[] = "$column DESC";

        return $instance;
    }

    public function get(): array | null {
        try {
            $select  = self::$select;
            $where   = self::$where;
            $orderBy = implode(', ', self::$orderBy);
            $table   = $this->getTableName();
            $query   = "SELECT $select FROM $table ";

            if ($where) {
                $query .= " WHERE $where";
            }

            if ($orderBy) {
                $query .= " ORDER BY $orderBy";
            }

            $stmt = $this->pdo->prepare(str_replace(':table_name', $table, $query));
            $stmt->execute();

            return $stmt->fetchAll();
        } catch ( PDOException $e ) {
            return null;
        } finally {
            self::resetProperties();
        }
    }

    public function pagination(int $perPage = 10, int $page = 1): array | null {
        try {
            $select     = self::$select;
            $where      = self::$where;
            $orderBy    = implode(', ', self::$orderBy);
            $table      = $this->getTableName();
            $query      = "SELECT $select FROM $table ";
            $countQuery = str_replace($select, 'COUNT(*)', $query);

            if ($where) {
                $query      .= " WHERE $where";
                $countQuery .= " WHERE $where";
            }

            if ($orderBy) {
                $query .= " ORDER BY $orderBy";
            }

            $totalPage = $this->pdo->query($countQuery)->fetchColumn();
            $totalPage = ceil($totalPage / $perPage);

            if ($page > $totalPage) {
                $page = $totalPage;
            }

            $offset = ($page - 1) * $perPage;
            $query  .= " LIMIT $perPage OFFSET $offset";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            return ['data' => $data, 'total_page' => $totalPage, 'per_page' => $perPage, 'page' => $page,];
        } catch ( PDOException $e ) {
            return null;
        } finally {
            self::resetProperties();
        }
    }
}