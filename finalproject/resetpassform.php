<html>
<head>
  <meta charset="utf-8">
  <title>Gold Grid: Reset Password</title>
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
          <h1><a href="#" rel="dofollow">Gold Grid</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Password Reset Form</span>
              <form id="stripe-login" onSubmit="return checkPassword(this)" method="post" action="passreset.php">
                <div class="field padding-bottom--24">
                  <label for="username">Username</label>
                  <input type="text" name="username" placeholder="username" required minlength="4">
                </div>
                <div class="field padding-bottom--24">
                  <label for="email">Email Address</label>
                  <input type="email" name="email" placeholder="mail@abc.xyz" required>
                </div>
                <div class="field padding-bottom--24">
                  <label for="password">New Password</label>
                  <input type="password" name="newPassword" placeholder="********" required minlength="8">
                </div>
                <div class="field padding-bottom--24">
                  <label for="password">Confrim New Password</label>
                  <input type="password" name="confirmPassword" placeholder="********" required minlength="8">
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Reset Password">
                </div>
                <div class="field padding-bottom--24"><br>
                  <p>Click to Return back to Login!</p>
                  <a href="index.php">LogIn</a>
                </div>
                  <?php
              echo '<script type="text/javascript">
              function checkPassword(form) {
              const newPassword = form.newPassword.value;
              const confirmPassword = form.confirmPassword.value;

                if (newPassword != confirmPassword) {
                  alert("Error! Password did not match.");
                  return false;
                }else {
                  alert("Congratulations! Password updated successfully ");
                  return true;
                  }
              }         
        </script>';
          ?>     
              </form>

            </div>
          </div>
          <div class="footer-link padding-top--24">
            <span>Welcome to Gold Grid</span>
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">©2023 Gold Grid</a></span>
              <span><a href="https://goldgrid.com" target="_blank" >Contact</a></span>
              <span><a href="https://goldgrid.com" target="_blank">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>