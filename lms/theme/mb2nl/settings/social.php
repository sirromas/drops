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


$temp = new admin_settingpage('theme_mb2nl_settingssocial',  get_string('settingssocial', 'theme_mb2nl'));


$setting = new admin_setting_configmb2start('theme_mb2nl/socialstart1', get_string('options','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);
		
$name = 'theme_mb2nl/socialheader';
$title = get_string('socialheader','theme_mb2nl');
$desc = '';
$setting = new admin_setting_configcheckbox($name, $title, $desc, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$name = 'theme_mb2nl/socialfooter';
$title = get_string('socialfooter','theme_mb2nl');
$desc = '';
$setting = new admin_setting_configcheckbox($name, $title, $desc, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$name = 'theme_mb2nl/socialmargin';
$title = get_string('socialmargin','theme_mb2nl');
$desc = get_string('socialmargindesc','theme_mb2nl');
$setting = new admin_setting_configtext($name, $title, $desc, '');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$name = 'theme_mb2nl/sociallinknw';
$title = get_string('sociallinknw','theme_mb2nl');
$desc = '';
$setting = new admin_setting_configcheckbox($name, $title, $desc, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$name = 'theme_mb2nl/socialtt';
$title = get_string('socialtt','theme_mb2nl');
$desc = '';
$setting = new admin_setting_configcheckbox($name, $title, $desc, 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$setting = new admin_setting_configmb2end('theme_mb2nl/socialend');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);



$socialnameChoices = array(
	''=>get_string('none','theme_mb2nl'),
	'android,Android'=>'Android',
	'dribbble,Dribbble'=>'Dribbble',
	'dropbox,Dropbox'=>'Dropbox',
	'facebook,Facebook'=>'Facebook',
	'flickr,Flickr'=>'Flickr',
	'github,Github'=>'Github',		
	'google-plus,Google Plus'=>'Google Plus',
	'instagram,Instagram'=>'Instagram',
	'linkedin,Linkedin'=>'Linkedin',
	'pinterest,Pinterest'=>'Pinterest',
	'rss,Rss'=>'Rss',
	'skype,Skype'=>'Skype',
	'tumblr,Tumblr'=>'Tumblr',
	'twitter,Twitter'=>'Twitter',
	'vimeo,Vimeo'=>'Vimeo',
	'xing,Xing'=>'Xing',
	'youtube-play,Youtube'=>'Youtube'
);



$setting = new admin_setting_configmb2start('theme_mb2nl/socialliststart', get_string('socillist','theme_mb2nl'));
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


for ($i = 1; $i<= 7; $i++)
{
	
	
	$name = 'theme_mb2nl/socialname' . $i;
	$title = get_string('name','theme_mb2nl') . ' #' . $i;
	$desc = '';
	$setting = new admin_setting_configselect($name, $title, $desc, '', $socialnameChoices);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	
	$name = 'theme_mb2nl/sociallink' . $i;
	$title = get_string('link','theme_mb2nl') . ' #' . $i;
	$desc = '';
	$setting = new admin_setting_configtext($name, $title, $desc, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);
	
	if ($i<7)
	{
		$setting = new admin_setting_configmb2spacer('theme_mb2nl/socialspacer' . $i);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
	}
	
}


$setting = new admin_setting_configmb2end('theme_mb2nl/sociallistend');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);


$ADMIN->add('theme_mb2nl', $temp);