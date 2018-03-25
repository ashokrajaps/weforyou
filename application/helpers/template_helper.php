<?php 
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: this file contains gobal setting for admin panel..
***************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if ( ! function_exists('get_header'))
  {
      function get_header($name=null)
      {
          $ci =& get_instance();
          return $ci->template->get_header($name);
      }
  }
 
  if ( ! function_exists('get_sidebar'))
  {
      function get_sidebar($name=null)
      {
          $ci =& get_instance();
          return $ci->template->get_sidebar($name);
      }
  }
  
  if ( ! function_exists('get_includes'))
  {
  	function get_includes($name=null)
  	{
  		$ci =& get_instance();
  		return $ci->template->get_includes($name);
  	}
  }
 
  if ( ! function_exists('get_footer'))
  {
      function get_footer($name=null)
      {
          $ci =& get_instance();
          return $ci->template->get_footer($name);
      }
  }
 
  if ( ! function_exists('get_template_part'))
  {
      function get_template_part($slug, $name=null)
      {
          $ci =& get_instance();
          return $ci->template->get_template_part($slug, $name);
      }
  }
  
  if ( ! function_exists('get_basic_editor'))
  {
      function get_basic_editor($name=array())
      {
          $ci =& get_instance();
          return $ci->template->get_basic_editor($name);
      }
  }
  
  if ( ! function_exists('get_editor'))
  {
      function get_editor($name=array())
      {
          $ci =& get_instance();
          return $ci->template->get_editor($name);
      }
  }
  
  if ( ! function_exists('get_template'))
  {
	  
      function get_template($view,$data=null)
      { 

          $ci =& get_instance();
          return $ci->template->get_template($view,$data);
      }
  }
  
  if ( ! function_exists('isAjaxRequest')) {
  	function isAjaxRequest(){
  		if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
  			redirect(base_url());
  		}	else {
  			return true;
  		}
  	}
  }  
  
 
 /*LOAD CSS */
 
  if (!function_exists('load_css')) {
  	function load_css($css) {
  		$CI = & get_instance();
  		
  	foreach ($css as $file) {
  				echo link_tag(skin_url() . "css/" . $file);
  			}
  	
  	}
  }
  
  
  /* lOAD js*/
  if (!function_exists('load_js')) {
  	function load_js($files) {
  		foreach ($files as $file) {
  			echo "<script type='text/javascript' src = \"" . skin_url() . "js/" . $file . "\" ></script>";
  		}
  	}
  }
  
  /* lOAD lib  js*/
  if (!function_exists('load_lib_js')) {
  	function load_lib_js($files) {
  		foreach ($files as $file) {
  			echo "<script type='text/javascript' src = \"" . load_lib() . "" . $file . "\" ></script>";
  		}
  	}
  }
  
  /* lOAD lib js*/
  if (!function_exists('load_lib_css')) {
  	function load_lib_css($files) {
  		foreach ($files as $file) {
  			echo link_tag(load_lib()  . $file);
  		}
  	}
  }
  
