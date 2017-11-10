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


$temp = new admin_settingpage('theme_mb2nl_settingspages',  get_string('settingspages', 'theme_mb2nl'));


$bgPositionOpt = array(
	'center center'=>'center center',
	'left top'=>'left top',
	'left center'=>'left center',
	'left bottom'=>'left bottom',
	'right top'=>'right top',
	'right center'=>'right center',
	'right bottom'=>'right bottom',
	'center top'=>'center top',
	'center bottom'=>'center bottom'
);


$bgRepearOpt = array(
	'no-repeat'=>'no-repeat',
	'repeat'=>'repeat',
	'repeat-x'=>'repeat-x',
	'repeat-y'=>'repeat-y'	
);


$bgSizeOpt = array(
	'cover'=>'cover',
	'auto'=>'auto',	
	'contain'=>'contain'
);


$bgAttOpt = array(
	'scroll'=>'scroll',
	'fixed'=>'fixed',
	'local'=>'local'
);


$bgPredefinedOpt = array(
	''=>get_string('none','theme_mb2nl'),
	'strip1'=>get_string('strip1','theme_mb2nl'),
	'strip2'=>get_string('strip2','theme_mb2nl'),
);

$setting = new admin_setting_configmb2start('theme_mb2nl/startlogin', get_string('pagelogin','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);
		
	
	$setting = new admin_setting_configmb2start('theme_mb2nl/startlogingeneral', get_string('general','theme_mb2nl'));
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
		$name = 'theme_mb2nl/cloginpage';
		$title = get_string('cloginpage','theme_mb2nl');
		$setting = new admin_setting_configcheckbox($name, $title, '', 0);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginlogo';
		$title = get_string('logoimg','theme_mb2nl');
		$desc = get_string('loginlogodesc','theme_mb2nl');
		$setting = new admin_setting_configstoredfile($name, $title, $desc, 'loginlogo');
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginlogow';
		$title = get_string('logow','theme_mb2nl');
		$desc = get_string('logowdesc', 'theme_mb2nl');
		$setting = new admin_setting_configtext($name, $title, $desc, '');
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
	
	
	$setting = new admin_setting_configmb2end('theme_mb2nl/endlogingeneral');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$setting = new admin_setting_configmb2start('theme_mb2nl/startloginstyle', get_string('style','theme_mb2nl'));
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
		$name = 'theme_mb2nl/loginbgcolor';
		$title = get_string('bgcolor','theme_mb2nl');
		$setting = new admin_setting_configmb2color($name, $title, get_string('pbgdesc','theme_mb2nl'), '');
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgpre';
		$title = get_string('pbgpre','theme_mb2nl');
		$setting = new admin_setting_configselect($name, $title, '', '', $bgPredefinedOpt);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgimage';
		$title = get_string('bgimage','theme_mb2nl');
		$setting = new admin_setting_configstoredfile($name, $title, get_string('pbgdesc','theme_mb2nl'), 'loginbgimage');
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgrepeat';
		$title = get_string('bgrepeat','theme_mb2nl');
		$setting = new admin_setting_configselect($name, $title, '', 'no-repeat', $bgRepearOpt);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgpos';
		$title = get_string('bgpos','theme_mb2nl');
		$setting = new admin_setting_configselect($name, $title, '', 'center center', $bgPositionOpt);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgattach';
		$title = get_string('bgattachment','theme_mb2nl');
		$setting = new admin_setting_configselect($name, $title, '', 'scroll', $bgAttOpt);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		
		
		$name = 'theme_mb2nl/loginbgsize';
		$title = get_string('bgsize','theme_mb2nl');
		$setting = new admin_setting_configselect($name, $title, '', 'cover', $bgSizeOpt);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
	
	$setting = new admin_setting_configmb2end('theme_mb2nl/endloginstyle');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endlogin');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);



$setting = new admin_setting_configmb2start('theme_mb2nl/startpages', get_string('pagecls','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

	
	$name = 'theme_mb2nl/pagecls';
	$title = get_string('pagecls','theme_mb2nl');
	$desc = get_string('pageclsdesc','theme_mb2nl');
	$setting = new admin_setting_configtextarea($name, $title, $desc, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/coursecls';
	$title = get_string('coursecls','theme_mb2nl');
	$desc = get_string('courseclsdesc','theme_mb2nl');
	$setting = new admin_setting_configtextarea($name, $title, $desc, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/endpages');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);




$ADMIN->add('theme_mb2nl', $temp);