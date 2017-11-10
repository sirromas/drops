<?php

defined('MOODLE_INTERNAL') || die();


mb2_add_shortcode('boxes', 'mb2_shortcode_boxes');


function mb2_shortcode_boxes ($atts, $content= null){	
	extract(mb2_shortcode_atts( array(
		'columns' =>'1', // max 5
		'size' => '',
		'margin' => ''
	), $atts));
		
	
	$output = '';
	
	$cls = $size === 'small' ? ' boxes-small' : '';
	
	$style = $margin !='' ? ' style="padding:' . $margin . ';"' : '';
		
	$output .= '<div class="theme-boxes col-' . $columns . $cls . ' clearfix"' . $style . '>';
	
	$output .= mb2_do_shortcode($content);
	
	$output .= '</div>';
	
	
	return $output;
	
}





mb2_add_shortcode('boximg', 'mb2_shortcode_boximg');


function mb2_shortcode_boximg ($atts, $content = null){	
	extract(mb2_shortcode_atts( array(
		'image' =>'',
		'link' =>'',
		'link_target' =>'',
		'color' =>''
	), $atts));
		
	
	$output = '';
	
	
	$style = $color!='' ? ' style="background-color:' . $color . ';"' : '';
	
	
	
	$output .= '<div class="theme-box">';
	$output .= $link !='' ? '<a href="' . $link . '" target="' . $link_target . '">' : '';
	$output .= '<div class="theme-boximg">';
	$output .= '<h4>' . $content . '</h4>';	
	$output .= '<div class="theme-boximg-color"' . $style . '></div>';
	$output .= '<div class="theme-boximg-img" style="background-image:url(\'' . $image . '\');background-repeat:no-repeat;background-position:50% 50%;background-size:cover;"></div>';	
	$output .= '</div>';
	$output .= $link !='' ? '</a>' : '';
	$output .= '</div>';
	
	return $output;
	
}







mb2_add_shortcode('boxicon', 'mb2_shortcode_boxicon');


function mb2_shortcode_boxicon ($atts, $content = null){	
	extract(mb2_shortcode_atts( array(
		'icon' =>'fa-rocket',
		'type' => 1,
		'title'=> '',
		'link' => '',
		'color' => 'primary',
		'link_target' =>''
	), $atts));
		
	
	$output = '';
	
	
	// Check waht is the icon
	$isfa = preg_match('@fa-@',$icon);
	$is7stroke = preg_match('@pe-7s-@',$icon);	
	$pref = $isfa ? 'fa ' : '';
		
	
	
	$output .= '<div class="theme-box">';
	$output .= $link !='' ? '<a href="' . $link . '" target="' . $link_target . '">' : '';
	$output .= '<div class="theme-boxicon type-' . $type . ' color-' . $color . '">';
	$output .= '<div class="theme-boxicon-icon">';
	$output .= '<i class="' . $pref . $icon . '"></i>';
	$output .= '</div>';
	$output .= $link !='' ? '</a>' : '';
	$output .= '<div class="theme-boxicon-content">';
	$output .= $title !='' ? '<h4>' . $title . '</h4>' : '';
	$output .= mb2_do_shortcode($content);	
	$output .= '</div>';	
	$output .= '</div>';
	$output .= '</div>';
	
	
	return $output;
	
}









mb2_add_shortcode('boxcontent', 'mb2_shortcode_boxcontent');

function mb2_shortcode_boxcontent ($atts, $content = null){	
	extract(mb2_shortcode_atts( array(
		'icon' =>'',
		'type' => '1',
		'title'=> '',
		'link' =>'',
		'linktext' =>'Read more',
		'color' => 'primary',
		'link_target' =>''
	), $atts));
		
	
	$output = '';
	
	
	// Check waht is the icon
	$isfa = preg_match('@fa-@',$icon);
	$is7stroke = preg_match('@pe-7s-@',$icon);	
	$pref = $isfa ? 'fa ' : '';
	
	$boxCls = $icon !='' ? ' isicon' : ' noicon';
	$boxCls .= $link !='' ? ' islink' : '';
	
	
	$output .= '<div class="theme-box">';
	
	$output .= '<div class="theme-boxcontent type-' . $type . ' color-' . $color . $boxCls . '">';	
	$output .= '<div class="theme-boxcontent-content">';
	$output .=  $icon !='' ?'<div class="theme-boxcontent-icon">' : '';
	$output .=  $icon !='' ? '<i class="' . $pref . $icon . '"></i>' : '';
	$output .=  $icon !='' ?'</div>' : '';
	$output .= $title !='' ? '<h4>' . $title . '</h4>' : '';
	$output .= mb2_do_shortcode($content);	
	$output .= '</div>';
	$output .= $link !='' ? '<a class="theme-boxcontent-readmore" href="' . $link . '" target="' . $link_target . '">' . $linktext . '</a>' : '';	
	$output .= '</div>';
	$output .= '</div>';
	
	
	return $output;
	
}

