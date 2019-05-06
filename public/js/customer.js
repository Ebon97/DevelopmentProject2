'use strict';

$(document).ready(function(){
    checkDocumentVisibility();//check document visibility in order to confirm user's log in status


    //load all admin once the page is ready
    //function header: lacus_(url)
    lacus_();

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //reload the list of admin when fields are changed
    $("#customerListSortBy, #customerListPerPage").change(function(){
        displayFlashMsg("Please wait...", spinnerClass, "", "");
        lacus_();
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //load and show page when pagination link is clicked
    $("#allCustomers").on('click', '.lnp', function(e){
        e.preventDefault();

        displayFlashMsg("Please wait...", spinnerClass, "", "");

        lacus_($(this).attr('href'));

        return false;
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //handles the addition of new admin details .i.e. when "add admin" button is clicked
    $("#addCustomerSubmit").click(function(e){
        e.preventDefault();

        //reset all error msgs in case they are set
        changeInnerHTML(['firstNameErr', 'lastNameErr', 'emailErr', 'mobileErr'],
        "");

        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var mobile = $("#mobile").val();


        //ensure all required fields are filled
        if(!firstName || !lastName || !email || !mobile){
            !firstName ? changeInnerHTML('firstNameErr', "required") : "";
            !lastName ? changeInnerHTML('lastNameErr', "required") : "";
            !email ? changeInnerHTML('emailErr', "required") : "";
            !mobile ? changeInnerHTML('mobile1Err', "required") : "";
            return;
        }

        //display message telling user action is being processed
        $("#fMsgIcon").attr('class', spinnerClass);
        $("#fMsg").text(" Processing...");

        //make ajax request if all is well
        $.ajax({
            method: "POST",
            url: appRoot+"customer/add",
            data: {firstName:firstName, lastName:lastName, email:email, mobile:mobile},
        }).done(function(returnedData){
            $("#fMsgIcon").removeClass();//remove spinner

            if(returnedData.status === 1){
                $("#fMsg").css('color', 'green').text(returnedData.msg);

                //reset the form
                document.getElementById("addNewCustomerForm").reset();

                //close the modal
                setTimeout(function(){
                    $("#fMsg").text("");
                    $("#addNewCustomerModal").modal('hide');
                }, 1000);

                //reset all error msgs in case they are set
                changeInnerHTML(['firstNameErr', 'lastNameErr', 'emailErr', 'mobileErr'],
                "");

                //refresh admin list table
                lacus_();

            }

            else{
                //display error message returned
                $("#fMsg").css('color', 'red').html(returnedData.msg);

                //display individual error messages if applied
                $("#firstNameErr").text(returnedData.firstName);
                $("#lastNameErr").text(returnedData.lastName);
                $("#emailErr").text(returnedData.email);
                $("#mobileErr").text(returnedData.mobile);
            }
        }).fail(function(){
            if(!navigator.onLine){
                $("#fMsg").css('color', 'red').text("Network error! Pls check your network connection");
            }
        });
    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // //handles the updating of admin details
    // $("#editAdminSubmit").click(function(e){
    //     e.preventDefault();

    //     if(formChanges("editAdminForm")){
    //         //reset all error msgs in case they are set
    //         changeInnerHTML(['firstNameEditErr', 'lastNameEditErr', 'emailEditErr', 'roleEditErr', 'mobile1Err', 'mobile2Err'], "");

    //         var firstName = $("#firstNameEdit").val();
    //         var lastName = $("#lastNameEdit").val();
    //         var email = $("#emailEdit").val();
    //         var mobile1 = $("#mobile1Edit").val();
    //         var mobile2 = $("#mobile2Edit").val();
    //         var role = $("#roleEdit").val();
    //         var adminId = $("#adminId").val();

    //         //ensure all required fields are filled
    //         if(!firstName || !lastName || !email || !role || !mobile1){
    //             !firstName ? changeInnerHTML('firstNameEditErr', "required") : "";
    //             !lastName ? changeInnerHTML('lastNameEditErr', "required") : "";
    //             !email ? changeInnerHTML('emailEditErr', "required") : "";
    //             !mobile1 ? changeInnerHTML('mobile1EditErr', "required") : "";
    //             !role ? changeInnerHTML('roleEditErr', "required") : "";

    //             return;
    //         }

    //         if(!adminId){
    //             $("#fMsgEdit").text("An unexpected error occured while trying to update administrator's details");
    //             return;
    //         }

    //         //display message telling user action is being processed
    //         $("#fMsgEditIcon").attr('class', spinnerClass);
    //         $("#fMsgEdit").text(" Updating details...");

    //         //make ajax request if all is well
    //         $.ajax({
    //             method: "POST",
    //             url: appRoot+"administrators/update",
    //             data: {firstName:firstName, lastName:lastName, email:email, role:role, mobile1:mobile1, mobile2:mobile2, adminId:adminId}
    //         }).done(function(returnedData){
    //             $("#fMsgEditIcon").removeClass();//remove spinner

    //             if(returnedData.status === 1){
    //                 $("#fMsgEdit").css('color', 'green').text(returnedData.msg);

    //                 //reset the form and close the modal
    //                 setTimeout(function(){
    //                     $("#fMsgEdit").text("");
    //                     $("#editAdminModal").modal('hide');
    //                 }, 1000);

    //                 //reset all error msgs in case they are set
    //                 changeInnerHTML(['firstNameEditErr', 'lastNameEditErr', 'emailEditErr', 'roleEditErr', 'mobile1Err', 'mobile2Err'], "");

    //                 //refresh admin list table
    //                 lacus_();

    //             }

    //             else{
    //                 //display error message returned
    //                 $("#fMsgEdit").css('color', 'red').html(returnedData.msg);

    //                 //display individual error messages if applied
    //                 $("#firstNameEditErr").html(returnedData.firstName);
    //                 $("#lastNameEditErr").html(returnedData.lastName);
    //                 $("#emailEditErr").html(returnedData.email);
    //                 $("#mobile1EditErr").html(returnedData.mobile1);
    //                 $("#mobile2EditErr").html(returnedData.mobile2);
    //                 $("#roleEditErr").html(returnedData.role);
    //             }
    //         }).fail(function(){
    //                 if(!navigator.onLine){
    //                     $("#fMsgEdit").css('color', 'red').html("Network error! Pls check your network connection");
    //                 }
    //             });
    //     }

    //     else{
    //         $("#fMsgEdit").html("No changes were made");
    //     }
    // });

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // //handles admin search
    // $("#adminSearch").on('keyup change', function(){
    //     var value = $(this).val();

    //     if(value){//search only if there is at least one char in input
    //         $.ajax({
    //             type: "get",
    //             url: appRoot+"search/adminsearch",
    //             data: {v:value},
    //             success: function(returnedData){
    //                 $("#allCustomers").html(returnedData.adminTable);
    //             }
    //         });
    //     }

    //     else{
    //         lacus_();
    //     }
    // });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // //When the toggle on/off button is clicked to change the account status of an admin (i.e. suspend or lift suspension)
    // $("#allCustomers").on('click', '.suspendAdmin', function(){
    //     var ElemId = $(this).attr('id');

    //     var adminId = ElemId.split("-")[1];//get the adminId

    //     //show spinner
    //     $("#"+ElemId).html("<i class='"+spinnerClass+"'</i>");

    //     if(adminId){
    //         $.ajax({
    //             url: appRoot+"administrators/suspend",
    //             method: "POST",
    //             data: {_aId:adminId}
    //         }).done(function(returnedData){
    //             if(returnedData.status === 1){
    //                 //change the icon to "on" if it's "off" before the change and vice-versa
    //                 var newIconClass = returnedData._ns === 1 ? "fa fa-toggle-on pointer" : "fa fa-toggle-off pointer";

    //                 //change the icon
    //                 $("#sus-"+returnedData._aId).html("<i class='"+ newIconClass +"'></i>");

    //             }

    //             else{
    //                 console.log('err');
    //             }
    //         });
    //     }
    // });


    /*
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    */


    //When the trash icon in front of an admin account is clicked on the admin list table (i.e. to delete the account)
    // $("#allCustomers").on('click', '.deleteAdmin', function(){
    //     var confirm = window.confirm("Proceed?");

    //     if(confirm){
    //         var ElemId = $(this).attr('id');

    //         var adminId = ElemId.split("-")[1];//get the adminId

    //         //show spinner
    //         $("#"+ElemId).html("<i class='"+spinnerClass+"'</i>");

    //         if(adminId){
    //             $.ajax({
    //                 url: appRoot+"administrators/delete",
    //                 method: "POST",
    //                 data: {_aId:adminId}
    //             }).done(function(returnedData){
    //                 if(returnedData.status === 1){

    //                     //change the icon to "undo delete" if it's "active" before the change and vice-versa
    //                     var newHTML = returnedData._nv === 1 ? "<a class='pointer'>Undo Delete</a>" : "<i class='fa fa-trash pointer'></i>";

    //                     //change the icon
    //                     $("#del-"+returnedData._aId).html(newHTML);

    //                 }

    //                 else{
    //                     alert(returnedData.status);
    //                 }
    //             });
    //         }
    //     }
    // });


    /*
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    ******************************************************************************************************************************
    */


    //to launch the modal to allow for the editing of admin info
    // $("#allCustomers").on('click', '.editAdmin', function(){

    //     var adminId = $(this).attr('id').split("-")[1];

    //     $("#adminId").val(adminId);

    //     //get info of admin with adminId and prefill the form with it
    //     //alert($(this).siblings(".adminEmail").children('a').html());
    //     var firstName = $(this).siblings(".firstName").html();
    //     var lastName = $(this).siblings(".lastName").html();
    //     var role = $(this).siblings(".adminRole").html();
    //     var email = $(this).siblings(".adminEmail").children('a').html();
    //     var mobile1 = $(this).siblings(".adminMobile1").html();
    //     var mobile2 = $(this).siblings(".adminMobile2").html();

    //     //prefill the form fields
    //     $("#firstNameEdit").val(firstName);
    //     $("#lastNameEdit").val(lastName);
    //     $("#emailEdit").val(email);
    //     $("#mobile1Edit").val(mobile1);
    //     $("#mobile2Edit").val(mobile2);
    //     $("#roleEdit").val(role);

    //     $("#editAdminModal").modal('show');
    // });

});



/*
***************************************************************************************************************************************
***************************************************************************************************************************************
***************************************************************************************************************************************
***************************************************************************************************************************************
***************************************************************************************************************************************
*/

/**
 * lacus_ = "Load all customers"
 * @returns {undefined}
 */
function lacus_(url){
    var orderBy = $("#customerListSortBy").val().split("-")[0];
    var orderFormat = $("#customerListSortBy").val().split("-")[1];
    var limit = $("#customerListPerPage").val();

    $.ajax({
        type:'get',
        url: url ? url : appRoot+"customers/lacus_/",
        data: {orderBy:orderBy, orderFormat:orderFormat, limit:limit},
     }).done(function(returnedData){
            hideFlashMsg();

            $("#allCustomers").html(returnedData.customerTable);
        });
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
