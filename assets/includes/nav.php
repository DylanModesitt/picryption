<nav id="nav" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id="navbar-brand" href="./index.php">PICRYPTION</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="./info.php">Info</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Encryption <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./index.php">Message in image</a></li>
            <li><a href="./image_obscure.php">Obscure image</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">More Coming Soon!</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" method="post" action="./search.php">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> 
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Legal <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./terms.php">Terms</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="./privacy.php">Privacy</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>