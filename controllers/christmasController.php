<?php

require_once ROOT . "/models/users.php";
require_once ROOT . "/models/gifts.php";

class ChristmasController
{
  private $userModel;
  private $giftsModel;
  private $poolsModel;

  function __construct()
  {
    $db = Database::getInstance();
    $this->userModel = new UsersModel($db);
    $this->giftsModel = new GiftsModel($db);
    $this->poolsModel = new PoolsModel($db);
  }

  function register($req)
  {
    $username = $req["username"];
    $form = [
      "username" => $username
    ];
    $this->userModel->insert($form);

    $filter = "username = '{$username}'";
    $users = $this->userModel->findOne($filter);

    $form = [
      "name" => $req["gift"],
      "users_id" => $users["id"]
    ];

    $this->giftsModel->insert($form);
  }

  function login($username)
  {
    $filter = "username = '{$username}'";
    $users = $this->userModel->findOne($filter);
    $_SESSION["users_id"] = $users["id"];
  }

  function random()
  {
    if (empty($_SESSION["users_id"])) return new Exception('Not Logged in');
    $gifts = $this->giftsModel->random();

    $form = [
      "gifts_id" => $gifts["id"],
      "users_id" => $_SESSION["users_id"],
    ];

    $this->poolsModel->insert($form);
    return $gifts;
  }
}
