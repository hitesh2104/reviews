<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @author	Amit Sahu & Team- amitsahu17feb@gmail.com
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('isSystemAdmin')) {

    function isSystemAdmin ()
    {
        $CI = & get_instance();/** get instance, access the CI superobject */
        $userData = $CI->session->userdata('logged_in');
        if (!empty($userData) && $userData['role'] == 'system-admin') {
            return true;
        }
        return false;
    }

}

if (!function_exists('isMasterAdmin')) {

    function isMasterAdmin ()
    {
        $CI = & get_instance();/** get instance, access the CI superobject */
        $userData = $CI->session->userdata('logged_in');
        if (!empty($userData) && $userData['role'] == 'master-admin') {
            return true;
        }
        return false;
    }

}

if (!function_exists('isClient')) {

    function isClient ()
    {
        $CI = & get_instance();/** get instance, access the CI superobject */
        $userData = $CI->session->userdata('logged_in');
        if (!empty($userData) && $userData['role'] == 'client') {
            return true;
        }
        return false;
    }

}

if (!function_exists('isStaff')) {

    function isStaff ()
    {
        $CI = & get_instance();/** get instance, access the CI superobject */
        $userData = $CI->session->userdata('logged_in');
        if (!empty($userData) && $userData['role'] == 'staff') {
            return true;
        }
        return false;
    }

}

if (!function_exists('isCandidate')) {

    function isCandidate ()
    {
        $CI = & get_instance();/** get instance, access the CI superobject */
        $userData = $CI->session->userdata('logged_in');
        if (!empty($userData) && $userData['role'] == 'candidate') {
            return true;
        }
        return false;
    }

}
