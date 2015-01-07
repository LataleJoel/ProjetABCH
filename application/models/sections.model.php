<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
    class SectionsModel extends Model {
        static private $_sections = array(
            'A1 APP',
            'A1 LIC',
            'A1 SCIEN',
            'A1 TECH',
            'A1 TC',
            'A1 TC2',
            'A2 APP',
            'A2 CL',
            'A2 ED',
            'A3 APP',
            'A3 DIG',
            'A3 DOO',
            'A3 DOO2',
            'A3 RSE',
            'A3 RSX',
            'A3 SECU',
            'A3 TC',
            'A3 WEB',
            'A3 X'
        );
     
        public function lister() {
            return self::$_sections;
        }
        
        public function estValide($section){
            return in_array($section, self::$_sections);
        }
        
    }