<?php

require_once ROOT . "/models/baseModel.php";

class PoolsModel extends BaseModel
{
  protected $table = "tbl_pools";
  protected $columns = [
    "id", "gifts_id", "users_id", "update_date", "create_date"
  ];

  function __construct($db)
  {
    parent::__construct($db);
  }

}
