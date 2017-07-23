<?php

if(isset($_GET['submit'])){
include('connections/connections.php');
include('/google/index.php');

$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$email=$_GET['email'];
$password=$_GET['password'];
///
$error="";
$result="";
$success="";

if(empty($firstname)||empty($lastname)||empty($email)||empty($password)){
echo $firstname,$lastname,$email,$password;
  $error="Enter Complete details";
}

$firstname=mysqli_escape_string($connect,(filter_var(strip_tags($firstname),FILTER_SANITIZE_STRIPPED)));
 $lastname=mysqli_escape_string($connect,filter_var(strip_tags($lastname),FILTER_SANITIZE_STRIPPED));
    $email=mysqli_escape_string($connect,filter_var(strip_tags($email),FILTER_VALIDATE_EMAIL));
 $password=mysqli_escape_string($connect,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));


$sql="SELECT * FROM register WHERE email='$email'";

//echo "hi ";
$result=mysqli_query($connect,$sql);

//echo "<br>result" .$resul


$result2=mysqli_fetch_all($result,MYSQLI_ASSOC);

if(mysqli_num_rows($result)>0){

  $error .="Email already exists";

 }
// the above part is to check whether the use email id is already there in db or not yes it is showing?
//echo ($error."mohit");yes

if(empty($error)){  

$sql="INSERT INTO register(firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','$password')";
$result=mysqli_query($connect,$sql);
//echo $firstname,$lastname,$email,$password; 
//echo $result;
if ($result) {//this is empty so not going inside
  //echo "hiii";
  $success= "data has been successfullyy inserted";
//echo $success;echo $firstname,$lastname,$email,$password;
  mysqli_close($connect);
}
} 
}?>
<?php
//Include GP config file && User class
include_once 'google/gpConfig.php';
include_once 'google/User.php';
$output;
if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id']
,        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
  
  
    $userData = $user->checkUser($gpUserData);
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
    $_SESSION['user']=$output;
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="google/logout.php">Google</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="google/images/glogin.png" alt=""/></a>';
  }

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="form">
      <h1><span><?php 
if(isset($_SESSION['user'])){
  echo $_SESSION['user'];
}
?></span></h1>
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
                
          <form action="index.php" method="get">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" name="firstname" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="lastname" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input  name="email" type="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block" name="submit" />Get Started</button>
          <span style="color:white"><?php if(isset($error)){ echo $error; } ?></span>
            <span style="color:white"><?php if(isset($success)){ echo $success; } ?></span>

          </form>
          
<div><?php 
echo $output; ?></div>
          

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="forget.html">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
           <span style="color:white"><?php if(isset($error)){ echo $error; } ?></span>
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
