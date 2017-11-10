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


defined('MOODLE_INTERNAL') || die();


class theme_mb2nl_core_renderer extends core_renderer 
{

	
	protected $language = null;
   
   
    	
	
	
	/**
     * The standard tags that should be included in the <head> tag
     * including a meta description for the front page
     *
     * @return string HTML fragment.
     */
    public function standard_head_html() {
        global $SITE, $PAGE;

        $output = parent::standard_head_html();

        // Setup help icon overlays.
        $this->page->requires->yui_module('moodle-core-popuphelp', 'M.core.init_popuphelp');
        $this->page->requires->strings_for_js(array(
            'morehelp',
            'loadinghelp',
        ), 'moodle');

        if ($PAGE->pagelayout == 'frontpage') {
            $summary = s(strip_tags(format_text($SITE->summary, FORMAT_HTML)));
            if (!empty($summary)) {
                $output .= "<meta name=\"description\" content=\"$summary\" />\n";
            }
        }

        return $output;
    }
	
	
	
	
	
	
    
	/**
     *
     * Method to load theme element form 'layout/elements' folder
     *     
     */
    public function theme_part($name, $vars = array()) 
	{       
	    
		global $CFG, $SITE, $USER;
		
			
		$OUTPUT = $this;
        $PAGE = $this->page;
        $COURSE = $this->page->course;
        $element = $name . '.php';
        $candidate = $this->page->theme->dir . '/layout/parts/' . $element;
        
		
		if (!is_readable($candidate)) 
		{
            
			debugging("Could not include element $name.");
            return '';
			
        }
		

        extract($vars);
        ob_start();		
        include($candidate);		
        $output = ob_get_clean();		
        return $output;
				
    }
	
	
	
	

   

    /**
     *
     * Method to get custom menu
     *     
     */
    public function custom_menu($custommenuitems = '') 
	{
        
		global $CFG;

        
		if (empty($custommenuitems) && !empty($CFG->custommenuitems)) 
		{
            $custommenuitems = $CFG->custommenuitems;
        }
		
		
        $custommenu = new custom_menu($custommenuitems, current_language());
		
		
        return $this->render_custom_menu($custommenu);
		
    }
	
	
	
	



    /**
     *
     * Method to render custom menu
     *     
     */
    protected function render_custom_menu(custom_menu $menu) 
	{
        
		
		global $CFG, $PAGE, $OUTPUT, $SITE;
	
		$content = ''; 
		$myCourses = (isloggedin() && !isguestuser() && theme_mb2nl_theme_setting($PAGE, 'mycinmenu', 0));
		
		
		$content .= '<div class="menu-bar">';
		$content .= '<a class="mobile-home" href="' . new moodle_url($CFG->wwwroot) . '" title="' . theme_mb2nl_theme_setting($PAGE, 'logotitle','New Learning') . '"><i class="fa fa-home"></i></a>';
		$content .= '<a class="show-menu" href="#"><i class="fa fa-bars"></i></a>';
		$content .= '</div>';
		
	   
	    $content .= '<ul class="main-menu theme-ddmenu"' . theme_mb2nl_menu_data($PAGE) . '>';
		
		
		$content .= '<li class="home-item"><a href="' . new moodle_url($CFG->wwwroot) . '" title="' . theme_mb2nl_theme_setting($PAGE, 'logotitle','New Learning') . '"><i class="fa fa-home"></i></a></li>';
		 
		
        foreach ($menu->get_children() as $item) 
		{           
		    $content .= $this->render_custom_menu_item($item, 1);			
        }
		
		
		$content .= $myCourses ? theme_mb2nl_mycourses_list() : '';		
		$content .= theme_mb2nl_language_list();
		

        return $content.'</ul>';
		
		
    }
	
	
	
	
	
	
	
	

    /**
     *
     * Method to render custom menu item
     *     
     */
    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0 ) {
       
	   global $PAGE;
	   
	   
	    static $submenucount = 0;
        $content = '';
		$class = '';		
		$themelinkcls = theme_mb2nl_theme_setting($PAGE, 'navcls');
		$linkcls = '';//$themelinkcls !='' ? theme_mb2nl_line_classes($themelinkcls, $menunode->get_text(), 'mitem-') : '';
		
		
	   
	    if ($menunode->has_children()) 
		{

			$class .= 'dropdown';
            
			
			$content .= html_writer::start_tag('li', array('class' => $class));
           
		   
		    // If the child has menus render it as a sub menu.
            $submenucount++;
			
            if ($menunode->get_url() !== null) 
			{
                
				$url = $menunode->get_url();
				
            } 
			else 
			{
               
			    $url = '#cm_submenu_' . $submenucount;
				
            }
			
			
         
			$content .= html_writer::start_tag('a', array('href'=>$url, 'class'=>$linkcls, 'data-toggle'=>'', 'title'=>$menunode->get_title()));
						
            
            $content .= $menunode->get_text();
			
		  	
			$content .= '<span class="mobile-arrow"></span>';
			
			
            $content .= '</a>';
			
			
            $content .= '<ul class="dropdown-list">';
			
			
            foreach ($menunode->get_children() as $menunode) 
			{
				
                $content .= $this->render_custom_menu_item($menunode, 0);
				
            }
			
            $content .= '</ul>';
			
        } 
		else 
		{
           
		    // The node doesn't have children so produce a final menuitem.
            // Also, if the node's text matches '####', add a class so we can treat it as a divider.
            if (preg_match("/^#+$/", $menunode->get_text())) 
			{
				
                // This is a divider.
                $content = '<li class="divider">&nbsp;</li>';
				
            } 
			else 
			{
				
                $content .= html_writer::start_tag('li', array('class' => $class));
				
                if ($menunode->get_url() !== null) 
				{
					
                    $url = $menunode->get_url();
					
                }
				else 
				{
                    
					$url = '#';
					
                }
				
               
			    $content .= html_writer::link($url, $menunode->get_text(), array('title' => $menunode->get_title(), 'class'=>$linkcls));				
				
				
                $content .= html_writer::end_tag('li');
				
            }
			
        }
		
		
        return $content;
    }
	
	
	
	
	
	
	/**
     *
     * Method to get user menu
     *     
     */
    //public function user_menu($user = NULL, $withlinks = NULL) 
//	{
//        global $CFG;        
//        return '';
//    }
	
	
	
	/**
     *
     * Method to render user menu
     *     
     */
   // protected function render_user_menu(user_menu $menu) 
//	{
//		
//		return '';
//		
//	}
	
	
	
	
	
	/**
     *
     * Method to render tabtree
     *     
     */
    protected function render_tabtree(tabtree $tabtree) {
		
		
		$output = '';	
		
	    if (empty($tabtree->subtree)) 
		{
            return '';
        }
		
        $firstrow = $secondrow = '';
		
        foreach ($tabtree->subtree as $tab) 
		{
           
		    $firstrow .= $this->render($tab);
            
			if (($tab->selected || $tab->activated) && !empty($tab->subtree) && $tab->subtree !== array()) 
			{
                $secondrow = $this->tabtree($tab->subtree);				
            }
			
        }
		
        $output .= html_writer::tag('ul', $firstrow, array('class' => 'nav nav-tabs moodle-tabs'));
		
		$output .=  $secondrow;		
		
		return $output;
		
    }
	
	
	
	
	
	/**
     *
     * Method to render tab tree object
     *     
     */
    protected function render_tabobject(tabobject $tab) {
       
	   if (($tab->selected and (!$tab->linkedwhenselected)) or $tab->activated) 
	   {
           
		    return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'active'));
			
        } 
		else if ($tab->inactive) 
		{
            
			return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'disabled'));
			
        } 
		else 
		{
            
			if (!($tab->link instanceof moodle_url)) 
			{
                
				// backward compartibility when link was passed as quoted string
                $link = "<a href=\"$tab->link\" title=\"$tab->title\">$tab->text</a>";
				
            } 
			else 
			{
               
			    $link = html_writer::link($tab->link, $tab->text, array('title' => $tab->title));
				
            }
			
            $params = $tab->selected ? array('class' => 'active') : null;
			
            return html_writer::tag('li', $link, $params);
			
        }
		
    }
	
	
	
	
	
	
	

}










