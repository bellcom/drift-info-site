<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Drift status : Bellcom.dk</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/site/css/base.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Drift status</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="mailto:support@bellcom.dk">Kontakt</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container container-main">
      <img src="/assets/site/img/logo.png" alt="Bellcom">
<p class="lead">Drift status oversigt</p>


<h1>Nuværende fejl</h1>

<?php
if ($this->unresolved_issues) 
{
  foreach ($this->unresolved_issues as $issue) 
  {
    ?>
    <div class="alert alert-danger">
    <?php echo date( 'd-M-Y H:i', $issue['date'] ); ?>
    <h2><?php echo $issue['title'];?></h2>
    <?php echo $issue['desc']; ?>
    </div> 
    <?php
  }
}
else
{
?>
Ingen fejl pt
<?php
}
?>

<h1>Afsluttede fejl</h1>

<?php
if ($this->resolved_issues) 
{
  foreach ($this->resolved_issues as $issue) 
  {
    ?>
    <div class="alert alert-success">
    <?php echo date( 'd-M-Y H:i', $issue['date'] ); ?>
    <h2><?php echo $issue['title'];?></h2>
    <?php echo $issue['desc']; ?>
    </div> 
    <?php
  }
}
?>

    </div><!-- /.container -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
