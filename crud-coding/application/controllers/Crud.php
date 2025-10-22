<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Crud extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        echo "Welcome";
        exit;
    }

    public function create_product()
    {
        $this->load->view('create_product');
    }

    public function store_product()
    {
        // Ensure model is loaded
        if ( ! isset($this->CrudModel))
        {
            $this->load->model('CrudModel');
        }

        // Only process on POST
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $name  = $this->input->post('name');
            $email = $this->input->post('email');

            $result = $this->CrudModel->store_product($name, $email);
            if ($result === TRUE)
            {
                $this->session->set_flashdata('inserted', 'Data has been inserted');
                redirect('crud/view_product');
            }
            else
            {
                $this->session->set_flashdata('error', 'Invalid request');
                echo "Data could not be stored";
            }
        }
        else
        {
            show_404();
        }
    }

    public function view_product()
    {
        if ( ! isset($this->CrudModel))
        {
            $this->load->model('CrudModel');
        }

        $data['records'] = $this->CrudModel->getAll();
        $this->load->view('view_product', $data);
    }

    public function edit_product($id)
    {
        if ( ! isset($this->CrudModel))
        {
            $this->load->model('CrudModel');
        }
        $data['record'] = $this->CrudModel->getDataById($id);
        if (empty($data['record']))
        {
            show_404();
            return;
        }

        // load the update view
        $this->load->view('update_product', $data);
    }

    public function update_product($id = NULL)
    {
        if ( ! isset($this->CrudModel))
        {
            $this->load->model('CrudModel');
        }
        // Accept ID from URL segment or hidden form field
        if ($id === NULL)
        {
            $id = $this->input->post('id');
        }

        // Only allow POST
        if ($this->input->server('REQUEST_METHOD') !== 'POST')
        {
            show_404();
            return;
        }

        $name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));

        // Basic validation
        if ($id === NULL || $id === '' || $name === '' || $email === '')
        {
            $this->session->set_flashdata('error', 'Please provide Name and Email');
            redirect('crud/edit_product/'.$id);
            return;
        }

        $data = array(
            'name' => $name,
            'email' => $email
        );


    

        $updated = $this->CrudModel->updateData($id, $data);
        if ($updated)
        {
            $this->session->set_flashdata('inserted', 'Product updated successfully');
        }
        else
        {
            $this->session->set_flashdata('error', 'Failed to update the product');
        }

        redirect('crud/view_product');
    }

    public function delete_product($id)
    {
        if ( ! isset($this->CrudModel))
        {
            $this->load->model('CrudModel');
        }
        $this->CrudModel->deleteData($id);
        redirect('Crud/view_product');
    }
}

?>