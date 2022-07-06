<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('Candidate_model', 'candidate');/** Load models */
        $this->load->model('Test_model', 'test');/** Load models */
        if (!isMasterAdmin() && !isClient() && !isStaff() && !isCandidate()) { /** Redirect to admin login page if not logged in or is not admin */
            return redirect('login', 'refresh');
        }
    }

    public function begin() {
        $this->data['catId'] = $this->uri->segment(3);
        
        $testId = $this->uri->segment(4);
        if (!empty($testId)) {
            switch ($testId) {
                case 1:
                    $testName = 'test1';
                    break;
                case 2:
                    $testName = 'test2';
                    break;
                case 3:
                    $testName = 'test3';
                    break;
                case 4:
                    $testName = 'test4';
                    break;
                case 5:
                    $testName = 'test5';
                    break;
                case 6:
                    $testName = 'test6';
                    break;
                case 7:
                    $testName = 'test7';
                    break;
                case 8:
                    $testName = 'test8';
                    break;
                case 9:
                    $testName = 'test9';
                    break;
                case 10:
                    $testName = 'test10';
                    break;
                case 11:
                    $testName = 'test11';
                    break;
                case 12:
                    $testName = 'test12';
                    break;
                case 13:
                    $testName = 'test13';
                    break;
                case 14:
                    $testName = 'test14';
                    break;
                default:
                    break;
            }
            $this->layout->view('test/' . $testName, $this->data);
        }
    }

    public function processTest12() {
        $post = $this->input->post();
        if ($post) {
            $sectionType = $post['type'];
            if ($sectionType == 'final') {
                $test = $this->test->processTest12($post);
                return redirect('test/finish');
            }
        }
    }

    public function processTest4() {
        $post = $this->input->post();
        $data= implode(',',$post);
        if ($post) {
                $test = $this->test->processTest12($post);
                return redirect('test/finish');
            }
        }
    }

    public function finish() {
        $this->layout->view('test/finish');
    }

}
