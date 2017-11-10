<?php

defined('MOODLE_INTERNAL') || die();


function mb2_shortcode_video($atts, $content= null){
			
	extract(mb2_shortcode_atts( array(
		'width'=>'',
		'id'=>'',
		'video_icon'=>'fa fa-play',
		'video_text'=>'',
		'ratio'=>'16:9',
		'margin' => '',
		'bg_image' => ''
	), $atts));
	
	
	$output = '';
	
	
	// Define margin
	$mg = $margin !='' ? 'margin:' . $margin . ';' : '';
	
	
	// Define video icon
	$isicon = $video_icon !='' ? $video_icon : 'fa fa-play';
	
	
	if(preg_match('/^[0-9]+$/', $id)){			
		$video_url = '//player.vimeo.com/video/'. $id;			
	}
	else{
		$video_url = '//www.youtube.com/embed/'. $id;		
	}
			
					
	$isratio = str_replace(':', 'by', $ratio);
	
	
	$cls = 	$bg_image !='' ? ' isimage' : '';
			
	$ifstyle = 'style="';
	$ifstyle .= $width !='' ? 'max-width:' . $width . 'px;' : '';
	$ifstyle .= $mg;
	$ifstyle .= '"';
		
			
	$output .= '<div class="embed-responsive-wrap' . $cls . '"' . $ifstyle . '>';
	$output .= $bg_image !='' 
	? '<i class="' . $isicon . '"></i><div class="embed-video-bg" style="background-image:url(' . $bg_image . ');" data-videourl="' . $video_url . '?autoplay=1&showinfo=0"></div>' : '';
	$output .= '<div class="embed-responsive embed-responsive-'. $isratio . '">';
	$output .=  $bg_image !='' ? '<iframe allowfullscreen></iframe>' : '<iframe src="' . $video_url . '?showinfo=0" allowfullscreen></iframe>';
	$output .= '</div>';
	$output .= '</div>';	
		
	return $output;	
	
}

mb2_add_shortcode('video', 'mb2_shortcode_video');