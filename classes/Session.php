<?php
class Session extends Controller
{

  public function checkStatus()
  {
    $status_result = $this->fetchResult('online_customer', "phone_no= '" . $_SESSION['phone_no'] . "'","status= 1");
    $status = mysqli_fetch_array($status_result);
    if ($status['status'] ==1){
      new Redirect('index');
    }
  }
  public function userLoggedIn($username)
  {
    $status_result = $this->fetchResult('online_customer', "phone_no= '" . $_SESSION['phone_no'] . "'","status= 0");
    $status = mysqli_fetch_array($status_result);
    if ($status['status'] ==1){
      new Redirect('index');
    }
  }
  public function userLoggedOut($username)
  {
    $status_result = $this->fetchResult('online_customer', "phone_no= '" . $_SESSION['phone_no'] . "'","status= 0");
    $status = mysqli_fetch_array($status_result);
    if ($status['status'] ==1){
      new Redirect('index');
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

  public static function set($username)
  {
    if (isset($_SESSION["$username"])) {
      new Redirect('./pages/home');
    }
  }
  public static function notSet($username)
  {
    if (!isset($_SESSION["$username"])) {
      new Redirect('./pages/home');
    }
  }

  public static function sessionDestroy()
  {
    session_destroy();
    new Redirect("../index.php");
  }
}
