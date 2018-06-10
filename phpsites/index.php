<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cosmo/bootstrap.min.css" integrity="sha384-e5ln1YQrCh2KTj0GVDWxOfDZ53Fd5Uss2u08OZUtzZNrxWfeYC4P7VBWHRDPvJUk" crossorigin="anonymous">

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/cosmo/bootstrap.min.css" integrity="sha384-e5ln1YQrCh2KTj0GVDWxOfDZ53Fd5Uss2u08OZUtzZNrxWfeYC4P7VBWHRDPvJUk" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Import custome style by Q -->
    <link rel="stylesheet" type="text/css" href="./asset/OwneStyle.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0"> -->
        <form class="collapse navbar-collapse">
          <input type="text" placeholder="Search">
          <button type="submit">Search</button>
        </form>
      </div>
    </nav>
    
    <div class="jumbotron">
        <h1 class="display-3">Hello, world!</h1>
        <p class="lead" id="text-on-jumbotron">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead" id="button-field-on-jumbotron">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>

    <form action="Post.php" method="POST" role="form">
        <legend>Get files</legend>

        <div class="form-group">
            <label for="">Tên</label>
            <input type="text" class="form-control" id="nam1" placeholder="Nhập vào tên" name="name">
        </div>

        <div class="form-group">
            <label for="">Tuổi</label>
            <input type="number" class="form-control" id="age1" placeholder="Nhập vào tuổi" name="age">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>