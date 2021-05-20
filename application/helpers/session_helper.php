<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('redirect_if_login'))
{
  /**
   *  Redirect if login
   * 
   *  This functions checks the session data if someone
   *  is logged in, if so redirects them to the given
   *  url parameter.
   */
  function redirect_if_login(string $url)
  {
    if (isset($_SESSION['user']) && isset($_SESSION['loggedin']))
    {
      redirect(base_url($url));
    }
  }
}

if (!function_exists('redirect_not_login'))
{
  /**
   *  Redirect if not login
   * 
   *  This function checks the session data if someone
   *  is logged in, if not redirects them to the given
   *  url parameter.
   */
  function redirect_not_login(string $url)
  {
    if (!(isset($_SESSION['user']) && isset($_SESSION['loggedin'])))
    {
      redirect(base_url($url));
    }
  }
}
