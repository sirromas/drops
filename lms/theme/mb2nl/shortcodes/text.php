<?php

defined('MOODLE_INTERNAL') || die();

mb2_add_shortcode('text', 'mb2_shortcode_text');


function mb2_shortcode_text ($atts, $content= null){
	
	extract(mb2_shortcode_atts( array(
		'align' =>'',
		'size' => 'n',
		'color' => '',
		'margin' => '',
		'class'=> ''		
	), $atts));
	
	
	$output = '';
	
	
	$cls = $class !='' ? ' ' . $class : '';
	$cls .= ' text-' . $align;
	$cls .= ' text-' . $size;
	$cls .= ' text-' . $color;
	
	
	// Text container style  
	$cstyle = $margin !='' ? ' style="margin:' . $margin . ';"' : '';
				
	
	$output .= '<div class="theme-text' . $cls . '"' . $cstyle . '>';
	$output .= mb2_do_shortcode($content);	
	$output .= '</div>';
	
	
	return $output;
	
	
}