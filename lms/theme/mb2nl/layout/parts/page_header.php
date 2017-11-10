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


$imagesFolder = $CFG->dirroot . '/theme/mb2nl/pix/header/';
$img = theme_mb2nl_random_image($imagesFolder,'header');


?>
<div id="page-header"<?php /*?> class="dark" style="background-image:url('<?php echo $img; ?>');"<?php */?>>
	<div class="inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <?php /*?><h1><?php echo $OUTPUT->page_title(); ?></h1><?php */?>
                    <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                    <?php echo $OUTPUT->page_heading_button(); ?>
                   <?php /*?> <div id="course-header">
                        <?php echo $OUTPUT->course_header(); ?>
                    </div><?php */?>     
                </div>    
            </div>
        </div>
    </div>
</div>