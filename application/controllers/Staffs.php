<?php
defined('BASEPATH') OR exit('');


class Staffs extends CI_Controller{

    public function __construct(){
        parent::__construct();

        // $this->genlib->checkLogin();

        // $this->genlib->superOnly();

        $this->load->model(['staffs']);
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function index(){
        $data['pageContent'] = $this->load->view('staffs/staffs', '', TRUE);
        $data['pageTitle'] = "Staffs";

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
     * lac_ = "Load all staffs"
     */
    public function laad_(){
        //set the sort order
        $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "first_name";
        $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

        //count the total staffs in db (excluding the currently logged in staff)
        $totalstaff = count($this->staffs->getAll());

        $this->load->library('pagination');

        $pageNumber = $this->uri->segment(3, 0);//set page number to zero if the page number is not set in the third segment of uri

        $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10;//show $limit per page
        $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit;//start from 0 if pageNumber is 0, else start from the next iteration

        //call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
        $config = $this->genlib->setPaginationConfig($totalStaffs, "staffs/laad_", $limit, ['class'=>'lnp']);

        $this->pagination->initialize($config);//initialize the library class

        //get all staffs from db
        $data['allStaffs'] = $this->staff->getAll($orderBy, $orderFormat, $start, $limit);
        $data['range'] = $totalstaffs > 0 ? ($start+1) . "-" . ($start + count($data['allStaffs'])) . " of " . $totalStaffs : "";
        $data['links'] = $this->pagination->create_links();//page links
        $data['sn'] = $start+1;

        $json['staffTable'] = $this->load->view('staffs/staffslist', $data, TRUE);//get view with populated staffs table

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
     * To add new staff
     */
    public function add(){
        $this->genlib->ajaxOnly();

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('userName', 'User name', ['required', 'trim', 'max_length[20]', 'is_unique[staffs.user_name]'], ['required'=>"required"], 'is_unique'=>'User name exists');
        $this->form_validation->set_rules('firstName', 'First name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"required"]);
        $this->form_validation->set_rules('lastName', 'Last name', ['required', 'trim', 'max_length[20]', 'strtolower', 'ucfirst'], ['required'=>"required"]);
        // $this->form_validation->set_rules('user_name', 'E-mail', ['trim', 'required', 'valid_user_name', 'is_unique[staff.user_name]', 'strtolower'],
        //         ['required'=>"required", 'is_unique'=>'E-mail exists']);
        $this->form_validation->set_rules('role', 'Role', ['required'], ['required'=>"required"]);
        $this->form_validation->set_rules('mobile', 'Phone number', ['required', 'trim', 'numeric', 'max_length[15]', 'min_length[11]'],
            ['required'=>"required");
        // $this->form_validation->set_rules('mobile2', 'Other number', ['trim', 'numeric', 'max_length[15]', 'min_length[11]']);
        $this->form_validation->set_rules('passwordOrig', 'Password', ['required', 'min_length[8]'], ['required'=>"Enter password"]);
        $this->form_validation->set_rules('passwordDup', 'Password Confirmation', ['required', 'matches[passwordOrig]'], ['required'=>"Please retype password"]);

        if($this->form_validation->run() !== FALSE){
            /**
             * insert info into db
             * function header: add($f_name, $l_name, $user_name, $password, $role, $mobile1, $mobile2)
             */
            $hashedPassword = password_hash(set_value('passwordOrig'), PASSWORD_BCRYPT);

            $inserted = $this->staffs->add(set_value('userName'),set_value('firstName'), set_value('lastName'), $hashedPassword,
                set_value('role'), set_value('mobile'));


            $json = $inserted ?
                ['status'=>1, 'msg'=>"Staff account successfully created"]
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

        $this->form_validation->set_rules('userName', 'User name', ['required', 'trim', 'max_length[20]','callback_crosscheckUserName['. $this->input->post('staffId', TRUE).']'], ['required'=>"required"]);
        $this->form_validation->set_rules('firstName', 'First name', ['required', 'trim', 'max_length[20]'], ['required'=>"required"]);
        $this->form_validation->set_rules('lastName', 'Last name', ['required', 'trim', 'max_length[20]'], ['required'=>"required"]);
        $this->form_validation->set_rules('mobile', 'Phone number', ['required', 'trim', 'numeric', 'max_length[15]',
            'min_length[11]'], ['required'=>"required"]);
        // $this->form_validation->set_rules('mobile2', 'Other number', ['trim', 'numeric', 'max_length[15]', 'min_length[11]']);
        // $this->form_validation->set_rules('user_name', 'E-mail', ['required', 'trim', 'valid_user_name', 'callback_crosscheckuser_name['. $this->input->post('staffId', TRUE).']']);
        $this->form_validation->set_rules('role', 'Role', ['required', 'trim'], ['required'=>"required"]);

        if($this->form_validation->run() !== FALSE){
            /**
             * update info in db
             * function header: update($staff_id, $first_name, $last_name, $user_name, $mobile1, $mobile2, $role)
             */

            $staff_id = $this->input->post('staffId', TRUE);

            $updated = $this->staff->update($staff_id, set_value('userName'),set_value('firstName'), set_value('lastName'),
                set_value('role'), set_value('mobile'));


            $json = $updated ?
                    ['status'=>1, 'msg'=>"staff info successfully updated"]
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


    public function suspend(){
        $this->genlib->ajaxOnly();

        $staff_id = $this->input->post('_sId');
        $new_status = $this->genmod->gettablecol('staffs', 'account_status', 'id', $staff_id) == 1 ? 0 : 1;

        $done = $this->staff->suspend($staff_id, $new_status);

        $json['status'] = $done ? 1 : 0;
        $json['_ns'] = $new_status;
        $json['_sId'] = $staff_id;

        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }



    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    public function delete(){
        $this->genlib->ajaxOnly();

        $staff_id = $this->input->post('_sId');
        $new_value = $this->genmod->gettablecol('staffs', 'deleted', 'id', $staff_id) == 1 ? 0 : 1;

        $done = $this->staff->delete($staff_id, $new_value);

        $json['status'] = $done ? 1 : 0;
        $json['_nv'] = $new_value;
        $json['_sId'] = $staff_id;

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
     * Used as a callback while updating staff info to ensure 'mobile1' field does not contain a number already used by another staff
     * @param type $mobile_number
     * @param type $staff_id
     */
    // public function crosscheckMobile($mobile_number, $staff_id){
    //     //check db to ensure number was previously used for staff with $staff_id i.e. the same staff we're updating his details
    //     $staffWithNum = $this->genmod->getTableCol('staff', 'id', 'mobile1', $mobile_number);

    //     if($staffWithNum == $staff_id){
    //         //used for same staff. All is well.
    //         return TRUE;
    //     }

    //     else{
    //         $this->form_validation->set_message('crosscheckMobile', 'This number is already attached to an staffistrator');

    //         return FALSE;
    //     }
    // }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */

    /**
     * Used as a callback while updating staff info to ensure 'user_name' field does not contain an user_name already used by another staff
     * @param type $user_name
     * @param type $staff_id
     */
    public function crosscheckUserName($user_name, $staff_id){
        //check db to ensure user_name was previously used for staff with $staff_id i.e. the same staff we're updating his details
        $staffWithUserName = $this->genmod->getTableCol('staffs', 'id', 'user_name', $user_name);

        if($staffWithUserName == $staff_id){
            //used for same staff. All is well.
            return TRUE;
        }

        else{
            $this->form_validation->set_message('crosscheckUserName', 'This User name is already attached to a staff');

            return FALSE;
        }
    }

}
