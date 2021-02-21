<?php

class PluginLibresignConfig extends CommonDBTM {
   static private $_instance = NULL;
   static $rightname         = 'config';

   static function canCreate() {
      return Session::haveRight('config', UPDATE);
   }

   static function canView() {
      return Session::haveRight('config', READ);
   }

   /**
    * Singleton for the unique config record
    */
    static function getInstance() {

      if (!isset(self::$_instance)) {
         self::$_instance = new self();
         if (!self::$_instance->getFromDB(1)) {
            self::$_instance->getEmpty();
         }
      }
      return self::$_instance;
   }

   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      if (!$withtemplate) {
         if ($item->getType() == 'Config') {
            return __('Libresign');
         }
      }
      return '';
   }

   function showConfigForm() {
      $config = self::getInstance();

      $config->showFormHeader();

      echo "<tr class='tab_bg_2'>";
      echo "<td><label for='nextcloud_url'>" . __('URL of the API') . "</label></td>";
      echo "<td colspan='3'><input type='text' name='nextcloud_url' id='nextcloud_url' size='80' value='".$config->fields["nextcloud_url"]."'></td>";
      echo "</tr>";

      echo "<tr class='tab_bg_2'>";
      echo "<td><label for='username'>" . __('Username') . "</label></td>";
      echo "<td colspan='3'><input type='text' name='username' id='username' size='80' value='".$config->fields["username"]."'></td>";
      echo "</tr>";

      echo "<tr class='tab_bg_2'>";
      echo "<td><label for='password'>" . __('Password') . "</label></td>";
      echo "<td colspan='3'><input type='password' name='password' id='password' size='80' value='".$config->fields["password"]."'></td>";
      echo "</tr>";

      $config->showFormButtons(['candel'=>false]);
      return false;
   }

   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      if ($item->getType() == 'Config') {
         $config = new self();
         $config->showConfigForm();
      }
   }

}
