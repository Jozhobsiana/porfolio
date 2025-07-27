<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load form helper and session library if needed
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
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

    private function redirect_if_logged_in()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
    }
    public function login()
    {
        $this->redirect_if_logged_in();
        $this->load->view('admin_login');
    }

    public function register()
    {
        $this->redirect_if_logged_in();
        $this->load->view('admin_register');
    }

    public function create_account()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email    = $this->input->post('email');

        if ($this->Admin_model->user_exists($username)) {
            $this->session->set_flashdata('error', 'Username already exists');
            redirect('admin/register');
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'password' => $hashed_password,
            'email'    => $email,
            'role'     => 'admin'
        ];

        if ($this->Admin_model->create_user($data)) {
            $this->session->set_flashdata('success', 'Account created. Please login.');
            redirect('admin/login');
        } else {
            $this->session->set_flashdata('error', 'Failed to create account');
            redirect('admin/register');
        }
    }


    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Admin_model->authenticate($username, $password);

        if ($user) {
            if ($user->role === 'admin') {
                $this->session->set_userdata('admin_logged_in', true);
                $this->session->set_userdata('admin_id', $user->id);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Access denied: Not an admin.');
                redirect('admin/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('admin/login');
        }
    }

    public function dashboard()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        // ✅ Load the actual dashboard view here
        $this->load->view('admin_dashboard');
    }


    public function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        redirect('admin/login');
    }


    //Home Section
    public function home_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['homes'] = $this->Home_model->get_all_home();
        $this->load->view('home/index', $data);
    }
    public function home_form($id)
    {
        $home = $this->Home_model->get_home($id);
        if (!$home) show_404();
        $data['home'] = $home;
        $this->load->view('home/form', $data);

    }

    public function update_home($id)
    {
        $home = $this->Home_model->get_home($id);
        if (!$home) show_404();

        $data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        ];

        if (!empty($_FILES['background']['name'])) {
            $upload_path = './assets/uploads/';

            
            // Create folder if it doesn't exist
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true); // recursively create folder
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('background')) {
                $upload_data = $this->upload->data();
                $data['background'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect('admin/home_form/' . $id);
            }
        }
        $this->Home_model->update_home($id, $data);
        redirect('admin/home_index');
    }

    //ABOUT ME
    public function about_me_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['about_me'] = $this->About_me_model->get_all();
        $this->load->view('about_me/index', $data);
    }

    public function about_me_form($id)
    {
        $about_me = $this->About_me_model->get($id);
        if (!$about_me) show_404();
        $data['about_me'] = $about_me;
        $this->load->view('about_me/form', $data);

    }

    public function update_about_me($id)
    {
        $data = [
            'content' => $this->input->post('content'),
        ];

        // Handle file upload
        if (!empty($_FILES['background']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('background')) {
                $upload_data = $this->upload->data();
                $data['background'] = $upload_data['file_name'];

                // Optional: delete old image
                $existing = $this->About_me_model->get($id);
                if (!empty($existing['background']) && file_exists('./assets/uploads/' . $existing['background'])) {
                    unlink('./assets/uploads/' . $existing['background']);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/about_me_index');
            }
        }

        $this->About_me_model->update($id, $data);
        $this->session->set_flashdata('success', 'About Me section updated successfully.');
        redirect('admin/about_me_index');
    }

    //SOCIAL MEDIA
    public function social_media_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['social_media'] = $this->Social_media_model->get_all();
        $this->load->view('social_media/index', $data);
    }

    public function social_media_form($id = null)
    {
        $data['social_media'] = null;

        if ($id !== null) {
            $social_media = $this->Social_media_model->get($id);
            if (!$social_media) {
                show_404();
            }
            $data['social_media'] = $social_media;
        }

        $this->load->view('social_media/form', $data);
    }

    public function save_social_media($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|mp4|webm|ogg|jiff'; // Accept videos and images
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Social_media_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/social_media_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Social_media_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Social_media_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/social_media_index');
    }


    public function delete_social_media($id)
    {
        $entry = $this->Social_media_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Social_media_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/social_media_index');
    }

    //VIDEO
    public function video_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['video'] = $this->Video_model->get_all();
        $this->load->view('video/index', $data);
    }

    public function video_form($id = null)
    {
        $data['video'] = null;

        if ($id !== null) {
            $video = $this->Video_model->get($id);
            if (!$video) {
                show_404();
            }
            $data['video'] = $video;
        }

        $this->load->view('video/form', $data);
    }

    public function save_video($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'mp4|webm|ogg|avi|mov|flv|wmv|mkv|mpeg|mpg|3gp';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Video_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/video_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Video_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Video_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/video_index');
    }


    public function delete_video($id)
    {
        $entry = $this->Video_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Video_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/video_index');
    }


    //PACKAGING DESIGN
    public function packaging_design_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['packaging_design'] = $this->Packaging_design_model->get_all();
        $this->load->view('packaging_design/index', $data);
    }

    public function packaging_design_form($id = null)
    {
        $data['packaging_design'] = null;

        if ($id !== null) {
            $packaging_design = $this->Packaging_design_model->get($id);
            if (!$packaging_design) {
                show_404();
            }
            $data['packaging_design'] = $packaging_design;
        }

        $this->load->view('packaging_design/form', $data);
    }

    public function save_packaging_design($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Packaging_design_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/packaging_design_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Packaging_design_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Packaging_design_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/packaging_design_index');
    }


    public function delete_packaging_design($id)
    {
        $entry = $this->Packaging_design_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Packaging_design_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/packaging_design_index');
    }

    //MODULE DESIGN
    public function module_design_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['module_design'] = $this->Module_design_model->get_all();
        $this->load->view('module_design/index', $data);
    }

    public function module_design_form($id = null)
    {
        $data['module_design'] = null;

        if ($id !== null) {
            $module_design = $this->Module_design_model->get($id);
            if (!$module_design) {
                show_404();
            }
            $data['module_design'] = $module_design;
        }

        $this->load->view('module_design/form', $data);
    }

    public function save_module_design($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Module_design_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/module_design_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Module_design_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Module_design_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/module_design_index');
    }


    public function delete_module_design($id)
    {
        $entry = $this->Module_design_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Module_design_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/module_design_index');
    }

    //Ecommerce
    public function ecommerce_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['ecommerce'] = $this->Ecommerce_model->get_all();
        $this->load->view('ecommerce/index', $data);
    }

    public function ecommerce_form($id = null)
    {
        $data['ecommerce'] = null;

        if ($id !== null) {
            $ecommerce = $this->Ecommerce_model->get($id);
            if (!$ecommerce) {
                show_404();
            }
            $data['ecommerce'] = $ecommerce;
        }

        $this->load->view('ecommerce/form', $data);
    }

    public function save_ecommerce($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Ecommerce_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/ecommerce_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Ecommerce_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Ecommerce_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/ecommerce_index');
    }


    public function delete_ecommerce($id)
    {
        $entry = $this->Ecommerce_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Ecommerce_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/ecommerce_index');
    }

    //Tarpaulin
    public function tarpaulin_index()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }

        $data['tarpaulin'] = $this->Tarpaulin_model->get_all();
        $this->load->view('tarpaulin/index', $data);
    }

    public function tarpaulin_form($id = null)
    {
        $data['tarpaulin'] = null;

        if ($id !== null) {
            $tarpaulin = $this->Tarpaulin_model->get($id);
            if (!$tarpaulin) {
                show_404();
            }
            $data['tarpaulin'] = $tarpaulin;
        }

        $this->load->view('tarpaulin/form', $data);
    }

    public function save_tarpaulin($id = null)
    {
        $data = []; // Initialize the data array
        // File upload configuration
        if (!empty($_FILES['media']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = '*';
            $config['encrypt_name']  = TRUE;
            $config['max_width']  = 0; 
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('media')) {

                $upload_data = $this->upload->data();
                $data['filename'] = $upload_data['file_name'];

                if ($id) {
                    $existing = $this->Tarpaulin_model->get($id);
                    if (!empty($existing['filename']) && file_exists('./assets/uploads/' . $existing['filename'])) {
                        unlink('./assets/uploads/' . $existing['filename']);
                    }
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/tarpaulin_index');
            }
        }

        // Insert or update logic
        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->Tarpaulin_model->update($id, $data);
            $this->session->set_flashdata('success', 'Social media post updated successfully.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Tarpaulin_model->insert($data);
            $this->session->set_flashdata('success', 'Social media post created successfully.');
        }

        redirect('admin/tarpaulin_index');
    }


    public function delete_tarpaulin($id)
    {
        $entry = $this->Tarpaulin_model->get($id);
        if ($entry) {
            // Optional: delete the background file
            if (!empty($entry['background']) && file_exists('./assets/uploads/' . $entry['background'])) {
                unlink('./assets/uploads/' . $entry['background']);
            }

            $data['deleted_at'] =date('Y-m-d H:i:s');

            $this->Tarpaulin_model->update($id,$data);
            $this->session->set_flashdata('success', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Entry not found.');
        }

        redirect('admin/tarpaulin_index');
    }
}
