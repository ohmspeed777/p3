<?php

class BaseModel
{
  protected $db;
  protected $table = "";
  protected $columns = [];

  function __construct($db)
  {
    $this->db = $db;
  }

  function insert($data)
  {
    $columnStr = join(", ", $this->columns);

    $values = [];
    foreach ($this->columns as $item) {
      array_push($values, ":" . $item);
    }
    $valuesStr = join(", ", $values);

    $sql = "INSERT INTO $this->table ({$columnStr}) VALUES ({$valuesStr})";
    $stmt = $this->db->prepare($sql);

    foreach ($this->columns as $item) {
      $stmt->bindParam(":{$item}", $data[$item]);
    }

    $stmt->execute();
  }

  function deleteOne($condition)
  {
    $sql = "DELETE FROM {$this->table} WHERE {$condition}";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }

  function findOne($condition)
  {
    $sql = "SELECT * FROM {$this->table} WHERE {$condition}";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
  }

  function findAll($condition)
  {
    $sql = "SELECT * FROM {$this->table} WHERE {$condition}";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function update($values, $condition)
  {
    $data = [];
    foreach ($this->columns as $item) {
      array_push($data, "{$item}='{$values[$item]}'");
    }
    $dateStr =  join(", ", $data);

    $sql = "UPDATE {$this->table} SET {$dateStr}  WHERE {$condition}";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }
}
