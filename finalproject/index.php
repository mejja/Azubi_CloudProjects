<html>
<head>
  <meta charset="utf-8">
  <title>Azubi Africa: Sign in</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="#" rel="dofollow">Azubi Africa</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Sign in to your account</span>
              <form id="stripe-login" method="post" action="login.php">
                <div class="field padding-bottom--24">
                  <label for="username">Username</label>
                  <input type="text" name="username">
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="password">Password</label>
                    <div class="reset-pass">
                      <a href="resetpassform.php">Forgot your password?</a>
                    </div>
                  </div>
                  <input type="password" name="password">
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="LogIn">
                  <div class="field padding-bottom--24"><br>
                  <p>Not a member yet?</p>
                  <a href="signup.php">SignUP</a>
                </div>
                    <?php
                        $message = $_GET['message'] ?? '';
                        if ($message) {
                          echo "<p style='border-left: 3px solid red; padding-left:5px'><b><i>$message</i></b></p>";
                          if($message == "Login successful!"){
                              header("location:dashboard.php");
                          }
                        }
                      ?>
              </form>
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>We hope you enjoy the project?</span>
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">© azubiafrica</a></span>
              <span><a href="https://azubiafrica.org" target="_blank" >Contact</a></span>
              <span><a href="https://azubiafrica.org" target="_blank">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>