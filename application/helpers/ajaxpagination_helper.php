<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_pagination')) {

    function get_pagination($record_count, $per_page, $current_page) {
        $first_btn = true;
        $last_btn = true;
        $previous_btn = true;
        $next_btn = true;
        $no_of_paginations = ceil($record_count / $per_page);
        $page_string = '';

        //Calculating the starting and ending values for the loop
        if ($current_page >= 7) {
            $start_loop = $current_page - 3;
            if ($no_of_paginations > $current_page + 3)
                $end_loop = $current_page + 3;
            else if ($current_page <= $no_of_paginations && $current_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }

        //Pagination DIV start
        $page_string .= '<div class="pull-right">';
        $page_string .= '<ul class="pagination">';

        //For enabling first button
        if ($first_btn && $current_page > 1) {
            $page_string .= '<li p="1" class="inactive"><a href="javascript:void(0)">First</a></li>';
        } else if ($first_btn) {
            $page_string .= '<li p="1" class="active"><a href="javascript:void(0)">First</a></li>';
        }

        // For enabling previous button
        if ($previous_btn && $current_page > 1) {
            $pre = $current_page - 1;
            $page_string .= '<li p=' . "$pre" . ' class="inactive"><a href="javascript:void(0)">Previous</a></li>';
        } else if ($previous_btn) {
            $page_string .= '<li class="active"><a href="javascript:void(0)">Previous</a></li>';
        }

        for ($i = $start_loop; $i <= $end_loop; $i++) {
            if ($current_page == $i)
                $page_string .= '<li p=' . "$i" . ' style="color:#fff;background-color:#006699;" class="active"><a href="javascript:void(0)">' . "{$i}" . '</a></li>';
            else
                $page_string .= '<li p=' . "$i" . ' class="inactive"><a href="javascript:void(0)">' . "{$i}" . '</a></li>';
        }

        // To enable next button
        if ($next_btn && $current_page < $no_of_paginations) {
            $nex = $current_page + 1;
            $page_string .= '<li p=' . "$nex" . ' class="inactive"><a href="javascript:void(0)">Next</a></li>';
        } else if ($next_btn) {
            $page_string .= '<li class="active"><a href="javascript:void(0)">Next</a></li>';
        }

        // To enable end button
        if ($last_btn && $current_page < $no_of_paginations) {
            $page_string .= '<li p=' . "$no_of_paginations" . ' class="inactive"><a href="javascript:void(0)">Last</a></li>';
        } else if ($last_btn) {
            $page_string .= '<li p=' . "$no_of_paginations" . ' class="active"><a href="javascript:void(0)">Last</a></li>';
        }
        $goto = '<input type="text" class="goto" size="2" style="margin-top:-1px;margin-left:60px;"/>';
        $goto .= '<input type="button" id="go_btn" class="go_button" value="Go"/>';
        $total_string = '<span class="total" a=' . "$no_of_paginations" . '>Page <b>' . $current_page . '</b> of <b>' . $no_of_paginations . '</b></span>';
        $page_string = $page_string .'</ul></div><div class="clearfix"></div><div class="pull-right goto_page">'. $goto . $total_string . '</div>';  // Content for pagination

        return $page_string;
    }

}