<?php

defined('MOODLE_INTERNAL') || die();


function mb2_list_fnc($atts, $content= null){	
	
	extract(mb2_shortcode_atts( array(
		'type' => 1,
		'horizontal' => 0,
		'align' => 'left',
		'class' => '',
		'margin' => ''				
		), $atts)
	);
	
	
	// Define list class
	$cls = $horizontal == 1 ? ' list-horizontal' : '';
	$cls .= ' list-' . $align;
	$cls .= $class !='' ? ' ' . $class : '';
	
	$style = $margin !='' ? ' style="margin:' . $margin . ';"' : '';
	
	
	$output = '';		
	$output .= '<ul class="theme-list list' . $type . $cls . '"' . $style . '>';	
	$output .= mb2_do_shortcode($content);	
	$output .= '</ul>';	
	
		
	return $output;	
	
}

mb2_add_shortcode('list', 'mb2_list_fnc');






mb2_add_shortcode('list_item', 'mb2_list_item_fnc');


function mb2_list_item_fnc ($atts, $content= null){
	
	extract(mb2_shortcode_atts( array(
		'icon' => '',
		'link'=> '',
		'link_target'=> '_self'		
	), $atts));	
		
	
		
	$isicon = $icon ? '<i class="' . $icon . '"></i> ' : '';	
		
	$output = '';	
	
	$output .= '<li>';	
	$output .= $link !='' ? '<a href="' . $link . '" target="' . $link_target . '">' : '';	
	$output .= $isicon;	
	$output .= mb2_do_shortcode($content);	
	$output .= $link !='' ? '</a>' : '';	
	$output .= '</li>';
	
	
	return $output;
	
	
}