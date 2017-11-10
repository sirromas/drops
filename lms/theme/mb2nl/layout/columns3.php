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


$sidePre = theme_mb2nl_isblock($PAGE, 'side-pre');
$sidePost = theme_mb2nl_isblock($PAGE, 'side-post');
$sidebarPos = theme_mb2nl_theme_setting($PAGE, 'sidebarpos', 'classic');


$contentCol = 'col-sm-12';
$sidePreCol = ' col-sm-3 col-sm-pull-6';
$sidePostCol = ' col-sm-3';


if ($sidePre && $sidePost)
{
	
	if ($sidebarPos === 'right')
	{
		$contentCol = 'col-sm-6';
		$sidePreCol = ' col-sm-3';
	}
	elseif ($sidebarPos === 'left')
	{
		$contentCol = 'col-sm-6 col-sm-push-6';	
		$sidePostCol = ' col-sm-3 col-sm-pull-6';
	}
	else
	{
		$contentCol = 'col-sm-6 col-sm-push-3';	
	}
		
}
elseif (!$sidePre && $sidePost)
{
	$contentCol = 'col-sm-9';
	
	if ($sidebarPos === 'left')
	{
		$sidePostCol = ' col-sm-3 col-sm-pull-9';
		$contentCol = 'col-sm-9 col-sm-push-3';
	}
		
}
elseif ($sidePre && !$sidePost)
{
	$contentCol = 'col-sm-9 col-sm-push-3';	
	$sidePreCol = ' col-sm-3 col-sm-pull-9';
	
	if ($sidebarPos === 'right')
	{
		$contentCol = 'col-sm-9';	
		$sidePreCol = ' col-sm-3';	
	}
	
}


?>
<?php echo $OUTPUT->theme_part('head'); ?>
<?php echo $OUTPUT->theme_part('header'); ?>
<?php //echo $OUTPUT->theme_part('region_slider'); ?>
<?php echo $OUTPUT->theme_part('page_header'); ?>
<?php //echo $OUTPUT->theme_part('region_after_slider'); ?>
<?php //echo $OUTPUT->theme_part('region_before_content'); ?>
<div id="main-content">
    <div class="container-fluid">
        <div class="row">
            <div id="page-content" class="<?php echo $contentCol; ?>">
                <?php echo $OUTPUT->course_content_header(); ?>
                <?php echo $OUTPUT->main_content(); ?>
                <?php echo $OUTPUT->course_content_footer(); ?>
            </div>
            <?php if ($sidePre) : ?>
            	<div class="<?php echo $sidePreCol; ?>">
                	<?php echo $OUTPUT->blocks('side-pre', theme_mb2nl_block_cls($PAGE, 'side-pre','default')); ?>
                </div>                
            <?php endif; ?>
            <?php if ($sidePost) : ?>
            <div class="<?php echo $sidePostCol; ?>">
            	<?php echo $OUTPUT->blocks('side-post', theme_mb2nl_block_cls($PAGE, 'side-post','default')); ?>
            </div>                 
            <?php endif; ?>            
        </div>
    </div>
</div>     
<?php //echo $OUTPUT->theme_part('region_after_content'); ?>
<?php echo $OUTPUT->theme_part('region_adminblock'); ?> 
<?php echo $OUTPUT->theme_part('region_bottom'); ?> 
<?php echo $OUTPUT->theme_part('region_bottom_abcd'); ?>   
<?php echo $OUTPUT->theme_part('footer'); ?>