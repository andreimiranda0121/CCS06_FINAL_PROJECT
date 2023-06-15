<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Registration Mal De Wear</title>
      <link rel="stylesheet" href="../styles/register.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
      <style>
         /* Additional styles for registration form pop-up */
         .registration-form-container {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            display: none;
            animation: color-change 10s infinite;
         }
         @keyframes expand {
            0% {
               transform: scale(0);
            }
            100% {
               transform: scale(1);
            }
         }
         .registration-form {
            background: #8c8686ca;
            padding: 10px;
            max-width: 5005px;
            text-align: center;
            border-radius: 10px;
            border-color: rgb(255, 13, 13);
            animation: color-change 10s infinite;
         }
         @keyframes expand {
            0% {
               transform: scale(0);
            }
            100% {
               transform: scale(1);
            }
         }
         .registration-form header {
            font-size: 24px;
            margin-bottom: 10px;
            color: #7d560e;
            border-radius: 200px;
            animation: color-change 15s infinite;
         }
         @keyframes color-change {
            10% {
               color: #37290283;
            }
            50% {
               color: #542901;
            }
            100% {
               color: #1d1707;
            }
         }
         .registration-form input[type="text"],
         .registration-form input[type="password"],
         .registration-form input[type="email"],
         .registration-form input[type="text"][placeholder="Shipping Address"],
         .registration-form input[type="text"][placeholder="Username"],
         .registration-form input[type="text"][placeholder="Password"],
         .registration-form input[type="text"][placeholder="Confirm"] {
            width: 100%;
            padding: 20px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 50px;
            animation: slide-up 0.5s ease-in-out;
         }
         @keyframes slide-up {
            0% {
               transform: translateY(50px);
               opacity: 0;
            }
            100% {
               transform: translateY(0);
               opacity: 1;
            }
         }
         .registration-form input[type="submit"] {
            background: #352016;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            animation: pulse 0s infinite;
            animation: color-change 2s infinite;
         }
         @keyframes pulse {
            10% {
               transform: scale(1);
            }
            10% {
               transform: scale(1.1);
            }
            90% {
               transform: scale(1);
            }
         }
         .title:hover, .title:focus {
            color: #000000;
         }
         .hover-text {
            font-size: 7em;
            animation: color-change 50s infinite;
         }
         .hover-text:hover {
            color: #542201;
         }
         .registration-form .login-link {
            margin-top: 10px;
            color: #333;
         }
         /* Hide the login section */
         .login {
            display: none;
         }
         .field{
            border-radius: 2em;
         }
       
      </style>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <span class="hover-text">M</span> 
            <span class="hover-text">A</span>
            <span class="hover-text">L</span> 
            <br>
            <span class="hover-text">D</span>
            <span class="hover-text">E</span>  
            <span class="hover-text">WEAR</span>
            <br>
            <div class="signup">
               Don't have an account?
               <a href="#" onclick="showRegistrationForm()">Signup Now</a>
            </div>
         </div>
      </div>
        <!-- Registration Form Container -->
  <div class="registration-form-container" id="registrationFormContainer">
    <div class="registration-form">
       <div class="title">
           <br>
          <span class="hover-text">MAL DE WEAR</span> 
          <br>
       </div>
       <header>Embrace the Style, Defy the Norm. Be a member NOW!</header>
       <form action="save_registration.php" method="POST"  met onsubmit="return validateForm()">
           <br>
          <div class="field">
             <span class="fa fa-user"></span>
             <input type="text" name ="fullname" required placeholder="Full Name">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-user-plus"></span>
             <input type="text" name ="username" required placeholder="Username">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-envelope"></span>
             <input type="email" name ="email" required placeholder="Email">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-map-marker"></span>
             <input type="text" name="address" required placeholder="Address (Street Address,City,Province,ZIP CODE)">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-phone"></span>
             <input type="text" name="contact" required placeholder="Phone">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-credit-card"></span>
             <input type="password" id="password" name="password" required placeholder="Password">
          </div>
          <br>
          <div class="field">
             <span class="fa fa-credit-card"></span>
             <input type="password" id="confirmPass" required placeholder="Confirm Password">
          </div>
          <br>
          <div class="field2">
             <input type="submit" value="Register">
          </div>
          <br>
       </form>
       <div class="login-link">
          Already have an account?
          <a href="login.php">Login Now</a>
       </div>
       
    </div>
 </div>

 <script>
    const registrationFormContainer = document.getElementById('registrationFormContainer');

    function showRegistrationForm() {
       registrationFormContainer.style.display = 'flex';
    }

    function hideRegistrationForm() {
       registrationFormContainer.style.display = 'none';
    }

    function validateForm() {
       const passwordField = document.getElementById('passwordField');
       const confirmField = document.getElementById('confirmField');

       if (passwordField.value !== confirmField.value) {
          alert("Your password is not confirmed!");
          return false;
       }
       return true;
    }
 </script>
</body>
</html>