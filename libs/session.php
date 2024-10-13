<?php
  class Session
  {
     public static function init()
     {
       @session_start();
     }

     public static function set($key, $value)
     {
       $_SESSION[$KEY] = $VALUE;
     }

     public static function get($key)
      {
      	if(isset($_SESSION[$KEY])){
      	   return $_SESSION[$KEY];	
      	} 
      }

      public static function destroy()
      {
      session_destroy();
      }
  }
?>