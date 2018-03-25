<?php
/**************************
Project Name	: Rx Leaf
Created on		: Jan 09, 2017
Last Modified 	: Jan 09, 2017
Description		: this file contains gobal setting for admin panel..
***************************/

 if (!defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('relative_time'))
{
    function relative_time($datetime)
    {
        $CI =& get_instance();
        $CI->lang->load('date');

        if(!is_numeric($datetime))
        {
            $val = explode(" ",$datetime);
           $date = explode("-",$val[0]);
           $time = explode(":",$val[1]);
           $datetime = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
        }

        $difference = time() - $datetime;
        $periods = array("second", "minute", "hour", "day", "week", "month", "year");
        $lengths = array("60","60","24","7","4.3","12","365"); 
        
        if ($difference > 0) 
        { 
            $ending = $CI->lang->line('date_ago');
        } 
        else 
        { 
            $difference = -$difference;
            $ending = $CI->lang->line('date_to_go');
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        } 
        $difference = round($difference);

        if($difference != 1) 
        { 
            $period = strtolower($CI->lang->line('date_'.$periods[$j].'s'));
        } else {
            $period = strtolower($CI->lang->line('date_'.$periods[$j]));
        }
		if($difference <=59 && $period=="seconds"){
			return "Just now";
		}
		else if($difference <=5 && $period=="minutes")
		{
						return "few ".$period." ".$ending;
		}
		else 
		{
            return "$difference $period $ending";
        }
    }


} 
