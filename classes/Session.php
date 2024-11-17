<?php
class Session
{

  public static function adminAccess($username)
  {
    if (!isset($_SESSION["$username"])) {
      new Redirect('../../admin.php');
    }
  }
  public static function adminLoginAccess($username)
  {
    if (isset($_SESSION["$username"])) {
      new Redirect('admin/views/index.php');
    }
  }
  public static function staffAccess($username)
  {
    if (!isset($_SESSION["$username"])) {
      new Redirect('../../index.php');
    }
  }
  public static function staffLoginAccess($username)
  {
    if (isset($_SESSION["$username"])) {
      new Redirect('staff/views/home.php');
    }
  }
  public static function name($index, $value)
  {
    return $_SESSION["$index"] = $value;
  }
  public static function unset($name)
  {
    unset($_SESSION["$name"]);
  }
  public static function coAdminAccess($username)
  {
    if (!isset($_SESSION["$username"])) {
      new Redirect('../../admin.php');
    }
  }
  public static function coAdminLoginAccess($username)
  {
    if (isset($_SESSION["$username"])) {
      new Redirect('coadmin/views/index.php');
    }
  }

  public static function access($username)
  {
    if (!isset($_SESSION["$username"])) {
      new Redirect('user_login.php');
    }
  }

  public static function sessionDestroy()
  {
    session_destroy();
    new Redirect("../index.php");
  }
}
