<?php

defined('BASEPATH') OR exit('');

/**
 * Description of Appointments
 *
 *
 */
class Appointments extends CI_Controller{

    public function __construct() {
        parent::__construct();
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Get all appointments
     * @param type $orderBy
     * @param type $orderFormat
     * @param type $start
     * @param type $limit
     * @return boolean
     */
    public function getAll($orderBy, $orderFormat, $start, $limit) {
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT appointments.id, appointments.date_created, appointments.customer_name, appointments.staff_id,
                appointments.created_at, appointments.start_time, appointments.end_time, appointments.price_final,
                admin.first_name || ' ' || admin.last_name AS 'staffName', SUM(appointments.quantity) AS 'quantity',
                appointments.cust_name, appointments.customer_contact
                FROM appointments
                LEFT OUTER JOIN admin ON appointments.staff_id = admin.id
                GROUP Bs.id
                ORDER BY {$orderBy} {$orderFormat}
                LIMIT {$limit} OFFSET {$start}";

            $run_q = $this->db->query($q);
        }
        else {
            $this->db->select('appointments.id, appointments.date_created, appointments.customer_name, appointments.staff_id,
                appointments.created_at, appointments.start_time, appointments.end_time, appointments.price_final,
                CONCAT_WS(" ", admin.first_name, admin.last_name) as "staffName",
                appointments.cust_name, appointments.customer_contact, appointments.cust_email');

            $this->db->select_sum('appointments.quantity');

            $this->db->join('admin', 'appointments.staff_id = admin.id', 'LEFT');
            $this->db->limit($limit, $start);
            $this->db->group_bys.id');
            $this->db->order_by($orderBy, $orderFormat);

            $run_q = $this->db->get('appointments');
        }

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     *
     * @param type $_iN item Name
     * @param type $_iC item Code
     * @param type $desc Desc
     * @param type $q quantity bought
     * @param type $_up unit price
     * @param type $_tp total price
     * @param type $_tas total amount spent
     * @param type $_at amount tendered
     * @param type $_cd change due
     * @param type $_mop mode of payment
     * @param type $_tt transaction type whether (sale{1} or return{2})
     * @param types.id
     * @param float $_va VAT Amount
     * @param float $_vp VAT Percentage
     * @param float $da Discount Amount
     * @param float $dp Discount Percentage
     * @param {string} $cn Customer Name
     * @param {string} $cp Customer Phone
     * @param {string} $ce Customer Email
     * @return boolean
     */
    public function add($_iN, $_iC, $desc, $q, $_up, $_tp, $_tas, $_at, $_cd, $_mop, $_tt,s.id, $_va, $_vp, $da, $dp, $cn, $cp, $ce) {
        $data = ['itemName' => $_iN, 'itemCode' => $_iC, 'description' => $desc, 'quantity' => $q, 'unitPrice' => $_up, 'totalPrice' => $_tp,
            'end_time' => $_at, 'price_final' => $_cd, 'customer_name' => $_mop, 'transType' => $_tt,
            'staff_id' => $this->session->admin_id, 'date_created' => $_tas,s.id' =>s.id, 'vatAmount' => $_va,
            'vatPercentage' => $_vp, 'discount_amount'=>$da, 'discount_percentage'=>$dp, 'cust_name'=>$cn, 'customer_contact'=>$cp,
            'cust_email'=>$ce];

        //set the datetime based on the db driver in use
        $this->db->platform() == "sqlite3" ?
            $this->db->set('created_at', "datetime('now')", FALSE) :
            $this->db->set('created_at', "NOW()", FALSE);

        $this->db->insert('appointments', $data);

        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Primarily used t check whether a prticulas.id exists in db
     * @param types.id
     * @return boolean
     */
    public function s.idExists.id) {
        $q = "SELECT DISTINCs.id FROM appointments WHERs.id = ?";

        $run_q = $this->db->query($q, s.id]);

        if ($run_q->num_rows() > 0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    public function transSearch($value) {
        $this->db->select('appointments.id, appointments.date_created, appointments.customer_name, appointments.staff_id,
                appointments.created_at, appointments.start_time, appointments.end_time, appointments.price_final,
                CONCAT_WS(" ", admin.first_name, admin.last_name) as "staffName",
                appointments.cust_name, appointments.customer_contact, appointments.cust_email');
        $this->db->select_sum('appointments.quantity');
        $this->db->join('admin', 'appointments.staff_id = admin.id', 'LEFT');
        $this->db->likes.id', $value);
        $this->db->or_like('itemName', $value);
        $this->db->or_like('itemCode', $value);
        $this->db->group_bys.id');

        $run_q = $this->db->get('appointments');

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Get all appointments with a particulas.id
     * @param types.id
     * @return boolean
     */
    public function gettransinfos.id) {
        $q = "SELECT * FROM appointments WHERs.id = ?";

        $run_q = $this->db->query($q, s.id]);

        if ($run_q->num_rows() > 0) {
            return $run_q->result_array();
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * selects the total number of appointments done so far
     * @return boolean
     */
    public function totalappointments() {
        $q = "SELECT count(DISTINCs.id) as 'totalTrans' FROM appointments";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalTrans;
            }
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    /**
     * Calculates the total amount earned today
     * @return boolean
     */
    public function totalEarnedToday() {
        $q = "SELECT date_created FROM appointments WHERE DATE(created_at) = CURRENT_DATE GROUP Bs.id";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows()) {
            $totalEarnedToday = 0;

            foreach ($run_q->result() as $get) {
                $totalEarnedToday += $get->date_created;
            }

            return $totalEarnedToday;
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    //Not in use yet
    public function totalEarnedOnDay($date) {
        $q = "SELECT SUM(totalPrice) as 'totalEarnedToday' FROM appointments WHERE DATE(created_at) = {$date}";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->totalEarnedToday;
            }
        }
        else {
            return FALSE;
        }
    }

    /*
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     * *******************************************************************************************************************************
     */

    public function getDateRange($from_date, $to_date){
        if ($this->db->platform() == "sqlite3") {
            $q = "SELECT appointments.id, appointments.date_created, appointments.customer_name, appointments.staff_id,
                appointments.created_at, appointments.start_time, appointments.end_time, appointments.price_final,
                admin.first_name || ' ' || admin.last_name AS 'staffName', SUM(appointments.quantity) AS 'quantity',
                appointments.cust_name, appointments.customer_contact, appointments.cust_email
                FROM appointments
                LEFT OUTER JOIN admin ON appointments.staff_id = admin.id
                WHERE
                date(appointments.created_at) >= {$from_date} AND date(appointments.created_at) <= {$to_date}
                GROUP Bs.id
                ORDER BY appointments.transId DESC";

            $run_q = $this->db->query($q);
        }

        else {
            $this->db->select('appointments.id, appointments.date_created, appointments.customer_name, appointments.staff_id,
                    appointments.created_at, appointments.start_time, appointments.end_time, appointments.price_final,
                    CONCAT_WS(" ", admin.first_name, admin.last_name) AS "staffName",
                    appointments.cust_name, appointments.customer_contact, appointments.cust_email');

            $this->db->select_sum('appointments.quantity');

            $this->db->join('admin', 'appointments.staff_id = admin.id', 'LEFT');

            $this->db->where("DATE(appointments.created_at) >= ", $from_date);
            $this->db->where("DATE(appointments.created_at) <= ", $to_date);

            $this->db->order_by('appointments.transId', 'DESC');

            $this->db->group_bys.id');

            $run_q = $this->db->get('appointments');
        }

        return $run_q->num_rows() ? $run_q->result() : FALSE;
    }
}
