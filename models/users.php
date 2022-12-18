<?php

require_once ROOT . "/models/baseModel.php";

class UsersModel extends BaseModel
{
  protected $table = "tbl_users";
  protected $columns = [
    "id", "username", "create_date", "update_date"
  ];

  function __construct($db)
  {
    parent::__construct($db);
  }

}
