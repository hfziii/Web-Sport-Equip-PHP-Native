<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login-Sport Equip</title>
        <link rel="icon" href="img/favicon_io/favicon.ico" type="image/png">
        <link rel="stylesheet" href="./css/login.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="base-body">
  
            <div class="sidebanner">
                <img src="./img/login/sportequip.png" alt="">
            </div>

            <div class="sideform">           
                
                <!-- CONTAINER FORM LOGIN -->
                <div class="formlogin">
                    <div class="switch-button">
                        <button id="loginBtn" class="active" onclick="showLogin()">Log in</button>
                        <button id="signupBtn" onclick="showSignup()">Sign up</button>
                    </div>
            
                    <div class="form-container">
            
                        <!-- LOGIN -->
                        <form action="ceklogin.php" method="post" id="loginForm" class="form visible form-log" >
            
                            <!-- FORM USERNAME PASSWORD -->
                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="input-container password-container">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="loginPassword" class="input-pw" name="password" placeholder="Password" required>
                                <span class="toggle-password" onclick="togglePassword()">
                                    <i class="fa fa-eye-slash" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            
                            <!-- CHECKBOX -->
                            <label for="termsCheckbox" class="termsCheckbox">
                                <input type="checkbox" class="termsCheckbox" name="termsCheckbox">
                                Remember me?
                            </label>
                            
                            <!-- BUTTON SUBMIT -->
                            <button type="submit" class="btn-login">Log in</button>
                        
                        </form>
            
                        <!-- SIGN-UP -->
                        <form id="signupForm" class="form hidden form-sign" action="register.php" method="post">
            
                            <!-- FORM USERNAME, EMAIL, PASSWORD -->
                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Name" required>
                            </div>
                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="input-container">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-container password-container">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="signupPassword" class="input-pw" name="password" placeholder="Password" required>
                                <span class="toggle-password" onclick="togglePassword()">
                                    <i class="fa fa-eye-slash" id="toggleSignupPasswordIcon"></i>
                                </span>
                            </div>
                            <div class="input-container">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="telepon" placeholder="No. Telepon" required>
                            </div>
                            
                            <!-- BUTTON SUBMIT -->
                            <button type="submit">Sign up</button>    
                        </form>
                    </div>
                </div>
                
            </div>
            
        </div>

        <!-- JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
                crossorigin="anonymous">
        </script>
        <script src="./js/script.js"></script>
    </body>
</html>
