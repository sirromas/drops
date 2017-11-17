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

$socilaTt = theme_mb2nl_theme_setting($PAGE, 'socialtt', 0) == 1 ? 'top' : '';
$footThemeContent =  'Copyright © Learning Drops 2017. All rights reserved.';
$footContent = format_text($footThemeContent, FORMAT_HTML);
$footLogin =  theme_mb2nl_theme_setting($PAGE, 'footlogin', 0);
$footerTools = (is_siteadmin() || $footLogin == 1); 
?>
<footer id="footer" class="dark1">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-sm-12">
            	<div class="footer-content clearfix">
					<p class="footer-text"><?php echo $footContent; ?></p>
                	<?php if (theme_mb2nl_theme_setting($PAGE, 'socialfooter',0) == 1) : ?>
						<?php echo theme_mb2nl_social_icons($PAGE, array('tt'=>$socilaTt,'pos'=>'footer')); ?>
               	 	<?php endif; ?>  
                </div>          
     		</div>
        </div>
    </div>    
</footer>
</div><!-- //end #page-b -->
</div><!-- //end #page -->
</div><!-- //end #page-outer -->
<?php echo theme_mb2nl_iconnav($PAGE); ?>
<?php if (theme_mb2nl_theme_setting($PAGE, 'scrolltt',0) == 1) :?>
	<?php echo theme_mb2nl_scrolltt($PAGE); ?>
<?php endif; ?>
<?php echo $OUTPUT->standard_end_of_body_html(); ?>
</body>
</html>