<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
        $this->load->model('Admin_model');
        $this->load->model('Home_model');
        $this->load->model('About_me_model');
        $this->load->model('Social_media_model');
        $this->load->model('Video_model');
        $this->load->model('Packaging_design_model');
     	$this->load->model('Module_design_model');
        $this->load->model('Ecommerce_model');
        $this->load->model('Tarpaulin_model');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        $data['home'] = $this->Home_model->get_home(1);
        $data['about_me'] = $this->About_me_model->get(1);
        $data['social_media'] = $this->Social_media_model->get_all();
        $data['video'] = $this->Video_model->get_all();
        $data['packaging_design'] = $this->Packaging_design_model->get_all();
        $data['module_design'] = $this->Module_design_model->get_all();
        $data['ecommerce'] = $this->Ecommerce_model->get_all();
        $data['tarpaulin'] = $this->Tarpaulin_model->get_all();

		$this->load->view('index', $data);
	}
}
