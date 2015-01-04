<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
    
    class SectionsModel extends Model {
        static private $_sections = array('A1 TC2','A1 APP','A2 CL','A2 APP','A3 TC','A1 SCIEN',
            'A3 RSX', 'A3 RSE', 'A3 SECU', 'A3 X', 'A3 WEB', 'A1 LIC', 'A3 DOO', 'A3 DOO2', 'A1 TC',
            'A1 TECH', 'A3 DIG', 'A2 ED', 'A3 APP');
        
        public function lister() {
            return self::$_sections;
        }
        
        public function estValide($section){
            return in_array($section, self::$_sections);
        }
        
    }