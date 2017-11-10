<?php

defined('MOODLE_INTERNAL') || die();


function mb2_shortcode_accordion($atts, $content= null){	
	extract(mb2_shortcode_atts( array(
		'show_all' => '0',
		'class' => '',
		'margin' => '',
		'parent' => '1'				
		), $atts)
	);
	
	
	if(isset($GLOBALS['collapse_count'])){
      $GLOBALS['collapse_count']++;
	}else{
      $GLOBALS['collapse_count'] = 0;
	}
	
	$GLOBALS['parent'] = $parent;
	
	
	$uniqid = uniqid();	
	$GLOBALS['uniqid'] = $uniqid;	
	
	$output = '';
	
	
	$cls = $class != '' ? ' ' . $class : '';
	
	
	$style = $margin !='' ? ' style="margin:' . $margin . ';"' : '';
	
		
	$output .= '<div class="mb2-accordion id' . $GLOBALS['uniqid'].' accordion panel-group' . $cls . '"' . $style . ' data-id="id' . $GLOBALS['uniqid'] . '"';
	
	if($show_all !=1){
		$output .= ' id="mb2-collapse-' . $GLOBALS['collapse_count'] . '"';
	}
	
	$output .= '>' . mb2_do_shortcode($content) . '</div>';
	
		
	return $output;	
	
}

mb2_add_shortcode('accordion', 'mb2_shortcode_accordion');







function mb2_shortcode_accordion_item($atts, $content= null){
	extract(mb2_shortcode_atts( array(
		'title' => '',
		'active' => 0,
		'icon' => ''			
		), $atts)
	);
	
		
	
	// Check waht is the icon
	$isfa = preg_match('@fa-@', $icon);
	$is7stroke = preg_match('@pe-7s-@', $icon);	
	$pref = $isfa ? 'fa ' : '';	
	
		
	//get collapse id
	$col_id = theme_mb2nl_string_url_safe($title) . '_acc';
		
		
	//get active class
	$in = '';		
	if($active == 1){
		$in = ' in';
	}		
	
	$output = '';
	
	
	$cls = $active == 1 ? '' : 'collapsed';	
	$is_icon = ' no-icon';
	
	
	// Check if in title is an icon
	if($icon !=''){		
		
		$is_icon = ' is-icon';			
		$title = '<i class="' . $pref . $icon . '"></i> ' . $title;
		
	}
	
	
	$collapse_count = isset($GLOBALS['collapse_count']) ? $GLOBALS['collapse_count'] : '';
	
	$parent = isset($GLOBALS['parent']) ? $GLOBALS['parent'] : 1;
	
	$isparent = $parent ? ' data-parent="#mb2-collapse-' . $collapse_count . '"' : '';				
	
	
	$output .= '<div class="panel panel-default"><div class="panel-heading' . $is_icon . '">';		
	
	$output .= '<p class="panel-title"><a data-toggle="collapse"' . $isparent . ' href="#' . $col_id . '" class="' . $cls . '">' . $title . '</a></p></div>';		
	
	$output .= '<div id="' . $col_id .'" class="panel-collapse collapse' . $in . '"><div class="panel-body">'; 
	
	$output .= mb2_do_shortcode($content);		
	
	$output .= '</div></div></div>';
	
		
	return $output;				
}

mb2_add_shortcode('accordion_item', 'mb2_shortcode_accordion_item');