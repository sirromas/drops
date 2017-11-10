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


$sidebar = theme_mb2nl_isblock($PAGE, 'side-pre');
$sidebarPos = theme_mb2nl_theme_setting($PAGE, 'sidebarpos', 'classic');


if ($sidebar)
{
	$contentCol = 'col-sm-9 col-sm-push-3';
	$sideCol = 'col-sm-3 col-sm-pull-9';
	
	if ($sidebarPos === 'right')
	{
		$contentCol = 'col-sm-9';
		$sideCol = 'col-sm-3';
	}
}
else
{
	$contentCol = 'col-sm-12';	
}


?>
<?php echo $OUTPUT->theme_part('head'); ?>
<?php echo $OUTPUT->theme_part('header'); ?>
<?php echo $OUTPUT->theme_part('region_slider'); ?>
<?php echo $OUTPUT->theme_part('page_header'); ?>
<?php echo $OUTPUT->theme_part('region_after_slider'); ?>
<?php echo $OUTPUT->theme_part('region_before_content'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="row">
     		<div id="page-content" class="<?php echo $contentCol; ?>">
            	<?php echo $OUTPUT->course_content_header(); ?>
            	<?php echo $OUTPUT->main_content(); ?>
            	<?php echo $OUTPUT->course_content_footer(); ?>
       		</div>
            <?php if ($sidebar) : ?>
                <div class="<?php echo $sideCol; ?>">
                <?php echo $OUTPUT->blocks('side-pre', theme_mb2nl_block_cls($PAGE, 'side-pre')); ?>
                </div>  
            <?php endif; ?>      
    	</div>    
	</div>
</div>
<?php echo $OUTPUT->theme_part('region_after_content'); ?>
<?php echo $OUTPUT->theme_part('region_adminblock'); ?> 
<?php echo $OUTPUT->theme_part('region_bottom'); ?> 
<?php echo $OUTPUT->theme_part('region_bottom_abcd'); ?>   
<?php echo $OUTPUT->theme_part('footer'); ?>