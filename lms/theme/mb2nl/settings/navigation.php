<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   theme_mb2nl
 * @copyright 2017 Mariusz Boloz (http://marbol2.com)
 * @license   Commercial https://themeforest.net/licenses
 *
 */


defined('MOODLE_INTERNAL') || die;


$temp = new admin_settingpage('theme_mb2nl_settingsnav',  get_string('settingsnav', 'theme_mb2nl'));


$setting = new admin_setting_configmb2start('theme_mb2nl/startnavgeneral', get_string('general','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


	$name = 'theme_mb2nl/stickynav';
	$title = get_string('stickynav','theme_mb2nl');
	$setting = new admin_setting_configcheckbox($name, $title, '',0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	// Navigation animation type
	$name = 'theme_mb2nl/navatype';
	$title = get_string('navatype','theme_mb2nl');
	$desc = '';
	$setting = new admin_setting_configselect($name, $title, $desc, '2', array('2'=>get_string('navatypeslide', 'theme_mb2nl'),'1'=>get_string('navatypefade', 'theme_mb2nl')));
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
		
		
	// Navigation animation speed
	$name = 'theme_mb2nl/navaspeed';
	$title = get_string('navaspeed','theme_mb2nl');
	$desc = '';
	$setting = new admin_setting_configtext($name, $title, $desc, '300');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
		
		
	// Navigation dropdown width
	$name = 'theme_mb2nl/navddwidth';
	$title = get_string('navddwidth','theme_mb2nl');
	$desc = '';
	$setting = new admin_setting_configtext($name, $title, $desc, '200');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/mycinmenu';
	$title = get_string('mycinmenu','theme_mb2nl');
	$setting = new admin_setting_configcheckbox($name, $title, '',0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/navcls';
	$title = get_string('navcls','theme_mb2nl');
	$desc = get_string('navclsdesc','theme_mb2nl');
	$setting = new admin_setting_configtextarea($name, $title, $desc, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	

$setting = new admin_setting_configmb2end('theme_mb2nl/endnavgeneral');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);



$setting = new admin_setting_configmb2start('theme_mb2nl/startnavicon', get_string('navicon','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$setting = new admin_setting_configmb2start('theme_mb2nl/startnaviconopt', get_string('options','theme_mb2nl'));
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
		
		$name = 'theme_mb2nl/naviconfsize';
		$title = get_string('naviconfsize','theme_mb2nl');
		$setting = new admin_setting_configtext($name, $title, '', 17);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
	
	
	$setting = new admin_setting_configmb2end('theme_mb2nl/endnaviconopt');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	
	$setting = new admin_setting_configmb2start('theme_mb2nl/startnaviconlinks', get_string('links','theme_mb2nl'));
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
		for ($i = 1; $i<=7; $i++)
		{
			
			$name = 'theme_mb2nl/naviconurl' . $i;
			$title = get_string('url','theme_mb2nl') . ' #' . $i;
			$setting = new admin_setting_configtext($name, $title, '', '');
			$setting->set_updatedcallback('theme_reset_all_caches');
			$temp->add($setting);
			
			
			$name = 'theme_mb2nl/naviconurlnw' . $i;
			$title = get_string('urlnw','theme_mb2nl');
			$setting = new admin_setting_configcheckbox($name, $title, '',0);
			$setting->set_updatedcallback('theme_reset_all_caches');
			$temp->add($setting);
			
			
			$name = 'theme_mb2nl/naviconicon' . $i;
			$title = get_string('icon','theme_mb2nl') . ' #' . $i;
			$setting = new admin_setting_configtext($name, $title, get_string('icondesc','theme_mb2nl'), '');
			$setting->set_updatedcallback('theme_reset_all_caches');
			$temp->add($setting);
			
			
			$name = 'theme_mb2nl/navicontext' . $i;
			$title = get_string('text','theme_mb2nl') . ' #' . $i;
			$setting = new admin_setting_configtext($name, $title, get_string('textdesc','theme_mb2nl'), '');
			$setting->set_updatedcallback('theme_reset_all_caches');
			$temp->add($setting);		
			
			
			if ($i<7)
			{
				$name = 'theme_mb2nl/naviconspacer' . $i;
				$setting = new admin_setting_configmb2spacer($name);
				$setting->set_updatedcallback('theme_reset_all_caches');
				$temp->add($setting);
			}	
			
		}
	
	
	$setting = new admin_setting_configmb2end('theme_mb2nl/endnaviconlinks');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);	


$setting = new admin_setting_configmb2end('theme_mb2nl/endnavicon');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$ADMIN->add('theme_mb2nl', $temp);