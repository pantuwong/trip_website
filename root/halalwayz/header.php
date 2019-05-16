<nav class="navbar bg-info navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll=" " id="sectionsNav">
  <div class="container">
      <div class="navbar-translate">
          <a class="navbar-brand" href=""><img src="assets/img/navbarlogo01.png"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a routerLink="" class="nav-link">
            <i class="material-icons">home</i> Home
          </a>
        </li>
        <li class="nav-item">
          <a routerLink="" class="nav-link">
            <i class="material-icons">card_travel</i> place to go
          </a>
        </li>
        <?php
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
        ?>
        <li class="nav-item">
          <a routerLink="{{globals.signinBtnRoute}}" class="nav-link">
            <i class="material-icons">account_circle</i><?php echo $userData['first_name']; ?>
          </a>
        </li>
        <?php } else { ?>
        <li class="button-container nav-item iframe-extern">
          <a href="regis.php" class="btn  btn-warning  btn-round btn-block">
            Login
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>