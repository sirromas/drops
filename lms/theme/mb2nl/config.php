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

defined('MOODLE_INTERNAL') || die();


$THEME->doctype = 'html5';
$THEME->name = 'mb2nl';


$THEME->lessvariablescallback = 'theme_mb2nl_get_pre_less';
$THEME->extralesscallback = 'theme_mb2nl_get_pre_less_raw';
$THEME->lessfile = 'style';
$THEME->sheets = 'theme_mb2nl_get_custom_css';
$THEME->parents = array();
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = array();
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->blockrtlmanipulations = array();
$THEME->enable_dock = false;
$THEME->editor_sheets = array('editor');


// Define region arrays
$fpRegions = array('side-pre','side-post','slider','after-slider','before-content','after-content','adminblock','bottom','bottom-a','bottom-b','bottom-c','bottom-d');
$incourseRegions = array('side-pre','slider','after-slider','before-content','after-content','adminblock','bottom','bottom-a','bottom-b','bottom-c','bottom-d');
$defRegions = array('side-pre','side-post','adminblock','bottom','bottom-a','bottom-b','bottom-c','bottom-d');
$def2ColsRegions = array('side-pre','adminblock','bottom','bottom-a','bottom-b','bottom-c','bottom-d');
$oneColRegion = array('adminblock','bottom','bottom-a','bottom-b','bottom-c','bottom-d');


// Moodle documentation
// https://docs.moodle.org/dev/Page_API
$THEME->layouts = array(
    'base' => array(
		'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'adminblock'
    ),
    'standard' => array(
        'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'side-pre',
    ),
    'course' => array(
        'file' => 'columns3.php',
        'regions' => $defRegions,
        'defaultregion' => 'adminblock'
    ),
    'coursecategory' => array(
        'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'side-pre',
    ),
    'incourse' => array(
        'file' => 'incourse.php',
        'regions' => $incourseRegions,
        'defaultregion' => 'side-pre'
    ),
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => $fpRegions,
        'defaultregion' => 'adminblock',
        'options' => array('nonavbar' => true),
    ),
    'mydashboard' => array(
        'file' => 'columns3.php',
        'regions' => $defRegions,
        'defaultregion' => 'adminblock',
        'options' => array(),
    ),
    'admin' => array(
        'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'side-pre',
    ),
    'mypublic' => array(
        'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'side-pre',
    ),
    'login' => array(
        'file' => 'columns1.php',
        'regions' => $oneColRegion,
		'defaultregion' => 'adminblock',
        'options' => array(),
    ),
    'popup' => array(
        'file' => 'popup.php',
        'regions' => array(),
        'options' => array(),
    ),
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nocoursefooter' => true),
    ),
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array()
    ),
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    'print' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => false),
    ),
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),
    'report' => array(
        'file' => 'columns2.php',
        'regions' => $def2ColsRegions,
        'defaultregion' => 'side-pre',
    ),
    'secure' => array(
        'file' => 'columns3.php',
        'regions' => $defRegions,
        'defaultregion' => 'adminblock'
    )
);