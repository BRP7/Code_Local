<?php
class Mage
{
   private static $baseUrl = "http://localhost/practice/MVC";
   private static $registry = [];
   private static $baseDir = 'C:/xampp/htdocs/practice/MVC';
   private static $_singleTon = null;
   public static function init()
   {

      $controllerObj = new Core_Controller_Front();

      $controllerObj->init();
      // echo $modelObj;
   }


   //    public static function getModel($modelName)
   //    {
   //        $uriArray = explode("/", $modelName);
   //        $className = ucfirst($uriArray[0])."_"."Model"."_".ucfirst($uriArray[1]);
   //        return new $className;
   //    }


   //    public static function getSingleton($className){}
   public static function getModel($className)
   {  //parameter  ma define krse
      $classNameObj = ucwords(str_replace("/", "_Model_", $className), "_");
      return new $classNameObj();
   }
   public static function getBlock($className)
   {
      $classNameObj = ucwords(str_replace("/", "_Block_", $className), "_");
      return new $classNameObj();
   }
// public static function register($key, $value){}
// public static function registry($key){}
// public static function getBaseDir($subDir = null){}

   public static function register($key, $value)
   {
   }
   public static function registry($key)
   {
   }
   public static function getBaseDir($subDir = null)
   {
      if ($subDir) {
         return self::$baseDir . "/" . $subDir;
      }

      return self::$baseDir;
   }
   public static function getBaseUrl($subUrl = null)
   {
      if ($subUrl) {

         return self::$baseUrl . '/' . $subUrl;
      }
      return self::$baseUrl.'/';
   }


   public static function getSingleton($className)
   {
      if (isset(self::$_singleTon[$className])) {
         return self::$_singleTon[$className];

      } else {

         return self::$_singleTon[$className] = self::getModel($className);
      }
   }

   public static function getImagePath($filePath){
      if($filePath){
         return self::$baseUrl.'/media/' . $filePath;
      }
      
   }

}

?>