<?php

require_once ROOT . "/models/baseModel.php";

class GiftsModel extends BaseModel
{
  protected $table = "tbl_gifts";
  protected $columns = [
    "id", "name", "users_id", "create_date", "update_date"
  ];

  function __construct($db)
  {
    parent::__construct($db);
  }

  function random()
  {
    $sql = "SELECT * FROM {$this->table} ORDER BY RAND() LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
  }
}
