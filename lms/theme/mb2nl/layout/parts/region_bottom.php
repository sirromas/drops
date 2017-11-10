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


$regionArr = explode(',', theme_mb2nl_theme_setting($PAGE,'regionnogrid'));
$regionGrid = !in_array('bottom', $regionArr);

?>
<div id="bottom" class="dark1">
	<?php if (theme_mb2nl_isblock($PAGE, 'bottom')) : ?>
		<?php if ($regionGrid) : ?>
            <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
        <?php endif; ?>
            <?php echo $OUTPUT->blocks('bottom', theme_mb2nl_block_cls($PAGE, 'bottom','bottom')); ?>
        <?php if ($regionGrid) : ?>
            </div>
            </div>
            </div>
        <?php endif; ?>	
    <?php endif; ?>
</div>