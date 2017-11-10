<?php

defined('MOODLE_INTERNAL') || die();





function mb2_shortcode_slider($atts, $content= null){	
	extract(mb2_shortcode_atts( array(
		'margin' => '',
		'width' => '',
		'class' => '',
		'columns' => 1,
		'gutter' => 0,
		'loop' => 1,
		'nav' => 1,
		'dots' => 1,
		'autoplay' => 1	,
		'pausetime' => 5000,
		'animtime' => 450		
	), $atts));
	
			
	$output = '';
	$sData = '';
	$style = '';
	
		
	$cls = $class != '' ? ' ' . $class : '';
	
	if ($width !='' || $margin !='')
	{	
		$style .= ' style="';
		$style .= $margin !='' ? 'margin:' . $margin . ';' : '';
		$style .= $width !='' ? 'width:' . $width . 'px;max-width:100%;' : '';
		$style .= '"';
	}
		
	
	$sData .= ' data-items="' . $columns . '"';
	$sData .= ' data-margin="' . $gutter . '"';
	$sData .= ' data-loop="' . $loop . '"';
	$sData .= ' data-nav="' . $nav . '"';
	$sData .= ' data-dots="' . $dots . '"';
	$sData .= ' data-autoplay="' . $autoplay . '"';
	$sData .= ' data-pausetime="' . $pausetime . '"';
	$sData .= ' data-animtime="' . $animtime . '"';
	
	
	$cls = $dots == 1 ? ' isdots' : '';
			
	$output .= '<div class="theme-slider-wrap"' . $style . '>';	
	$output .= '<div class="theme-slider owl-carousel' . $cls . '"' . $sData  . '>';
	$output .= mb2_do_shortcode($content); 
	$output .= '</div>';
	$output .= '</div>';
	
		
	return $output;	
	
}

mb2_add_shortcode('slider', 'mb2_shortcode_slider');




function mb2_shortcode_slider_item($atts, $content= null){
	extract(mb2_shortcode_atts( array(
		'title' => '',
		'desc' => '',
		'image' => '',
		'link' => '',
		'target' => ''			
		), $atts)
	);
	
	
	$output = '';
	
	$isTarget = $target === '_blank' ? ' target="_blank"' : '';
		
	
	$output .= '<div class="item">';
	
	$output .= $link !='' ? '<a href="' . $link . '"' . $isTarget . '>' : '';
	
	$output .= '<img src="' . $image . '" alt="' . $title . '">';
	
	if ($title !='' ||$desc !='' )
	{
		$output .= '<div class="slider-caption">';
		$output .= '<h3>' . $title . '</h3>';
		$output .= '<div class="slider-desc">' . $desc . '</div>';
		$output .= '</div>';	
	}
	
	$output .= $link !='' ? '</a>' : '';
	
	$output .= '</div>';
		
		
	return $output;	
	
	
	
				
}

mb2_add_shortcode('slider_item', 'mb2_shortcode_slider_item');