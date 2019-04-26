<?php
    //Get values from form in LoginPage.php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error ="";
    $success = "";

    if(isset($_POST['submit']))
    {
        if($username == "admin")
        {
            if($password == "admin12345")
            {
                $error = "";
                $success = "Welcome Admin";
                header(Location:homepage.html);
            }
            else
            {
                $error = "Invalid username or Password";
                $success = "";
            }
        }
        else
        {
            $error = "Invalid Username or Password";
            $success = "";
        }

    }
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Form</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" type="text/css" href="global.css">
        
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                    <form class="form-container" method="POST">
                        <p class="error"><?php echo $error; ?></p>
                        <p><?php echo $success; ?></p>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                      <button type="submit" class="btn btn-primary btn-block"  name="submit" value="login">Submit</button>
                    </form>
                </div>
        </div>
           
            
    </body>
</html>