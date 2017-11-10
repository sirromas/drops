<?php

defined('MOODLE_INTERNAL') || die();


mb2_add_shortcode('icon', 'mb2_shortcode_icon');

function mb2_shortcode_icon($atts, $content= null){
	extract(mb2_shortcode_atts( array(
		'name' => 'fa-star',
		'color' => '',
		'size' => 'default',
		'spin'=> '0',
		'rotate'=>'normal',
		'margin' => '',
		'sizebg'=>'',
		'rounded'=>'',
		'bgcolor'=>'',
		'icon_text_pos'=>'after',
		'class' => '',
		'nline' => 0
	), $atts));
	
		
	// Check waht is the icon
	$isfa = preg_match('@fa-@',$name);
	$is7stroke = preg_match('@pe-7s-@',$name);	
	$cls = '';
	$output = '';
	$pref = $isfa ? 'fa ' : '';
	
	
	$cls .= (($isfa || $is7stroke) && $spin == 1) ? $is7stroke ? ' pe-spin' : ' fa-spin' : '';
	$cls .= (($isfa || $is7stroke) && $rotate != 'normal') ? $is7stroke ? ' pe-' . $rotate : ' fa-' . $rotate : '';
	$cls .= ' ' . $pref . $name;
	$cls .= ' icon-size-' . $size;
	$cls .= $class !='' ? ' ' . $class : '';
	
	
	// Wrap class
	$wcls = $bgcolor !='' ? ' iconbg' : '';	
	$wcls .= $rounded == 1 ? ' iconrounded' : '';
	
	
	// Wrap style
	$sstyle = ' style="';
	$sstyle .= $nline == 1 ? 'display:block;' : '';	
	$sstyle .= $margin !='' ? 'margin:' . $margin . ';' : '';
	$sstyle .= '"';		
	
	
	// Set icon style
	$style = ' style="';
	$style .= $color !='' ? 'color:' . $color . ';' : '';
	//$style .= ($margin !='' && $bgcolor == '') ? 'margin:' . $margin . ';' : '';
	$style .= '"';
	
	
	// Wrap style
	$wstyle = ' style="';
	$wstyle .= $sizebg > 0 ? 'width:' . $sizebg . 'px;text-align:center;height:' .  $sizebg . 'px;line-height:' . $sizebg . 'px;' : '';
	$wstyle .= $bgcolor !='' ? 'background-color:' . $bgcolor . ';' : '';
	//$wstyle .= ($margin !='' && $bgcolor != '') ? 'margin:' . $margin . ';' : '';
	$wstyle .= '"';
	
	
	
	$iscontent = $content !='' ? '<span class="tmpl-icon-content">' . mb2_do_shortcode($content) . '</span>' : '';
	
	
	$output .= '<span class="tmpl-icon-wrap' . $wcls . '"' . $sstyle . '>';
	$output .= $icon_text_pos === 'before' ? $iscontent : '';
	$output .= $bgcolor ? '<span class="tmpl-icon-bg"' . $wstyle . '>' : '';
	$output .= '<i class="tmpl-icon' . $cls . '"' . $style . '></i>';
	$output .= $bgcolor ? '</span>' : '';	
	$output .= $icon_text_pos === 'after' ? $iscontent : '';
	$output .= '</span>';
	
	
	return $output;
	
	
	
}