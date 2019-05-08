<?php
defined('BASEPATH') OR exit('');

class Customer extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */


    /**
     * [add description]
     * @param [type] $f_name [description]
     * @param [type] $l_name [description]
     * @param [type] $mobile [description]
     * @param [type] $email  [description]
     * @param [type] $rec_by [description]
     */
    public function add($f_name, $l_name, $mobile, $email, $rec_by){
        $data = ['first_name'=>$f_name, 'last_name'=>$l_name, 'mobile'=>$mobile, 'email'=>$email,
            'rec_by'=>$rec_by];

        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3"
                ?
        $this->db->set('joined_since', "datetime('now')", FALSE)
                :
        $this->db->set('joined_since', "NOW()", FALSE);

        $this->db->insert('customers', $data);

        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }

        else{
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


    // /**
    //  * Get some details about customers (stored in session)
    //  * @param type $email
    //  * @return boolean
    //  */
    // public function get_customer_info($email){
    //     $this->db->select('id, first_name, last_name, role');
    //     $this->db->where('email', $email);

    //     $run_q = $this->db->get('customers');

    //     if($run_q->num_rows() > 0){
    //         return $run_q->result();
    //     }

    //     else{
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
     * [getAll description]
     * @param  string  $orderBy     [description]
     * @param  string  $orderFormat [description]
     * @param  integer $start       [description]
     * @param  string  $limit       [description]
     * @return [type]               [description]
     */
    public function getAll($orderBy = "first_name", $orderFormat = "ASC", $start = 0, $limit = ""){
        $this->db->select('id, first_name, last_name, mobile, email, joined_since, rec_by');
        $this->db->limit($limit, $start);
        $this->db->order_by($orderBy, $orderFormat);

        $run_q = $this->db->get('customers');

        if($run_q->num_rows() > 0){
            return $run_q->result();
        }

        else{
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

   /**
    * [delete description]
    * @param  [type] $customer_id [description]
    * @param  [type] $new_value   [description]
    * @return [type]              [description]
    */
    public function delete($customer_id, $new_value){
        $this->db->where('id', $customer_id);
        $this->db->update('customers', ['deleted'=>$new_value]);

        if($this->db->affected_rows()){
            return TRUE;
        }

        else{
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


    /**
     * [customerSearch description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function customerSearch($value){
        $q = "SELECT * FROM customers WHERE
                (
                MATCH(first_name) AGAINST(?)
                || MATCH(last_name) AGAINST(?)
                || MATCH(first_name, last_name) AGAINST(?)
                || MATCH(mobile) AGAINST(?)
                || MATCH(rec_by) AGAINST(?)
                || first_name LIKE '%".$this->db->escape_like_str($value)."%'
                || last_name LIKE '%".$this->db->escape_like_str($value)."%'
                || mobile LIKE '%".$this->db->escape_like_str($value)."%'
                || rec_by LIKE '%".$this->db->escape_like_str($value)."%'
                )";

        $run_q = $this->db->query($q, [$value, $value, $value, $value, $value]);

        if($run_q->num_rows() > 0){
            return $run_q->result();
        }

        else{
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


    /**
     * [update description]
     * @param  [type] $customer_id [description]
     * @param  [type] $f_name      [description]
     * @param  [type] $l_name      [description]
     * @param  [type] $mobile      [description]
     * @param  [type] $email       [description]
     * @param  [type] $rec_by      [description]
     * @return [type]              [description]
     */
    public function update($customer_id, $f_name, $l_name, $mobile, $email, $rec_by){
        $data = ['first_name'=>$f_name, 'last_name'=>$l_name, 'mobile'=>$mobile, 'email'=>$email,
                    'rec_by'=>$rec_by];

        $this->db->where('id', $customer_id);

        $this->db->update('customers', $data);

        return TRUE;
    }


    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */



}