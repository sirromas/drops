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

$isLoginPage = theme_mb2nl_is_login($PAGE);

?>
<div class="sliding-panel dark1 closed">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 clearfix">
				<?php echo theme_mb2nl_search_form(); ?>
                <?php echo !$isLoginPage ? theme_mb2nl_login_form() : ''; ?> 
                <?php echo theme_mb2nl_theme_links(); ?>
                <div class="header-tools" style="bottom:-44px;">
                	<?php if (is_siteadmin()) : ?>
                     	<a href="#" class="toll-links"><i class="icon1 fa fa-cog fa-spin"></i><i class="icon2 pe-7s-close"></i></a>
                    <?php endif; ?>
                    <?php if (!$isLoginPage) : ?>
                    	<a href="#" class="toll-login"><i class="icon1 fa fa-user"></i><i class="icon2 pe-7s-close"></i></a>
                    <?php endif; ?>
                     <!--<a href="#" class="toll-search"><i class="icon1 fa fa-search"></i><i class="icon2 pe-7s-close"></i></a>-->
                </div> 
			</div>
		</div>
	</div>
</div>