<?php
defined('BASEPATH') OR exit('');
?>

<div class="row hidden-print">
    <div class="col-sm-12">
        <div class="pwell">
            <!-- Header (add new staff, sort order etc.) -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-2 fa fa-user-plus pointer" style="color:#337ab7" data-target='#addNewCustomerModal' data-toggle='modal'>
                        New Customer
                    </div>
                    <div class="col-sm-3 form-inline form-group-sm">
                        <label for="customerListPerPage">Show</label>
                        <select id="customerListPerPage" class="form-control">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label for="customerListPerPage">per page</label>
                    </div>
                    <div class="col-sm-4 form-inline form-group-sm">
                        <label for="customerListSortBy" class="control-label">Sort by</label>
                        <select id="customerListSortBy" class="form-control">
                            <option value="first_name-ASC" selected>Name (A to Z)</option>
                            <option value="first_name-DESC">Name (Z to A)</option>
                            <option value="created_on-ASC">Date Created (older first)</option>
                            <option value="created_on-DESC">Date Created (recent first)</option>
                            <option value="email-ASC">E-mail - ascending</option>
                            <option value="email-DESC">E-mail - descending</option>
                        </select>
                    </div>
                    <!-- <div class="col-sm-3 form-inline form-group-sm">
                        <label for="staffSearch"><i class="fa fa-search"></i></label>
                        <input type="search" id="staffSearch" placeholder="Search...." class="form-control">
                    </div> -->
                </div>
            </div>

            <hr>
            <!-- Header (sort order etc.) ends -->

            <!-- staff list -->
            <div class="row">
                <div class="col-sm-12" id="allCustomers"></div>
            </div>
            <!-- staff list ends -->
        </div>
    </div>
</div>


<!--- Modal to add new staff --->
<div class='modal fade' id='addNewCustomerModal' role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class='modal-header'>
                <button class="close" data-dismiss='modal'>&times;</button>
                <h4 class="text-center">Add New Customer</h4>
                <div class="text-center">
                    <i id="fMsgIcon"></i><span id="fMsg"></span>
                </div>
            </div>
            <div class="modal-body">
                <form id='addNewCustomerForm' name='addNewCustomerForm' role='form'>
                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='firstName' class="control-label">First Name</label>
                            <input type="text" id='firstName' class="form-control checkField" placeholder="First Name">
                            <span class="help-block errMsg" id="firstNameErr"></span>
                        </div>
                        <div class="form-group-sm col-sm-6">
                            <label for='lastName' class="control-label">Last Name</label>
                            <input type="text" id='lastName' class="form-control checkField" placeholder="Last Name">
                            <span class="help-block errMsg" id="lastNameErr"></span>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='email' class="control-label">Email</label>
                            <input type="email" id='email' class="form-control checkField" placeholder="Email">
                            <span class="help-block errMsg" id="emailErr"></span>
                        </div>
                        <!-- <div class="form-group-sm col-sm-6">
                            <label for='role' class="control-label">Role</label>
                            <select class="form-control checkField" id='role'>
                                <option value=''>Role</option>
                                <option value='Super'>Super</option>
                                <option value='Basic'>Basic</option>
                            </select>
                            <span class="help-block errMsg" id="roleErr"></span>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='mobile' class="control-label">Phone Number</label>
                            <input type="tel" id='mobile' class="form-control checkField" placeholder="Phone Number">
                            <span class="help-block errMsg" id="mobile1Err"></span>
                        </div>
                        <!-- <div class="form-group-sm col-sm-6">
                            <label for='mobile2' class="control-label">Other Number</label>
                            <input type="tel" id='mobile2' class="form-control" placeholder="Other Number (optional)">
                            <span class="help-block errMsg" id="mobile2Err"></span>
                        </div> -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" form="addNewCustomerForm" class="btn btn-warning pull-left">Reset Form</button>
                <button type='button' id='addCustomerSubmit' class="btn btn-primary">Add customer</button>
                <button type='button' class="btn btn-danger" data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>
<!--- end of modal to add new staff --->


<!--- Modal for editing staff details --->
<!-- <div class='modal fade' id='editAdminModal' role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class='modal-header'>
                <button class="close" data-dismiss='modal'>&times;</button>
                <h4 class="text-center">Edit staff Info</h4>
                <div class="text-center">
                    <i id="fMsgEditIcon"></i>
                    <span id="fMsgEdit"></span>
                </div>
            </div>
            <div class="modal-body">
                <form id='editAdminForm' name='editAdminForm' role='form'>
                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='firstNameEdit' class="control-label">First Name</label>
                            <input type="text" id='firstNameEdit' class="form-control checkField" placeholder="First Name">
                            <span class="help-block errMsg" id="firstNameEditErr"></span>
                        </div>
                        <div class="form-group-sm col-sm-6">
                            <label for='lastNameEdit' class="control-label">Last Name</label>
                            <input type="text" id='lastNameEdit' class="form-control checkField" placeholder="Last Name">
                            <span class="help-block errMsg" id="lastNameEditErr"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='emailEdit' class="control-label">Email</label>
                            <input type="email" id='emailEdit' class="form-control checkField" placeholder="Email">
                            <span class="help-block errMsg" id="emailEditErr"></span>
                        </div>
                        <div class="form-group-sm col-sm-6">
                            <label for='roleEdit' class="control-label">Role</label>
                            <select class="form-control checkField" id='roleEdit'>
                                <option value=''>Role</option>
                                <option value='Super'>Super</option>
                                <option value='Basic'>Basic</option>
                            </select>
                            <span class="help-block errMsg" id="roleEditErr"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group-sm col-sm-6">
                            <label for='mobile1Edit' class="control-label">Phone Number</label>
                            <input type="tel" id='mobile1Edit' class="form-control checkField" placeholder="Phone Number">
                            <span class="help-block errMsg" id="mobile1EditErr"></span>
                        </div>
                        <div class="form-group-sm col-sm-6">
                            <label for='mobile2Edit' class="control-label">Other Number</label>
                            <input type="tel" id='mobile2Edit' class="form-control" placeholder="Other Number (optional)">
                            <span class="help-block errMsg" id="mobile2EditErr"></span>
                        </div>
                    </div>

                    <input type="hidden" id="staffId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="reset" form="editAdminForm" class="btn btn-warning pull-left">Reset Form</button>
                <button type='button' id='editAdminSubmit' class="btn btn-primary">Update</button>
                <button type='button' class="btn btn-danger" data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div> -->
<!--- end of modal to edit staff details --->
<script src="<?=base_url()?>public/js/customer.js"></script>
