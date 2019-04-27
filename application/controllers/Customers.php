<?php
defined('BASEPATH') OR exit('');


class Customers extends CI_Controller{

    public function __construct(){
        parent::__construct();

        // $this->genlib->checkLogin();

        // $this->genlib->superOnly();

        $this->load->model(['customers']);
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function index(){
        $data['pageContent'] = $this->load->view('customers/customers', '', TRUE);
        $data['pageTitle'] = "Customers";

        $this->load->view('main', $data);
    }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    /**
     * lac_ = "Load all customers"
     */
    public function laad_(){
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "first_name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        //count the total customers in db (excluding the currently logged in customer)
        $totalstaff = count($this->customers->getAll());

        $this->load->library('pagination');

        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri

        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalCustomers, "customers/laad_", $limit, ['class'=>'lnp']);

        $this->pagination->initialize($config);//initialize the library class

        //get all customers from db
        $data['allCustomers'] = $this->customers->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalCustomers > 0 ? ($start+1) . "-" . ($start + count($data['allCustomers'])) . " of " . $totalCustomers : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;

        $json['staffTable'] = $this->load->view('customers/customerslist', $data, TRUE);//get view with populated customers table

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    /**
     * To add new customer
     */
    public function add(){
        $this->genlib->ajaxOnly();

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('firstName', 'First name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"required"]);
        $this->form_validation->set_rules('lastName', 'Last name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"required"]);

        $this->form_validation->set_rules('email', 'E-mail', ['required', 'trim', 'valid_email', 'is_unique[customers.email]', 'strtolower',
            'callback_validateContacts'], ['required'=>"required", 'is_unique'=>'E-mail exists']);

        $this->form_validation->set_rules('mobile', 'Phone number', ['required', 'trim', 'numeric', 'max_length[15]', 'min_length[11]',
            'is_unique[customers.mobile]', 'callback_validateContacts'],
            ['required'=>"required", 'is_unique'=>"This number is already attached to a customer"]);

        $this->form_validation->set_rules('rec_by', 'Recommendded by', ['trim', 'max_length[20]', 'strtolower', 'ucfirst']);


        if($this->form_validation->run() !== FALSE){
            /**
             * insert info into db
             * function header: add($f_name, $l_name, $user_name, $password, $role, $mobile1, $mobile2)
             */
            // $hashedPassword = password_hash(set_value('passwordOrig'), PASSWORD_BCRYPT);

            $inserted = $this->customers->add(,set_value('firstName'), set_value('lastName'),set_value('email'),
                set_value('mobile'), set_value('rec_by') );


            $json = $inserted ?
                ['status'=>1, 'msg'=>"Customer successfully added"]
                :
                ['status'=>0, 'msg'=>"Oops! Unexpected server error!"];
        }

        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors

            $json['msg'] = "One or more required fields are empty or not correctly filled";
            $json['status'] = 0;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    /**
     *
     */
    public function update(){
        $this->genlib->ajaxOnly();

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules('firstName', 'First name', ['required', 'trim', 'max_length[20]'], ['required'=>"required"]);
        $this->form_validation->set_rules('lastName', 'Last name', ['required', 'trim', 'max_length[20]'], ['required'=>"required"]);
        $this->form_validation->set_rules('email', 'E-mail', ['required', 'trim', 'valid_email']);
        $this->form_validation->set_rules('mobile', 'Phone number', ['required', 'trim', 'numeric', 'max_length[15]',
            'min_length[11]'], ['required'=>"required"]);

        if($this->form_validation->run() !== FALSE){
            /**
             * update info in db
             * function header: update($customer_id, $first_name, $last_name, $user_name, $mobile1, $mobile2, $role)
             */

            $customer_id = $this->input->post('customerId', TRUE);

            $updated = $this->customer->update($customer_id, set_value('firstName'), set_value('lastName'),
                set_value('email'), set_value('mobile'));


            $json = $updated ?
                    ['status'=>1, 'msg'=>"Customer info successfully updated"]
                    :
                    ['status'=>0, 'msg'=>"Oops! Unexpected server error!"];
        }

        else{
            //return all error messages
            $json = $this->form_validation->error_array();//get an array of all errors

            $json['msg'] = "One or more required fields are empty or not correctly filled";
            $json['status'] = 0;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    // public function suspend(){
    //     $this->genlib->ajaxOnly();

    //     $customer_id = $this->input->post('_cId');
    //     $new_status = $this->genmod->gettablecol('customers', 'account_status', 'id', $customer_id) == 1 ? 0 : 1;

    //     $done = $this->customer->suspend($customer_id, $new_status);

    //     $json['status'] = $done ? 1 : 0;
    //     $json['_ns'] = $new_status;
    //     $json['_cId'] = $customer_id;

    //     $this->output->set_content_type('application/json')->set_output(json_encode($json));
    // }



    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    // public function delete(){
    //     $this->genlib->ajaxOnly();

    //     $customer_id = $this->input->post('_cId');
    //     $new_value = $this->genmod->gettablecol('customers', 'deleted', 'id', $customer_id) == 1 ? 0 : 1;

    //     $done = $this->customer->delete($customer_id, $new_value);

    //     $json['status'] = $done ? 1 : 0;
    //     $json['_nv'] = $new_value;
    //     $json['_cId'] = $customer_id;

    //     $this->output->set_content_type('application/json')->set_output(json_encode($json));
    // }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    public function validateContacts(){

        if($this->input->post('mobile') || $this->input->post('email') ){
            return TRUE;
        }

        else{
            $this->form_validation->set_message('validateContacts', 'Please enter either contact number or email');

            return FALSE;
        }
    }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    // public function crosscheckContacts($mobile_number, $customer_id){
    //     //check db to ensure number was previously used for customer with $customer_id i.e. the same customer we're updating his details
    //     $staffWithNum = $this->genmod->getTableCol('customer', 'id', 'mobile1', $mobile_number);

    //     if($staffWithNum == $customer_id){
    //         return TRUE;
    //     }

    //     else{
    //         $this->form_validation->set_message('crosscheckContacts', 'Please enter either contact number or email');

    //         return FALSE;
    //     }
    // }
}
