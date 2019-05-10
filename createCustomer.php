<?php

    $con = mysql_connect('localhost','root','');

    if($con)
    {
        echo 'Not connected to server';
    }

    if(!mysql_select_db($con,'sample'))
    {
        echo 'database not selected';
    }

    $fname = $_POST ['fname'];
    $lname = $_POST ['lname'];
    $address = $_POST ['address'];
    $gender = $_POST ['gender'];
    $age = $_POST ['age'];
    $dob = $_POST ['dob'];
    $telephone = $_POST ['telephone'];
    $comment = $_POST ['comment'];

    $sql = "INSERT INTO staff (fname,lname,address,gender,age,dob,telephone,comment) VALUES ('$fname','$lname','$address','$gender','$age','$dob','&telephone','$comment')";

    if(!mysql_query($con,$sql))
    {
        echo'not inserted';
    }
    else
    {
        echo 'inserted';
    }

    header("refresh:2; url = homepage.html");
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Profile</title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="testing.css">
        
    </head>
    
    <body>
        <div class="container-full" >
            <div class="row">
                <div class="navbar navbar-inverse navbar-static-top">
                    <a href="#" class="navbar-brand">Smile and Style Salon</a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse navHeaderCollapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="homepage.html">Home</a></li>
                            <li><a href="createCustomer.html">Customer</a></li>
                            <li><a href="createStaff.html">Staff</a></li>
                            <li><a href="createInventory.html">Inventory</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report  <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Sales</a></li>
                                    <li><a href="#">Staff</a></li>
                                </ul>
                            </li>
                            <li><a href="createAppointment.html">Appointment</a></li>
                            <li><a href="aboutUs.html">About Us</a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            
                <div class="button">
                    <button type="submit" class="btn" id="button_space" data-toggle="modal" data-target="#cust_modal">Create</button>
                    <button type="submit" class="btn">Edit</button>
                </div>
            
            <form action="connectCustomer.php" method="POST" style="width:960px; margin:auto;" onsubmit="return validation()" name="form">
                <div class="modal" id="cust_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Customer</h3>
                                 <p>Please use following form to key in the right input</p>
                            </div>
                            
                            <div class="modal-body">
                                <div class="form-inline" id="cust_first">
                                    <div class="form-group required">
                                        <label class="ast" for="fname">First Name:</label>
                                            <div>
                                                <input type="text" class="form-control" id="fname" placeholder="Jane" name="fname">
                                                
                                            </div>
                                    </div>
                
                                    <div class="form-group required" id="">
                                        <label class="ast" for="lname">Last Name:</label>
                                        <div>
                                            <input type="text" class="form-control" id="lname" placeholder="Doe" name="lname">
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group">
                                    <div class="form-inline" id="cust_second">
                                        <div class="form-group required" id="cust_second">
                                            <label class="ast" for="email">Email:</label>
                                            <div>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="jane.doe@example.com">
                                                <!--<label id="_email" style="color:red;visibility:hidden" >Invalid</label>-->
                                            </div>
                                        </div>

                                        <div class="form-group" id="">
                                            <label for="address">Address:</label>
                                            <div>
                                                <input type="text" class="form-control" id="address" name="address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group" id="cust_third">
                                    <div class="form-inline">
                                        <div class="form-group required">
                                            <label class="ast" for="gender">Gender</label>
                                            <div>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option></option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label class="ast" for="age">Age:</label>
                                            <div>
                                                <input type="number" class="form-control" id="age" name="age">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Date of Birth:</label>
                                            <div>
                                                <input type="date" class="form-control" id="date">
                                            </div>

                                        </div>


                                        <div class="form-group required">
                                            <label class="ast" for="salary">Telephone:</label>
                                            <div>
                                                <input type="text" class="form-control" id="hp" placeholder="+60" name="telephone">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                
                
                                <div class="form-group">
                                    <label for="lname">Comments:</label>
                                     <div>
                                        <textarea class="form-control" name="comment"></textarea>
                                     </div>
                                </div>
                                
                                <div id="alertMessage">
                                    <small>* Please fill up the required information</small>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <input type="submit"  name="submit" value="Create">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="navbar navbar-inverse navbar-fixed-bottom">
                <div class="container-full">
                    <div class="footer">
                        <h5>Site Built by ????</h5>
                        <h5>Copyright &copy; Style and Salon 2019</h5>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            function validation()
            {
                
                var fname = document.getElementById('fname').value;
                var lname = document.getElementById('lname').value;
                var email = document.getElementById('email').value;
                var age = document.getElementById('age').value;
                var date = document.getElementById('date').value;
                var hp = document.getElementById('hp').value;
                var gender = form.gender.selectedIndex;
                var errormessage = "";
                var successmessage = "Customer Profile Successfully Created!"
                
                //Validation
                
                var reg_fname = /^[a-zA-Z]+$/;
                var reg_lname = /^[a-zA-Z]+$/;
                var reg_email = /^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+).([a-z]{2,20})$/;
                var reg_age = /^[0-9]+$/;
                var reg_hp = /^([0-9]{2,11})$/;
    
                //All Validaiton are Correct
                if(reg_fname.test(fname) && reg_lname.test(lname) && reg_email.test(email) && gender != 0 && reg_age.test(age) && date != "" && reg_hp.test(age))
                    {
                        alert(successmessage);
                    }
                
                //Empty Box Validation
                //First Name
                if(fname == "")
                    {
                        errormessage += "Missing Input of \n";
                        errormessage += "First Name, "
                        alert(errormessage);
                    }
                
                //Last Name
                if (lname == "")
                    {
                        errormessage += "Last Name, ";
                        alert(errormessage);
                    }
                
                //Email
                if (email == "")
                    {
                        errormessage += "Email, ";
                        alert(errormessage);
                    }
                
                //Gender
                if(gender == 0)
                    {
                        errormessage += "Gender, ";
                        alert(errormessage);
                        form.gender.focus();
                    }
                
                //Age
                if (age == "")
                    {
                        errormessage += "Age, ";
                        alert(errormessage);
                    }
                
                //Date
                if(date == "")
                    {
                        errormessage += "Date \n";
                        alert(errormessage);
                    }
                
                
                //Regular Expression Validation
                //First Name
                if(reg_fname.test(fname))
                    {
                        return true;
                    }
                else
                    {
                        errormessage += "\nWrong input of \n";
                        errormessage += "First Name, ";
                        alert(errormessage);
                    }
                
                //Last Name
                if(reg_lname.test(lname))
                    {
                        return true;
                    }
                else
                    {
                        errormessage += "Last Name, ";
                        alert(errormessage);
                    }
                
                //Email
                if(reg_email.test(email))
                    {
                        return true;
                    }
                else
                    {
                        errormessage += "Email, ";
                        alert(errormessage);
                    }
                
                //Age
                if(reg_age.test(age))
                   {
                        return true;
                    }
                else
                    {
                        errormessage += "Age";
                        alert(errormessage);
                    }
            
            }
        </script>
        
        
        
    </body>
</html>




















