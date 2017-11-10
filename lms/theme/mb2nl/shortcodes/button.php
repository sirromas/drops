<?php

defined('MOODLE_INTERNAL') || die();


mb2_add_shortcode('button', 'mb2_shortcode_button');

function mb2_shortcode_button($atts, $content= null){
	
	extract(mb2_shortcode_atts( array(
		'type' => 'default',
		'size' => '',
		'link' => '#',
		'target' => '',
		'icon'=> '',
		'icon_size'=> '18',
		'icon_pos'=> 'before',
		'ttpos'=>'top',
		'tttext'=> '',
		'fw' => 0,
		'rounded'=>0,
		'class'=>'',
		'margin'=>'',
		'border'=>0,
		'attribute'=>''
	), $atts));	
	
	$output = '';
	$iconpref = '';
	
	// Define some button parameters	
	$iconname = $icon;	
	
	
	
	// Button icon
	$btnicon = '';
	
	if ($icon !='')	
	{	
		$btnicon = '<i class="' . $iconpref . $iconname . '" style="font-size:' . $icon_size . 'px;"></i>';		
	}
	
	
	$btntitle = $tttext ? ' title="' . $tttext . '"' : '';
	
	
	$btntext = '<span class="btn-text">' . $content . '</span>';
		
	
	// Define button css class
	$btncls = $type;
	$btncls .= $size ? ' btn-' . $size : '';
	$btncls .= $tttext !='' ? ' tmpl-tooltip' : '';
	$btncls .= $icon_pos === 'before' ? ' btn-icon-before' : ' btn-icon-after';
	//$btncls .= $rounded == 1 ? ' rounded' : '';
	$btncls .= $border == 1 ? ' border' : '';
	$btncls .= $fw == 1 ? ' btn-full' : '';
	$btncls .= $class !='' ? ' ' . $class : '';
	
	
	// Additional button attribute
	$isattribute = $attribute !='' ? ' ' . $attribute : '';
	
	
	// Button style
	$style = $margin !='' ? ' style="margin:' . $margin . '"' : '';
	
	
	// Define button data attribute
	$btndata = $tttext !='' ? ' data-placement="' . $ttpos . '"' : '';
	
	$output .= '<a href="' . $link . '" target="' . $target . '" class="btn btn-' . $btncls . '"' . $style . $btntitle . $btndata . $isattribute . '>';
	$output .= $icon_pos == 'before' ? $btnicon . $btntext : $btntext . $btnicon;
	$output .= '</a>';	
	
	return $output;
	
}