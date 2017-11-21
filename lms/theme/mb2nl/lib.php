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
 




/*
 *
 * Method to set body class
 *
 *
 */
function theme_mb2nl_body_cls($page)
{
	
	$output = array();
	
	
	// Page layout
	$output[] = 'theme-l' . theme_mb2nl_theme_setting($page, 'layout', 'fw');
	
	
	// Header style
	$output[] = 'header-' . theme_mb2nl_theme_setting($page, 'headerstyle', 'light');
	
	
	// Icon nav menu class
	theme_mb2nl_theme_setting($page, 'naviconurl1') !='' ? $output[] = 'isiconmenu' : NULL;
	
	
	// Custom login page 
	theme_mb2nl_is_login($page, true) ? $output[] = 'custom-login' : NULL;
	
	
	// User logged in or logged out (not guest)
	(isloggedin() && !isguestuser()) ? $output[] = 'loggedin' : NULL;
	
	
	// Check if is guest user
	isguestuser() ? $output[] = 'isguestuser' : NULL;
	
	
	// Custom page classess
	$output[] = theme_mb2nl_page_cls($page);
	
	
	// Custom course pages class
	$output[] = theme_mb2nl_page_cls($page, true);
	
	
	// Custom course class
	$output[] = theme_mb2nl_course_cls($page);
	
	
	// Course category theme
	$output[] = theme_mb2nl_courselist_cls($page);
	
	
	// Fixed navigation
	theme_mb2nl_theme_setting($page, 'stickynav', 0) ? $output[] = 'sticky-nav' : NULL;
	
	
	// Page predefined background
	(!theme_mb2nl_is_login($page, true) && theme_mb2nl_theme_setting($page, 'pbgpre') !='') 
	? $output[] = 'pre-bg' . theme_mb2nl_theme_setting($page, 'pbgpre') : NULL;
	
	
	// Login page predefined background
	(theme_mb2nl_is_login($page, true) && theme_mb2nl_theme_setting($page, 'loginbgpre') !='') 
	? $output[] = 'pre-bg' . theme_mb2nl_theme_setting($page, 'loginbgpre') : NULL;
	
	
	return $output;
	
	
}





/*
 *
 * Method to check if is login page
 *
 *
 */
function theme_mb2nl_is_login($page, $custom = false)
{
	
	$output = false;
	
	
	$pTypeArr = explode('-', $page->pagetype);
	$isLoginPage = ($pTypeArr[0] === 'login');
	$customLoginPage = theme_mb2nl_theme_setting($page, 'cloginpage', '', 0);
	
	
	if ($custom) 
	{	
		$output = ($isLoginPage && $customLoginPage);
	}
	else
	{
		$output = $isLoginPage;
	}
	
	
	return $output;
	
	
}










/*
 *
 * Method to get theme scripts
 *
 *
 */
function theme_mb2nl_theme_scripts ($page, $attribs = array())
{
		
	global $USER, $CFG;		
	
	
	// Check if Moodle version is 2.9+
	// to use Bootstrap 3 AMD				
	$m28 = '2014111012';
	$m29plus = ($CFG->version > $m28);
						
	
	// jQuery framework
	//$page->requires->jquery();
	//$page->requires->jquery_plugin('ui');
		
	
	// Bootstrap 3
	!$m29plus ? $page->requires->js('/theme/mb2nl/assets/bootstrap/bootstrap.min.js',true) : '';	
		
	
	// Sf menu script
	$page->requires->js('/theme/mb2nl/assets/superfish/superfish.custom.min.js');
	
	
	// OWL carousel	
	$page->requires->css('/theme/mb2nl/assets/OwlCarousel/assets/owl.carousel.min.css');
	$page->requires->js('/theme/mb2nl/assets/OwlCarousel/owl.carousel.min.js');
	
	
	// Nivo-Lightbox
	$page->requires->css('/theme/mb2nl/assets/Nivo-Lightbox/nivo-lightbox.min.css');
	$page->requires->js('/theme/mb2nl/assets/Nivo-Lightbox/nivo-lightbox.min.js');
	
	
	// Spectrum color
	$page->requires->css('/theme/mb2nl/assets/spectrum/spectrum.min.css');
	$page->requires->js('/theme/mb2nl/assets/spectrum/spectrum.min.js');	
	
				
	// Theme scripts
	if ($m29plus)
	{
		$page->requires->js('/theme/mb2nl/javascript/theme-amd.js');
	}
	else
	{
		$page->requires->js('/theme/mb2nl/javascript/theme-no-amd.js');
	}
	
	
	$page->requires->js('/theme/mb2nl/javascript/theme.js');
	
	
	// Youtube api player
	$page->requires->js('/theme/mb2nl/assets/youtube/player_api.js');
	
	
	// Custom scripts
	$cssFiles = theme_mb2nl_get_custom_files(1);
	$jsFiles = theme_mb2nl_get_custom_files(2);
	
	
	foreach ($cssFiles as $cssF)
	{
		$page->requires->css('/theme/mb2nl/style/custom/' . $cssF . '.css');
	}
	
	
	foreach ($jsFiles as $jsF)
	{
		$page->requires->js('/theme/mb2nl/javascript/custom/' . $jsF . '.js');
	}
				 	
		
}









/*
 *
 * Method to get Google webfonts
 *
 *
 */
function theme_mb2nl_google_fonts ($page, $attribs = array())
{
				
	$output = '';
		
				
	for ($i = 1; $i <=3; $i++)
	{
			
		$gfontname = theme_mb2nl_theme_setting($page, 'gfont' . $i);
		$gfontstyle = theme_mb2nl_theme_setting($page, 'gfontstyle' . $i);
		$isStyle = $gfontstyle !='' ? ':' . $gfontstyle : '';
		$gfontsubset = theme_mb2nl_theme_setting($page, 'gfontsubset' . $i);
		$isSubset = $gfontsubset !='' ? '&amp;subset=' . $gfontsubset : '';	
			
		if ($gfontname !='')
		{			
			$output .= '<link href="//fonts.googleapis.com/css?family=' . str_replace(' ', '+', $gfontname) . $isStyle . $isSubset . '" rel="stylesheet">';				
		}			
			
	}			
			 	
		
	return $output;
		
}







/*
 *
 * Method to get social icons list
 *
 *
 */
function theme_mb2nl_social_icons ($page, $attribs = array())
{
				
	$output = '';	
	$linkTarget = theme_mb2nl_theme_setting($page, 'sociallinknw') == 1 ? ' target="_balnk"' : ''; 	
		
		
	// Define margin
	$marginArr = explode(',', theme_mb2nl_theme_setting($page, 'socialmargin', ''));
	$marginHeader = (isset($marginArr[0]) && $marginArr[0] !='') ? $marginArr[0] : false;
	$marginFooter = (isset($marginArr[1]) && $marginArr[1] !='') ? $marginArr[1] : false;
	$marginStyle = '';
		
		
	if ($attribs['pos'] === 'header' && $marginHeader)
	{
		$marginStyle = ' style="margin:' . $marginHeader . ';"';
	}
	elseif ($attribs['pos'] === 'footer' && $marginFooter)
	{
		$marginStyle = ' style="margin:' . $marginFooter . ';"';
	}		
		
		
	$output .= '<ul class="social-list"' . $marginStyle . '>';
		
		
	for ($i = 1; $i <=10; $i++)
	{			
			
		$socialName = explode(',', theme_mb2nl_theme_setting($page, 'socialname' . $i));
		$socialLink = theme_mb2nl_theme_setting($page, 'sociallink' . $i);
			
			
		if (isset($socialName[0]) && $socialName[0] != '')
		{
			
			$isTt = (isset($attribs['tt']) && $attribs['tt']!='') ? ' data-toggle="tooltip" data-placement="' . $attribs['tt'] . '" title="' . $socialName[1] . '"' : '';
			
			
			$output .= '<li class="li-' . $socialName[0] . '"><a href="' . $socialLink . '"' . $linkTarget . $isTt . '><i class="fa fa-' . $socialName[0] . '"></i></a></li>';
			
		}
			
	}
		
		
	$output .= '</ul>';			
		
		
	return $output;		
			 	
		
}








/*
 *
 * Method to get menu data attributes
 *
 *
 */
function theme_mb2nl_menu_data ($page, $attribs = array())
{
				
	$output = '';	
		
		
	$output .= ' data-animtype="' . theme_mb2nl_theme_setting($page, 'navatype', 2) . '"';
	$output .= ' data-animspeed="' . theme_mb2nl_theme_setting($page, 'navaspeed', 300) . '"';	
		
		
	return $output;		
			 	
		
}


/*
 *
 * Method to get custom css and js file
 *
 *
 */
function theme_mb2nl_get_custom_files ($type)
{	
	
	global $CFG;
	
	
	$cssDir = $CFG->dirroot . '/theme/mb2nl/style/custom/';
	$jsDir = $CFG->dirroot . '/theme/mb2nl/javascript/custom/';
	
	
	if (is_dir($cssDir) && $type == 1)
	{
		return theme_mb2nl_file_arr($cssDir, array('css'));
	}
	elseif (is_dir($jsDir) && $type == 2)
	{
		return theme_mb2nl_file_arr($jsDir, array('js'));
	}	
	
}






/*
 *
 * Method to get files array from directory
 *
 *
 */
function theme_mb2nl_file_arr ($dir, $filter = array('jpg','jpeg','png','gif'))
{
	
	
	$output = '';
	$filesArray = array();
	
	if (!is_dir($dir))
	{
			
		$output = get_string('foldernoexists','theme_mb2nl');
			
	} 
	else 
	{
			
		
		$dirContents = scandir($dir);
		
			
		foreach ($dirContents as $file) 
		{
				
			$file_type = pathinfo($file, PATHINFO_EXTENSION);
				
			if (in_array($file_type, $filter)) 
			{
				$filesArray[] = basename($file, '.' . $file_type);
			}
				
		}			
			
		$output = $filesArray;		
			
	}
	
		
	return $output;
	
	
}








/*
 *
 * Method to get random image from array
 *
 *
 */
function theme_mb2nl_random_image ($dir, $pixDirName, $attribs = array('jpg','jpeg','png','gif'))
{
		
	global $OUTPUT, $CFG;
	
	$moodle33 = 2017051500;
		
	$output = '';
		
	$arr = theme_mb2nl_file_arr($dir, $attribs);
		
		
	if (is_array($arr) && !empty($arr))
	{
			
		$randomImg = array_rand($arr,1);					
		$output = $CFG->version >= $moodle33 ? $OUTPUT->image_url($pixDirName . '/' . $arr[$randomImg],'theme') : $OUTPUT->pix_url($pixDirName . '/' . $arr[$randomImg],'theme');
			
	}
		
		
	return $output;	
		
		
		
}




/*
 *
 * Method to get font icons
 *
 *
 */
function theme_mb2nl_font_icon ($page, $attribs = array())
{
				
	$output = '';
		
		
	$faIcons = theme_mb2nl_theme_setting($page, 'ficonfa', 1);
	$ficon7stroke = theme_mb2nl_theme_setting($page, 'ficon7stroke', 1);
	$glyphIcons = theme_mb2nl_theme_setting($page, 'ficonglyph', 1);
		
		
	if ($faIcons == 1)
	{
		$page->requires->css('/theme/mb2nl/assets/font-awesome/css/font-awesome.min.css');
	}
		
		
	if ($ficon7stroke == 1)
	{
		$page->requires->css('/theme/mb2nl/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.min.css');
	}	
	
	
	if ($glyphIcons == 1)
	{
		$page->requires->css('/theme/mb2nl/assets/bootstrap/css/glyphicons.min.css');
	}	
			 	
		
	return $output;
		
}
	










/*
 *
 * Method to set body class
 *
 *
 */
function theme_mb2nl_settings_arr()
{
	
	$output = array(
		'general' => array('name'=>get_string('settingsgeneral','theme_mb2nl'), 'icon'=>'fa fa-dashboard'),
		'features' => array('name'=>get_string('settingsfeatures','theme_mb2nl'), 'icon'=>'fa fa-dashboard'),
		'fonts' => array('name'=>get_string('settingsfonts','theme_mb2nl'), 'icon'=>'fa fa-font'),
		'nav' => array('name'=>get_string('settingsnav','theme_mb2nl'), 'icon'=>'fa fa-navicon'),
		'pages' => array('name'=>get_string('settingspages','theme_mb2nl'), 'icon'=>'fa fa-font'),
		'social' => array('name'=>get_string('settingssocial','theme_mb2nl'), 'icon'=>'fa fa-share-alt'),
		'style' => array('name'=>get_string('settingsstyle','theme_mb2nl'), 'icon'=>'fa fa-paint-brush'),			
		'typography' => array('name'=>get_string('settingstypography','theme_mb2nl'), 'icon'=>'fa fa-text-height')		
	);	
	
	return $output;	
	
}







/*
 *
 * Method to get image url
 *
 *
 */
function theme_mb2nl_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array())
{
    
	
	if ($context->contextlevel == CONTEXT_SYSTEM) 
	{
       
	    $theme = theme_config::load('mb2nl');
		
		switch ($filearea)
		{
			
			case 'logo' :
			return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
			break;
			
			
			case 'pbgimage' :
			return $theme->setting_file_serve('pbgimage', $args, $forcedownload, $options);
			break;
			
			
			case 'bcbgimage' :
			return $theme->setting_file_serve('bcbgimage', $args, $forcedownload, $options);
			break;
			
			
			case 'acbgimage' :
			return $theme->setting_file_serve('acbgimage', $args, $forcedownload, $options);
			break;
			
			
			case 'asbgimage' :
			return $theme->setting_file_serve('asbgimage', $args, $forcedownload, $options);
			break;
			
			
			case 'loginbgimage' :
			return $theme->setting_file_serve('loginbgimage', $args, $forcedownload, $options);
			break;
			
			
			case 'loginlogo' :
			return $theme->setting_file_serve('loginlogo', $args, $forcedownload, $options);
			break;	
			
			
			case 'loadinglogo' :
			return $theme->setting_file_serve('loadinglogo', $args, $forcedownload, $options);
			break;
			
			
			case 'favicon' :
			return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
			break;
						
						
			default :
			send_file_not_found();
			
		}
		
	} 
	else 
	{
        send_file_not_found();
    }
	
}

 
 
 
 
 
 
 
/*
 *
 * Method to get predefined scss variables
 *
 *
 */ 
function theme_mb2nl_get_pre_scss($theme) 
{                                                                                         
   
    
	global $CFG;
	$scss = ''; 	
	                                                                                                                    
    $vars = theme_mb2nl_get_style_vars();                                                                                                          
 
                                                                                                       
    foreach ($vars as $k => $v) 
	{  
	
		switch ($k)
		{
			
			case ('ffgeneral') :									
				
				$fname = $theme->settings->ffgeneral;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? $theme->settings->$fname : NULL;			
				break;							
			
			case ('ffheadings') :			
			
				$fname = $theme->settings->ffheadings;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? $theme->settings->$fname : NULL;					
				break;				
			
			case ('ffmenu') :			
			
				$fname = $theme->settings->ffmenu;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? $theme->settings->$fname : NULL;				
				break;			
			
			case ('ffddmenu') :						
			
				$fname = $theme->settings->ffddmenu;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? $theme->settings->$fname : NULL;					
				break;						
			
			default :			
			 
			$isv = isset($theme->settings->$k) ? $theme->settings->$k : NULL; 
				
		}
		                                    
        
		if (empty($isv)) {                                                                                                        
            continue;                                                                                                               
        }
		
		
		$issuffix = isset($v[1]) ? $v[1] : '';
				  
		$scss .= '$' . $v[0] . ': ' . $isv . $issuffix . ';';
		                                                                                                      
    }                                                                                                                               
 
    
	$scss .= !empty($theme->settings->scsspre) ? $theme->settings->scsspre : '';
	
	
	return $scss; 
	                                                                                                                  
}










/*
 *
 * Method to get predefined less variables
 *
 *
 */ 
function theme_mb2nl_get_pre_less($theme) 
{                                                                                         
   
    
	global $CFG;
	$less = array(); 	
	                                                                                                                    
    $vars = theme_mb2nl_get_style_vars();                                                                                                          
 
                                                                                                       
    foreach ($vars as $k => $v) 
	{  
	
		switch ($k)
		{
			
			case ('ffgeneral') :									
				
				$fname = $theme->settings->ffgeneral;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? '\'' . $theme->settings->$fname . '\'' : NULL;			
				break;							
			
			case ('ffheadings') :			
			
				$fname = $theme->settings->ffheadings;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? '\'' . $theme->settings->$fname . '\'' : NULL;					
				break;				
			
			case ('ffmenu') :			
			
				$fname = $theme->settings->ffmenu;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? '\'' . $theme->settings->$fname . '\'' : NULL;				
				break;			
			
			case ('ffddmenu') :						
			
				$fname = $theme->settings->ffddmenu;
				$isv = (isset($theme->settings->$fname) && $theme->settings->$fname !='')  ? '\'' . $theme->settings->$fname  . '\'': NULL;					
				break;						
			
			default :			
			 
			$isv = (isset($theme->settings->$k) && $theme->settings->$k !='') ? $theme->settings->$k : NULL; 
				
		}		
		
		
		if (!empty($isv))
		{
			
			$issuffix = isset($v[1]) ? $v[1] : '';			
			$less[$v[0]] = $isv . $issuffix;	
		}
			
		                                                                                                      
    }   
		
	
	return $less; 
	                                                                                                                  
}







/*
 *
 * Method to set inline styles
 *
 *
 */ 
function theme_mb2nl_get_pre_less_raw ()
{
	
	global $PAGE;	
	$output = '';
	
			
	$output .= theme_mb2nl_custom_typography();
	$output .= theme_mb2nl_theme_setting($PAGE, 'customcss');
	
	
	return $output;
	
	
}







/*
 *
 * Method to typography custom styles
 *
 *
 */ 
function theme_mb2nl_custom_typography ()
{
	
	global $PAGE;	
	$output = '';
	
		
	// Custom stypography elements
	for ($i = 1; $i <= 3; $i++)
	{		
		
		$el = theme_mb2nl_theme_setting($PAGE, 'celsel' . $i);
		$ff = theme_mb2nl_theme_setting($PAGE, 'ffcel' . $i);
		$fw = theme_mb2nl_theme_setting($PAGE, 'fwcel' . $i);
		
		
		if ($el !='')
		{			
			$output .= $el;
			$output .= '{';
			$output .= $ff !== '0' ? 'font-family:' . theme_mb2nl_get_fonf_family($PAGE, $ff) . ';' : '';
			$output .= 'font-weight:' . $fw . ';';
			$output .= '}';			
		}
				
	}
	
	
	return $output;
	
	
}







/*
 *
 * Method to get font family setting
 *
 *
 */ 
function theme_mb2nl_get_fonf_family ($page, $font)
{
	
	
	$output = '\'' . theme_mb2nl_theme_setting($page, $font) . '\'';
	
		
	return $output;
	
	
}





/*
 *
 * Method to get theme settings for scss and less file
 *
 *
 */ 
function theme_mb2nl_get_style_vars() 
{                                                                                         
   
                                                                                                                        
    $vars = array(                                                                                           
       
				
		// Theme setting => scss/less variable		
		// General settings
	    'navddwidth' => array('ddwidth','px'), 
		'pagewidth' => array('pagewidth','px'),
		
		
		// Colors
		'accent1' =>  array('accent1'),
		'accent2' =>  array('accent2'),
		'textcolor' =>  array('textcolor'),
		'linkcolor' =>  array('linkcolor'),
		'linkhcolor' =>  array('linkhcolor'),
		'headingscolor' =>  array('headingscolor'),
		
		
		// Page background
		'pbgcolor' => array('pbgcolor'),
		'pbgrepeat' => array('pbgrepeat'),
		'pbgpos' => array('pbgpos'),
		'pbgattach' => array('pbgattach'),
		'pbgsize' => array('pbgsize'),
		'pbgcolor' => array('pbgcolor'),		
		
		
		// Login page background
		'loginbgcolor' => array('loginbgcolor'),
		'loginbgrepeat' => array('loginbgrepeat'),
		'loginbgpos' => array('loginbgpos'),
		'loginbgattach' => array('loginbgattach'),
		'loginbgsize' => array('loginbgsize'),
		'loginbgcolor' => array('loginbgcolor'),		
		
		
		// After slider style
		'asbgcolor' => array('asbgcolor'),
		'asbgrepeat' => array('asbgrepeat'),
		'asbgpos' => array('asbgpos'),
		'asbgattach' => array('asbgattach'),
		'asbgsize' => array('asbgsize'),
		'asbgcolor' => array('asbgcolor'),
		
		
		
		// Before content style
		'bcbgcolor' => array('bcbgcolor'),
		'bcbgrepeat' => array('bcbgrepeat'),
		'bcbgpos' => array('bcbgpos'),
		'bcbgattach' => array('bcbgattach'),
		'bcbgsize' => array('bcbgsize'),
		'bcbgcolor' => array('bcbgcolor'),	
		
		
		
		// After content style
		'acbgcolor' => array('acbgcolor'),
		'acbgrepeat' => array('acbgrepeat'),
		'acbgpos' => array('acbgpos'),
		'acbgattach' => array('acbgattach'),
		'acbgsize' => array('acbgsize'),
		'acbgcolor' => array('acbgcolor'),	
		
		
		// Fonts family
		'ffgeneral' =>  array('ffgeneral'),
		'ffheadings' =>  array('ffheadings'),
		'ffmenu' =>  array('ffmenu'),
		'ffddmenu' =>  array('ffddmenu') ,
		
		
		// Font size
		'fsgeneral'=> array('fsgeneral','px'),   
		'fsheading1'=> array('fsheading1','px'),
		'fsheading2'=> array('fsheading2','px'),
		'fsheading3'=> array('fsheading3','px'),
		'fsheading4'=> array('fsheading4','px'),
		'fsheading5'=> array('fsheading5','px'),
		'fsheading6'=> array('fsheading6','px'),
		'fsmenu'=> array('fsmenu','px'),
		'fsddmenu'=> array('fsddmenu','px'), 
		
		
		// Font weight
		'fwgeneral'=> array('fwgeneral'),   
		'fwheadings'=> array('fwheadings'),
		'fwmenu'=> array('fwmenu'),
		'fwddmenu'=> array('fwddmenu'),
		
		
		// Text transform
		'ttheadings'=> array('ttheadings'),   
		'ttmenu'=> array('ttmenu'),
		'ttddmenu'=> array('ttddmenu'),
		
		
		// Font style
		'fstheadings'=> array('fstheadings'),   
		'fstmenu'=> array('fstmenu'),
		'fstddmenu'=> array('fstddmenu'),
		                                                                                          
   	);                                                                                                                              
 
      
	return $vars; 
	                                                                                                                  
}












/*
 *
 * Method to set block class
 *
 *
 */
function theme_mb2nl_block_cls ($page, $block, $style = 'default', $custmcss = '')
{
		
	$output = '';
	
	$themeCls = theme_mb2nl_line_classes(theme_mb2nl_theme_setting($page, 'blockstyle'), $block);						
		
	$output .= $block;			
	$output .= $themeCls != '' ? ' ' . $themeCls : '';		
	$output .= ' style-' . $style;		
	$output .= $custmcss !='' ? ' ' . $custmcss : '';	
					
	return $output;	 	
		
}





/*
 *
 * Method to set block class
 *
 *
 */
function theme_mb2nl_page_cls ($page, $course = false)
{				
	
	$output = '';
	
	$isPage = $page->pagetype === 'mod-page-view';
		
	
	if ($course)
	{		
		$pageId = $isPage ? $page->course->id : 0;	
		$output .= theme_mb2nl_line_classes(theme_mb2nl_theme_setting($page, 'coursecls'), $pageId);
	}
	else
	{
		$pageId = $isPage ? $page->cm->id : 0;	
		$output .= theme_mb2nl_line_classes(theme_mb2nl_theme_setting($page, 'pagecls'), $pageId);
	}
					
		
	return $output;	 	
		
}







/*
 *
 * Method to set block class
 *
 *
 */
function theme_mb2nl_course_cls ($page)
{				
	
	$output = '';
		
		
	$output .= theme_mb2nl_line_classes(theme_mb2nl_theme_setting($page, 'coursescls'), $page->course->id);
			
		
	return $output;	 	
		
}





/*
 *
 * Method to set body class for course category theme
 *
 *
 */
function theme_mb2nl_courselist_cls($page)
{				
	
	$output = '';
	
	
	$isCourse = $page->pagetype === 'course-index';
	$isCourseCat = $page->pagetype === 'course-index-category';
	$catId = $isCourseCat ? $page->category->id : 0;
	$clsPreff = 'coursetheme-';	
	
	
	if ($catId > 0)
	{		
		$output .= $clsPreff . theme_mb2nl_line_classes(theme_mb2nl_theme_setting($page, 'coursecattheme'), $catId);
	}
	else
	{	
		$output .= $clsPreff . theme_mb2nl_theme_setting($page, 'coursetheme');
	}
					
		
	return $output;	 	
		
}




	


/*
 *
 * Method to get array of css classess
 *
 *
 */
function theme_mb2nl_line_classes ($string, $id, $pref = '', $suff = '')
{
						
		
	
	$output = '';
		
		
	$blockStylesArr =  preg_split('/\r\n|\n|\r/', $string);
					
		
		
	if ($string !='')
	{
		
		foreach ($blockStylesArr as $line)
		{				
				
			$lineArr = explode(':', $line);
			$prefArr = explode(',', $pref);
				
			if ($id == $lineArr[0])
			{
				$isPref1 = isset($prefArr[0]) ? $prefArr[0] : '';				
				$output .= $prefArr[0] . $lineArr[1] . $suff;
			}
			
			if (isset($lineArr[2]))
			{
				if ($id == $lineArr[0])		
				{	
					$isPref2 = isset($prefArr[1]) ? $prefArr[1] : '';				
					$output .= $isPref2 . $lineArr[2] . $suff;
				}
			}				
					
		}
		
	}
					
		
	return $output;	 	
		
}











/*
 *
 * Method to to get theme setting
 *
 *
 */
function theme_mb2nl_theme_setting ($page, $name, $default = '', $image = false)
{				
		
		
	if (!empty($page->theme->settings->$name))
	{
			
		if ($image === true)
		{
			$output = $page->theme->setting_file_url($name, $name);
		}
		else
		{
			$output = $page->theme->settings->$name;
		}
	}
	else
	{
		$output = $default;	
	}		
		
	return $output;	 	
		
} 






/*
 *
 * Method to check if block is visible
 *
 *
 */
function theme_mb2nl_isblock ($page, $block)
{
				
	global $PAGE, $OUTPUT;
		
	$output = false;
		
		
	if ($page->user_is_editing())
	{
		$output = true;
	}
	else
	{
		if ($page->blocks->region_has_content($block, $OUTPUT))
		{
			$output = true;	
		}
	}		
		
	return $output;	 	
		
}	







/*
 *
 * Method to get search form
 *
 *
 */
function theme_mb2nl_search_form ()
{
				
		
	global $CFG;
	
		
	$output = '';
	
		
	$output .= '<div class="theme-searchform">';
	$output .= '<form id="theme-search" action="' . $CFG->wwwroot . '/course/search.php" method="GET">';
	$output .= '<input id="theme-coursesearchbox" type="text" value="" placeholder="' . get_string('searchcourses') . '" name="search">';
	$output .= '<button type="submit"><i class="fa fa-search"></i></button>';
	$output .= '</form>';
	$output .= '</div>';
					
		
	return $output;	 	
		
}



/*
 *
 * Method to theme links
 *
 *
 */
function theme_mb2nl_theme_links ()
{
				
		
	global $CFG;
	
		
	$output = '';
	$settings = theme_mb2nl_settings_arr();
	
	
	if (is_siteadmin()) 
	{
		$output .= '<div class="theme-links">';
		$output .= '<ul>';
		
		foreach ($settings as $id=>$v)
		{
			
			$output .= '<li>';
			$output .= '<a href="' . new moodle_url($CFG->wwwroot . '/admin/settings.php?section=theme_mb2nl_settings' . $id) . '">';
			$output .= '<i class="' . $v['icon'] . '"></i> ';
			$output .= $v['name'];
			$output .= '</a>';
			$output .= '</li>';
			
		}	
		
		$docUrl = get_string('urldoc','theme_mb2nl');
		$moreUrl = get_string('urlmore','theme_mb2nl');
		
		$output .= '<li class="custom-link"><a href="' . $docUrl . '"  target="_blank" class="link-doc"><i class="fa fa-info-circle"></i> ' . get_string('documentation','theme_mb2nl') . '</a></li>';
		$output .= '<li class="custom-link"><a href="' . $moreUrl . '" target="_blank" class="link-more"><i class="fa fa-shopping-basket"></i> ' . get_string('morethemes','theme_mb2nl') . '</a></li>';	
		
		$output .= '</ul>';
		$output .= '</div>';	
	}
	
					
		
	return $output;	 	
		
}






/*
 *
 * Method to get login form
 *
 *
 */
function theme_mb2nl_login_form ()
{
				
		
	global $PAGE, $OUTPUT, $USER, $CFG;
		
	$output = '';
		
	$iswww = empty($CFG->loginhttps) ?  $CFG->wwwroot : str_replace('http://', 'https://', $CFG->wwwroot);
		
		
	$output .= '<div class="theme-loginform" style="display:none;">';
		
	
	if (!isloggedin() or isguestuser())
	{
			
		$output .= '<form id="header-form-login" method="post" action="' . $iswww . '/login/index.php?authldap_skipntlmsso=1">';
		$output .= '<div class="form-field">';
		$output .= '<label id="user"><i class="fa fa-user"></i></label>';
		$output .= '<input id="login-username" type="text" name="username" placeholder="' . get_string('username') . '" />';
		$output .= '</div>';
		$output .= '<div class="form-field">';
		$output .= '<label id="pass"><i class="fa fa-lock"></i></label>';
		$output .= '<input id="login-password" type="password" name="password" placeholder="' . get_string('password') . '" />';
		$output .= '</div>';
		//$output .= '<input type="submit" id="submit" name="submit" value="' . get_string('login') . '" />';
		$output .= '<button type="submit"><i class="fa fa-angle-right"></i></button>';
		$output .= '</form>';
		
		
		$m33 = 2017051500; // Firs Moodle 3.3 release
		if ($CFG->version >= $m33)
		{
			$authsequence = get_enabled_auth_plugins(true); // Get all auths, in sequence.
            $potentialidps = array();
            foreach ($authsequence as $authname) 
			{
                $authplugin = get_auth_plugin($authname);
                $potentialidps = array_merge($potentialidps, $authplugin->loginpage_idp_list($PAGE->url->out(false)));
            }

            if (!empty($potentialidps)) 
			{
     			$output .= '<div class="potentialidps">';
               	$output .= '<h6>' . get_string('potentialidps', 'auth') . '</h6>';
                $output .= '<div class="potentialidplist">';
                foreach ($potentialidps as $idp) 
				{
              		$output .= '<div class="potentialidp">';
                   	$output .= '<a class="btn btn-default" ';
                   	$output.= 'href="' . $idp['url']->out() . '" title="' . s($idp['name']) . '">';
                    if (!empty($idp['iconurl'])) 
					{
                        $output .= '<img src="' . s($idp['iconurl']) . '" width="24" height="24" class="m-r-1"/>';
                    }
                    $output .= s($idp['name']) . '</a></div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }
		}		
				
		$loginLink = theme_mb2nl_theme_setting($PAGE,'loginlink',1) == 2 ? $CFG->wwwroot . '/login/forgot_password.php' : $CFG->wwwroot . '/login/index.php';
		$loginText = theme_mb2nl_theme_setting($PAGE,'logintext')  !='' ? theme_mb2nl_theme_setting($PAGE,'logintext') : get_string('logininfo','theme_mb2nl');						
		$output .= '<p class="login-info"><a href="' . $loginLink . '">' . $loginText . '</a><p>';
			
	}
	else
	{		
		
		$m27 = 2014051220; // Last formal release of Moodle 2.7  
		$output .= ($CFG->version > $m27) ? $OUTPUT->user_menu() : $OUTPUT->login_info();
		$output .= $OUTPUT->user_picture($USER, array('size' => 80, 'class' => 'welcome_userpicture'));
		
	}
	
		
	$output .= '</div>';
					
		
	return $output;	
	 	
		
} 









/*
 *
 * Method to get langauge list
 *
 *
 */
function theme_mb2nl_language_list ()
{
				
		
	global $PAGE, $OUTPUT, $CFG;
		
	$moodle33 = 2017051500;	
	$output = '';
	$langs = get_string_manager()->get_list_of_translations();
	$strlang =  get_string('language');
	$currentlang = current_language();
		
		
	$listMargin = theme_mb2nl_theme_setting($PAGE, 'langmargin');
	$listMarginStyle = $listMargin !='' ? ' style="margin:' . $listMargin . ';"' : '';		
		
	
	$flagFile = $CFG->dirroot . '/theme/mb2nl/pix/flags/48x32/' . strtoupper($currentlang) . '.png';
	$noFlagFile = $CFG->dirroot . '/theme/mb2nl/pix/flags/48x32/noflag.png';
	$isFlag = file_exists($flagFile) ? true : false;
		
	if ($isFlag)
	{
		$currentFlagUrl = $CFG->version >= 	$moodle33 ? $OUTPUT->image_url('flags/48x32/' . strtoupper($currentlang),'theme') : $OUTPUT->pix_url('flags/48x32/' . strtoupper($currentlang),'theme');
	}
	else
	{
		$currentFlagUrl = $CFG->version >= 	$moodle33 ? $OUTPUT->image_url('flags/48x32/noflag','theme') : $OUTPUT->pix_url('flags/48x32/noflag','theme');
	}
	
		
	$currentFlagImg = '<span class="lang-flag" style="background-image:url(\'' . $currentFlagUrl . '\');"></span> ';	
	$lanText = isset($langs[$currentlang]) ? $langs[$currentlang] : $strlang;		
		
	
	if (count($langs)>1)
	{
			
		$output .= '<li class="lang-item dropdown">';
		$output .= '<a href="' . new moodle_url($PAGE->url, array('lang' => $currentlang)) . '" title="' . $lanText . '">';
		$output .= $currentFlagImg;
		$output .= '<span class="lang-shortname">' . $currentlang . '</span>';	
		$output .= '<span class="lang-fullname">' . $lanText . '</span>';
		$output .= '<span class="mobile-arrow"></span>';
		$output .= '</a>';
		$output .= '<ul>';
			
			
			
		foreach ($langs as $langtype => $langname) 
		{                
					
			if ($langtype !== $currentlang)
			{
				
				$flagFile2 = $CFG->dirroot . '/theme/mb2nl/pix/flags/48x32/' . strtoupper($langtype) . '.png';
				$isFlag2 = file_exists($flagFile2) ? true : false;
				
				if ($isFlag2)
				{
					$flagUrl = $CFG->version >= $moodle33 ? $OUTPUT->image_url('flags/48x32/' . strtoupper($langtype),'theme') : $OUTPUT->pix_url('flags/48x32/' . strtoupper($langtype),'theme');
				}
				else
				{
					$flagUrl = $CFG->version >= $moodle33 ? $OUTPUT->image_url('flags/48x32/noflag','theme') : $OUTPUT->pix_url('flags/48x32/noflag','theme');
				}
					
				
				$flafImg = '<span class="lang-flag" style="background-image:url(\'' . $flagUrl . '\');"></span> ';
				
				
				$output .= '<li>';
				$output .= '<a href="' . new moodle_url($PAGE->url, array('lang' => $langtype)) . '" title="' . $langname . '">';
				$output .= $flafImg;
				$output .= '<span class="lang-shortname">' . $langtype . '</span>';
				$output .= '<span class="lang-fullname">' . $langname . '</span>';
				$output .= '</a>';
				$output .= '</li>';
					
			}
					
		}		
			
			
		$output .= '</ul>';
		$output .= '</li>';	
	
	}
			
		
	return $output;	 	
		
} 





/*
 *
 * Method to get langauge list
 *
 *
 */
function theme_mb2nl_mycourses_list ()
{
	
	
	$output = '';
	
	
	$myCourses = enrol_get_my_courses(NULL, 'visible DESC, fullname ASC');
	
	$output .= '<li class="mycourses dropdown">';
	
	$output .= '<a href="#">';
	$output .= get_string('mycourses');
	$output .= '<span class="mobile-arrow"></span>';
	$output .= '</a>';
	
	$output .= '<ul>';
	
	
	if ($myCourses)
	{
		foreach ($myCourses as $course)
		{
			
			$courseUrl = new moodle_url('/course/view.php?id=' . $course->id);			
			
			$output .= '<li>';
			$output .= '<a href="' . $courseUrl . '">';
			$output .= $course->fullname;			
			$output .= '</a>';
			$output .= '</li>';
			
		}
		
	}
	else
	{
		
		$output .= '<li>';
		$output .= '<a href="' . new moodle_url('/my/index.php') . '">';
		$output .= get_string('myhome');
		$output .= '</a>';
		$output .= '</li>';
		
	}
	
	$output .= '</ul>';	
	
	$output .= '</li>';
	
	
	return $output;
	
	
}




/*
 *
 * Method to get safe url string
 *
 *
 */
function theme_mb2nl_string_url_safe($string)
{
	
	// Remove any '-' from the string since they will be used as concatenaters
	$output = str_replace('-', ' ', $string);

		
	// Trim white spaces at beginning and end of alias and make lowercase
	$output = trim(mb_strtolower($output));

		
	// Remove any duplicate whitespace, and ensure all characters are alphanumeric
	$output = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $output);

		
	// Trim dashes at beginning and end of alias
	$output = trim($output, '-');

		
	return $output;	
		
}






/*
 *
 * Method to get logo url
 *
 *
 */
function theme_mb2nl_logo_url($page, $customLogo = '', $login = true)
{
	
	global $OUTPUT, $CFG;	
	$moodle33 = 2017051500;
	
	
	// Url to default logo image
	$defaultLogo = $CFG->version >= $moodle33 ? $OUTPUT->image_url('logo-default','theme') : $OUTPUT->pix_url('logo-default','theme');
	
	
	// Check if is custom login page
	$customLoginPage = theme_mb2nl_is_login($page, true);	
	
	
	if ($login && $customLoginPage && theme_mb2nl_theme_setting($page,'loginlogo','', true) !='')
	{
		$isCustomLogo = theme_mb2nl_theme_setting($page,'loginlogo','', true);
	}
	else
	{
		$isCustomLogo = $customLogo !='' ? $customLogo : theme_mb2nl_theme_setting($page,'logo','', true);
	}
	
	
	$logoUrl = $isCustomLogo !='' ? $isCustomLogo : $defaultLogo;
	
	
	return $logoUrl;
	
	
}




/*
 *
 * Method to get page background image
 *
 *
 */
function theme_mb2nl_pagebg_image($page)
{
	
	global $OUTPUT, $CFG;	
	$moodle33 = 2017051500;
	$pageBgUrl = '';
	
	
	// Url to page background image
	$pageBgDef = $CFG->version >= $moodle33 ? $OUTPUT->image_url('pagebg/default','theme') : $OUTPUT->pix_url('pagebg/default','theme');
	$pageBg = theme_mb2nl_theme_setting($page, 'pbgimage', '', true);
	$pageBgPre = theme_mb2nl_theme_setting($page, 'pbgpre', '');
	$pageBgLogin = theme_mb2nl_theme_setting($page, 'loginbgimage', '', true);
	
	
	// Check if is custom login page
	$customLoginPage = theme_mb2nl_is_login($page, true);	
	
	
	if ($customLoginPage && $pageBgLogin !='')
	{
		$pageBgUrl = $pageBgLogin;		
	}
	elseif ($pageBg !='')
	{
		$pageBgUrl = $pageBg;	
	}
	elseif ($pageBgPre === 'default')
	{		
		$pageBgUrl = $pageBgDef;
	}
	
	
	return $pageBgUrl !='' ? ' style="background-image:url(\'' . $pageBgUrl . '\');"' : '';
	
	
}






/*
 *
 * Method to get loading screen
 *
 *
 */
function theme_mb2nl_loading_screen($page)
{
	
	global $OUTPUT, $SITE;
	
	
	$output = '';
	
	
	$isBgColor = theme_mb2nl_theme_setting($page,'lbgcolor','') !='' ? ' style="background-color:' . theme_mb2nl_theme_setting($page,'lbgcolor','') . ';"' : '';
	
	if (!is_siteadmin())
	{
		$output .= '<div class="loading-scr" data-hideafter="' . theme_mb2nl_theme_setting($page, 'loadinghide',600) . '"' . $isBgColor . '>';
		$output .= '<div class="loading-scr-inner" style="width:' . theme_mb2nl_theme_setting($page, 'logow',180) . 'px;max-width:100%;margin-left:-' . 
		round(theme_mb2nl_theme_setting($page, 'logow',180)/2) . 'px;">';
		$output .= '<img class="loading-scr-logo" src="' . theme_mb2nl_logo_url($page, theme_mb2nl_theme_setting($page,'loadinglogo','', true), false) . '" alt="' . $SITE->shortname . '">';
		$output .= '<div class="loading-scr-spinner"><img src="' . theme_mb2nl_loading_spinner() . '" alt="' . get_string('loading','theme_mb2nl') . '" style="width:' . theme_mb2nl_theme_setting($page, 'spinnerw', 35) . 'px;"></div>';
		$output .= '</div>';
		$output .= '</div>';
	}		
	
	
	return $output;
	
	
}





/*
 *
 * Method to get spinner svg image
 *
 *
 */
function theme_mb2nl_loading_spinner () 
{
		
	global $CFG;	
	$output = '';
	
	
	$spinnerDir = $CFG->dirroot . '/theme/mb2nl/pix/spinners/';	
	$spinnerCustomDir = $CFG->dirroot . '/theme/mb2nl/pix/spinners/custom';	
	
	
	$spinner = theme_mb2nl_random_image($spinnerDir, 'spinners', array('gif','svg'));
	$spinnerCustom = theme_mb2nl_random_image($spinnerCustomDir, 'spinners/custom', array('gif','svg'));	
		
		
	$output = $spinnerCustom ? $spinnerCustom : $spinner;
	
	
	return $output;
	
}






/*
 *
 * Method to get loading screen
 *
 *
 */
function theme_mb2nl_scrolltt($page)
{
	
	global $OUTPUT, $SITE;
	
	
	$output = '';
	
	$output .= '<a class="theme-scrolltt" href="#"><i class="pe-7s-angle-up" data-scrollspeed="' . theme_mb2nl_theme_setting($page, 'scrollspeed',400) . '"></i></a>';	
	
	
	return $output;
	
	
}








/*
 *
 * Method to get icon navigation
 *
 *
 */
function theme_mb2nl_iconnav($page)
{
		
	
	$output = '';
	
	
	if (theme_mb2nl_theme_setting($page, 'naviconurl1') !='')
	{
	
		
		$iconSize = theme_mb2nl_theme_setting($page, 'naviconfsize', 17);
		
		$output .= '<ul id="theme-iconnav">';
		
			
		for ($i=1; $i<=7; $i++)
		{
		
			// Get basic params
			$itemUrl = theme_mb2nl_theme_setting($page, 'naviconurl' . $i);
			$itemTarget = theme_mb2nl_theme_setting($page, 'naviconurlnw' . $i) == 1 ? ' target="_blank"' : ''; 
			$itemIcon = theme_mb2nl_theme_setting($page, 'naviconicon' . $i) !='' ? theme_mb2nl_theme_setting($page, 'naviconicon' . $i) : 'fa-link';
			$itemText = theme_mb2nl_theme_setting($page, 'navicontext' . $i);
			
			
			// Get icon prefix
			$isFa = preg_match('@fa-@',$itemIcon);
			$isGlyph = preg_match('@glyphicon-@',$itemIcon);
			$iconPref = '';
			
			if ($isFa)
			{
				$iconPref = 'fa ';	
			}
			elseif ($isGlyph)
			{
				$iconPref = 'glyphicon ';
			}		
			
			if ($itemUrl !='')
			{
				
				$isText = $itemText !='' ? '<span class="iconnavtext">' . $itemText . '</span>' : '';
				
				$output .= '<li><a href="' . $itemUrl . '"' . $itemTarget . '><span class="iconnavicon" style="font-size:' . $iconSize . 'px;"><i class="' . $iconPref . $itemIcon . '"></i></span>' . $isText . '</a></li>';
				
			}
			
				
		}	
		
		
		$output .= '</ul>';
	
	}
	
	
	return $output;
	
	
}




/*
 *
 * Method to get Gogole Analytics code
 *
 *
 */
function theme_mb2nl_ganalytics($page, $type = 1)
{
		
	$output = '';	
	$codeId = theme_mb2nl_theme_setting($page, 'ganaid');
	$codeAsync = theme_mb2nl_theme_setting($page, 'ganaasync', 0);
	
		
	if ($codeId !='')
	{	
		//Alternative async tracking snippet
		if($codeAsync == 1)
		{
			$output .= '<script>';
			$output .= 'window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;';
			$output .= 'ga(\'create\', \'' . $codeId . '\', \'auto\');';
			$output .= 'ga(\'send\', \'pageview\');';
			$output .= '</script>';
			$output .= '<script async src=\'https://www.google-analytics.com/analytics.js\'></script>';			
		}
		else
		{
			$output .= '<script>';
			$output .= '(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){';
			$output .= '(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),';
			$output .= 'm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)';
			$output .= '})(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');';
			$output .= 'ga(\'create\', \'' . $codeId . '\', \'auto\');';
			$output .= 'ga(\'send\', \'pageview\');';
			$output .= '</script>';
			$output .= '';
		}	
	}
	
	
	return $output;
		
	
}




function theme_mb2nl_favicon ($page)
{
	
	global $OUTPUT, $CFG;
	
	
	$output = '';
	$moodle33 = ($CFG->version >= 2017051500);	
	$favImg = $CFG->dirroot . '/theme/mb2nl/pix/favicon/favicon-16x16.ico';
	
	
	// Additional favicons
	$favDeskDir = $CFG->dirroot . '/theme/mb2nl/pix/favicon/desktop/';	
	$favMobDir = $CFG->dirroot . '/theme/mb2nl/pix/favicon/mobile/';		
	$deskIcons = theme_mb2nl_file_arr($favDeskDir, array('png'));
	$mobIcons = theme_mb2nl_file_arr($favMobDir, array('png'));	
	
	
	return $output;	
		
}