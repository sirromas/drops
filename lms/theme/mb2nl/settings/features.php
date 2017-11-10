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


$temp = new admin_settingpage('theme_mb2nl_settingsfeatures',  get_string('settingsfeatures', 'theme_mb2nl'));
$yesNoOptions = array('1'=>get_string('yes','theme_mb2nl'), '0'=>get_string('no','theme_mb2nl'));


$setting = new admin_setting_configmb2start('theme_mb2nl/startloading', get_string('loadingscreen','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$name = 'theme_mb2nl/loadingscr';
	$title = get_string('loadingscreen','theme_mb2nl');
	$setting = new admin_setting_configcheckbox($name, $title, get_string('loadingscrdesc', 'theme_mb2nl'), 0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/loadinghide';
	$title = get_string('loadinghide','theme_mb2nl');
	$setting = new admin_setting_configtext($name, $title, '', 600);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/spinnerw';
	$title = get_string('spinnerw','theme_mb2nl');
	$setting = new admin_setting_configtext($name, $title, '', 50);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/lbgcolor';
	$title = get_string('bgcolor','theme_mb2nl');
	$setting = new admin_setting_configmb2color($name, $title, '', '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/loadinglogo';
	$title = get_string('logoimg','theme_mb2nl');
	$setting = new admin_setting_configstoredfile($name, $title, get_string('loadinglogodesc','theme_mb2nl'), 'loadinglogo');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endloading');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$setting = new admin_setting_configmb2start('theme_mb2nl/startloginform', get_string('loginform','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$layoutArr = array(
		'1' => get_string('loginpage','theme_mb2nl'),
		'2' => get_string('forgotpage','theme_mb2nl')
	);
	$name = 'theme_mb2nl/loginlink';
	$title = get_string('loginlink','theme_mb2nl');
	$setting = new admin_setting_configselect($name, $title, '', 'fw', $layoutArr);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/logintext';
	$title = get_string('logintext','theme_mb2nl');
	$setting = new admin_setting_configtextarea($name, $title, '', '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endloginform');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$setting = new admin_setting_configmb2start('theme_mb2nl/startscrolltt', get_string('scrolltt','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$name = 'theme_mb2nl/scrolltt';
	$title = get_string('scrolltt','theme_mb2nl');
	$setting = new admin_setting_configcheckbox($name, $title,'', 0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/scrollspeed';
	$title = get_string('scrollspeed','theme_mb2nl');
	$setting = new admin_setting_configtext($name, $title, '', 400);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endscrolltt');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);



$setting = new admin_setting_configmb2start('theme_mb2nl/startganalitycs', get_string('ganatitle','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$name = 'theme_mb2nl/ganaid';
	$title = get_string('ganaid','theme_mb2nl');
	$setting = new admin_setting_configtext($name, $title,$title = get_string('ganaiddesc','theme_mb2nl'), '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/ganaasync';
	$title = get_string('ganaasync','theme_mb2nl');
	$setting = new admin_setting_configcheckbox($name, $title,'', 0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endganalitycs');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$ADMIN->add('theme_mb2nl', $temp);