



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Testing</title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="testing.css" media="all"/>
        

        <style type="text/css">
            <?php include ('testing.css'); ?>
        </style>
       
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



        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Customer</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="insertCust.php" method="POST" onsubmit="return staffValidation()">
                        <div class="modal-body">
                            <div class="form-inline" id="cust_first">
                               <div class="form-group required">
                                    <label class="ast" for="fname">First Name:</label>
                                    <div>
                                        <input type="text" class="form-control" id="fname" placeholder="Jane" name="fname" autocomplete="off" required >
                                    </div>
                               </div>
                
                                <div class="form-group required">
                                    <label class="ast" for="lname">Last Name:</label>
                                    <div>
                                        <input type="text" class="form-control" id="lname" placeholder="Doe" name="lname" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline" id="cust_second">
                                <div class="form-group required" >
                                    <label class="ast" for="lname">Email:</label>
                                    <small id="valEmail"></small>
                                    <div>
                                        <input type="email" class="form-control" id="email" placeholder="jane.doe@example.com" autocomplete="off" name="email" required>
                                    </div>
                                </div>
                                    
                                <div class="form-group required">
                                    <label class="ast" for="lname">Telephone:</label>
                                    <small id="valHp"></small>
                                    <div>
                                        <input type="text" class="form-control" id="hp" placeholder="01X-XXX-XXXX" autocomplete="off" name="telephone" required>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group" id="cust_third">
                                <div class="form-inline">
                                    <div class="form-group required">
                                        <label class="ast" for="gender">Gender</label>
                                        <small id="valGender"></small>
                                        <div>
                                            <input type="text" class="form-control" id="gender" name="gender" autocomplete="off" placeholder="Male/Female" required>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="ast" for="age">Age:</label>
                                        <small id="valAge"></small>
                                        <div>
                                            <input type="number" class="form-control" id="age" autocomplete="off" name="age" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="joined">Joined:</label>
                                        <!--<small id="valBirth"></small>-->
                                        <div>
                                            <input type="text" class="form-control" id="joined" name="joined" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="record">Recorded By:</label>
                                        <!--<small id="valBirth"></small>-->
                                        <div>
                                            <input type="text" class="form-control" id="record" name="record" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            </div> 
                        

                        <div class="modal-footer">
                            <div id="alertMessage">
                                <small>* Please fill up the required information</small>
                            </div>

                            <button type="button" class="btn" data-dismiss="modal" id="closebtn">Close</button>
                            <button type="submit" name="insertdata" class="btn btn-primary" onclick="staffValidation();">Save</button>
                        </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>

        <!--####################################################################################-->
        <!-- Edit Pop Up Form Modal -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="updateCust.php" method="POST" >
                        <div class="modal-body">
                            <input type="hidden" name="update_id" id="update_id">

                            <div class="form-inline" id="cust_first">
                               <div class="form-group required">
                                    <label class="ast" for="fname">First Name:</label>
                                    <div>
                                        <input type="text" class="form-control" id="fname" placeholder="Jane" name="fname" required>
                                    </div>
                               </div>
                
                                <div class="form-group required">
                                    <label class="ast" for="lname">Last Name:</label>
                                    <div>
                                        <input type="text" class="form-control" id="lname" placeholder="Doe" name="lname" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline" id="cust_second">
                                <div class="form-group required" >
                                    <label class="ast" for="lname">Email:</label>
                                    <small id="valEmail"></small>
                                    <div>
                                        <input type="email" class="form-control" id="email" placeholder="jane.doe@example.com" autocomplete="off" name="email" required>
                                    </div>
                                       
                                </div>
                                    
                                <div class="form-group required">
                                    <label class="ast" for="lname">Telephone:</label>
                                    <small id="valHp"></small>
                                    <div>
                                        <input type="text" class="form-control" id="telephone" placeholder="01X-XXX-XXXX" autocomplete="off" name="telephone" required>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group" id="cust_third">
                                <div class="form-inline">
                                    <div class="form-group required">
                                        <label class="ast" for="gender">Gender</label>
                                        <small id="valGender"></small>
                                        <div>
                                            <input type="text" class="form-control" id="gender" name="gender" placeholder="Male/Female" required>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="ast" for="age">Age:</label>
                                        <small id="valAge"></small>
                                        <div>
                                            <input type="number" class="form-control" id="age" autocomplete="off" name="age" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="joined">Joined:</label>
                                        <!--<small id="valBirth"></small>-->
                                        <div>
                                            <input type="text" class="form-control" id="joined" name="joined" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="record">Recorded BY:</label>
                                        <!--<small id="valBirth"></small>-->
                                        <div>
                                            <input type="text" class="form-control" id="record" name="record" required>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <div id="alertMessage">
                                <small>* Please fill up the required information</small>
                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebtn">Close</button>
                            <button type="submit" name="updatedata" class="btn btn-primary" onclick="staffValidation();">Update</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>


        <!--####################################################################################-->

        <!--####################################################################################-->
        <!-- Delete -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Delete</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="deleteCust.php" method="POST" >
                        <div class="modal-body">

                            <input type="hidden" name="delete_id" id="delete_id">

                            <h4>Do you want to delete this data?</h4>
                        </div>
                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebtn">NO</button>
                            <button type="submit" name="deletedata" class="btn btn-primary">YES</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>
        <!--####################################################################################-->


        <div class="container-full">
             <div class="staffTitle">
                <h2>Customer List</h2>
            </div>

            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" id="addButton">Create</button>
            </div>

            <!--<div align="center">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Previous</span>    
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li>
                        <a href="#" arai-label="Next">
                            <span aria-hidden="true">Next &raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        -->
            <div class="card">
                <?php

                    $connection = mysqli_connect("localhost","root","");
                    $db = mysqli_select_db($connection,'salon');

                    $query = "SELECT * FROM customer";
                    $query_run = mysqli_query($connection,$query);

                ?>

                <table class="table table-striped staffTable" id="staffTable" >
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Joined</th>
                            <th scope="col">Recorded By</th>
                        </tr>
                    </thead>

                    <?php
                        if($query_run)
                        {
                            foreach($query_run as $row)
                        {
                    ?>

                         <tbody>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['telephone']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['age']; ?></td>
                                <td><?php echo $row['joined']; ?></td>
                                <td><?php echo $row['record']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn">Delete</button>
                                </td>

                              </tr>
                         </tbody>

                         <?php
                                }
                            }
                            else
                            {
                                echo "No record found";
                            }
                        ?>

                    
                </table>


                <div class="navbar navbar-inverse navbar-fixed-bottom">
                    <div class="container-full">
                        <div class="footer">
                            <h5>Site Built by ????</h5>
                            <h5>Copyright &copy; Style and Salon 2019</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $(document).ready(function() 
            {
                $('#datatableid').DataTable();
            });

        </script>

        <script >

            $(document).ready(function()
            {
                $('.editbtn').on('click',function()
                {

                    $('#editmodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function()
                    {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('$update_id').val(data[0]);
                    $('$fname').val(data[1]);
                    $('$lname').val(data[2]);
                    $('$email').val(data[3]);
                    $('$telephone').val(data[4]);
                    $('$gender').val(data[5]);
                    $('$age').val(data[6]);
                    $('$joined').val(data[7]);
                    $('$record').val(data[8]);

                });
            });
        
            $(document).ready(function()
            {
                $('.deletebtn').on('click',function()
                {

                    $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function()
                    {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);

                });
            });
        </script>

    







    <body>


</html>
