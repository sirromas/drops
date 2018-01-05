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
$socilaTt = theme_mb2nl_theme_setting($PAGE, 'socialtt', 0) == 1 ? 'top' : '';
$isPageBg = theme_mb2nl_pagebg_image($PAGE);

?>

<!-- Additional JS libraries to be used -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script type="text/javascript" src="//learningindrops.com/lms/custom/js/nav.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>

<!-- Additional CSS libraries to be used -->
<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css'>

<body <?php echo $OUTPUT->body_attributes(theme_mb2nl_body_cls($PAGE)) . $isPageBg; ?>>

<?php echo $OUTPUT->standard_top_of_body_html(); ?>
<?php if (theme_mb2nl_theme_setting($PAGE, 'loadingscr',0) == 1) : ?>
	<?php echo theme_mb2nl_loading_screen($PAGE); ?>
<?php endif; ?>
<?php
echo !$customLoginPage ? $OUTPUT->theme_part('sliding_panel') : '';
?>
<div id="page-outer">
<div id="page">
<div id="page-a">
<?php if ($customLoginPage) : ?>
	<?php echo $OUTPUT->theme_part('logo'); ?>
<?php else : ?>
    <div id="main-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                </div>
            </div>
        </div>  
    </div>
    <?php if (theme_mb2nl_theme_setting($PAGE, 'stickynav', 0) == 1) : ?>
    	<div class="sticky-nav-element-offset"></div>
    <?php endif; ?>    
    <div id="main-navigation">
        <div class="main-navigation-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $OUTPUT->custom_menu(); ?>
                     </div>
                </div>
            </div>
        </div>
    </div>    
<?php endif; ?>
</div><!-- //end #page-a -->
<div id="page-b">