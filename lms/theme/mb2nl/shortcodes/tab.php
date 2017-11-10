<?php

defined('MOODLE_INTERNAL') || die();


function mb2_shortcode_tab($atts, $content = null ) {
	
	$unique = mt_rand();
	
	extract( mb2_shortcode_atts( array(
		  'tabpos' => 'top',
		  'height'=>'200',
		  'class' => '',
		  'margin' => ''
	), $atts ));
	
	
	$regex = '\\[(\\[?)(tab_item)\\b([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)(?:(\\/)\\]|\\](?:([^\\[]*+(?:\\[(?!\\/\\2\\])[^\\[]*+)*+)\\[\\/\\2\\])?)(\\]?)';
	preg_match_all("/$regex/is",$content,$match);
	$content = $match[0];
	
	
	// Define tabs style
	$style = ' style="';
	$style .= 'min-height:' . $height . 'px;';
	$style .= $margin !='' ? 'margin:' . $margin . 'px;' : '';
	$style .= '"';
	
	
	$cls = $tabpos;
	$cls .= $class !='' ? ' ' . $class : '';
		
	
	$output = '<div class="theme-tabs tabs ' . $cls . '"' . $style . '>';
	$i = -1;
	
	
	$output .= '<ul class="nav nav-tabs">';
	
	foreach($content as $c){ $i++;
		$unique_id = 'tab_tab_' . $unique . '_' . $i;
		preg_match('/\[tab_item ([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)/', $c, $matchattr);
		$attr = shortcode_parse_atts($matchattr[1]);
		
		
		$title = $attr['title'];
		$icon = isset($attr['icon']) ? $attr['icon'] : '';
				
		if($icon !=''){
			
			// Check what is the icon and set prefix
			// and set preffix
			$isfa = preg_match('@fa-@', $icon);
			$isglyphicon = preg_match('@glyphicon-@', $icon);
			
			if ($isfa)
			{
				$iconpref = 'fa ';
			}
			elseif($isglyphicon)
			{
				$iconpref = 'glyphicon ';
			}
			else
			{
				$iconpref = '';
			}		
			
			$title = '<i class="'. $iconpref . $icon . '"></i> ' . $title;
						
		}
		
		$output .= '<li '.(($i==0) ? 'class="active"' : '').'><a href="#' . $unique_id . '" data-toggle="tab">' . $title . '</a></li>';
		$content[$i] = str_replace('[tab_item ','[tab_item '.(($i==0) ? 'class="active"' : '') . ' id="' . $unique_id . '" ', $content[$i]);
		
	}
	
	
	$output .= '</ul>';
	$output .= '<div class="tab-content">';
	
	
	foreach($content as $c){
		$output .= mb2_do_shortcode($c);
	}
	
	
	$output .= '</div>';
	$output .= '</div>';
	
	
	return $output;   
	   
}

mb2_add_shortcode('tabs', 'mb2_shortcode_tab');




function mb2_shortcode_tab_item( $atts, $content = null ) {
	extract( mb2_shortcode_atts( array(
		'title' => '',
		'id' =>'',
		'class' =>''
	), $atts ) );
		  
	
	$output = '<div class="tab-pane ' . $class . '" id="' . $id . '">';
	
	$output .= mb2_do_shortcode($content);
	
	$output .= '</div>';
	
	return $output;
}
mb2_add_shortcode('tab_item', 'mb2_shortcode_tab_item');