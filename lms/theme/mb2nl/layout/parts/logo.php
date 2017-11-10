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


?>
<div class="main-logo" style="width:<?php echo theme_mb2nl_theme_setting($PAGE, 'logow','180'); ?>px;margin:<?php echo theme_mb2nl_theme_setting($PAGE, 'logom','20px 0 20px 0'); ?>;">
	<a href="<?php echo $CFG->wwwroot; ?>" title="<?php echo theme_mb2nl_theme_setting($PAGE, 'logotitle','New Learning'); ?>">
		<img src="<?php echo theme_mb2nl_logo_url($PAGE); ?>" alt="<?php echo theme_mb2nl_theme_setting($PAGE, 'logoalttext','New Learning'); ?>">
	</a>                    
</div>