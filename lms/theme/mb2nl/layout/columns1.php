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


$customLoginPage = theme_mb2nl_is_login($PAGE, true);


echo $OUTPUT->theme_part('head'); ?>
<?php echo $OUTPUT->theme_part('header'); ?>
<?php if (!$customLoginPage) : ?>	
	<?php echo $OUTPUT->theme_part('page_header'); ?>
<?php endif; ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="row">
            <div id="page-content" class="col-sm-12">
                <?php echo $OUTPUT->course_content_header(); ?>
                <?php echo $OUTPUT->main_content(); ?>
                <?php echo $OUTPUT->course_content_footer(); ?>
            </div>            
        </div>
    </div>
</div>
<?php if (!$customLoginPage) : ?>     
	<?php //echo $OUTPUT->theme_part('region_after_content'); ?>
<?php endif; ?>
<?php echo $OUTPUT->theme_part('region_adminblock'); ?> 
<?php if (!$customLoginPage) : ?>
	<?php echo $OUTPUT->theme_part('region_bottom'); ?> 
	<?php echo $OUTPUT->theme_part('region_bottom_abcd'); ?> 
<?php endif; ?>  
<?php echo $OUTPUT->theme_part('footer'); ?>