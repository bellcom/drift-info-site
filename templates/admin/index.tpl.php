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
    <div class="container">

<h3>Create new issue</h3>

<form role="form" action="/admin/create" method="post">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title">
  </div>
  <div class="form-group">
    <label for="desc">Description</label>
    <input type="text" class="form-control" name="desc">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="add-time" value="1"> <span class="glyphicon glyphicon-time"></span> Add current time before Description 
    </label>
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>

<hr>

<h3>Unresolved issues</h3>

<?php
if ($this->unresolved_issues) 
{
  foreach ($this->unresolved_issues as $issue) 
  {
    ?>
<div class="alert alert-danger">
      <h4><?php echo $issue['title']; ?></h4>
<?php echo $issue['desc']; ?>
<form role="form" action="/admin/update" method="post">
  <div class="form-group">
    <label for="desc">Status update</label>
    <input type="text" class="form-control" name="desc">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="resolved" value="1"> <span class="glyphicon glyphicon-ok"></span> Mark as resolved 
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="add-time" value="1"> <span class="glyphicon glyphicon-time"></span> Add current time before Description 
    </label>
  </div>
  <input type="hidden" name="issue-id" value="<?php echo $issue['id']; ?>">
  <input type="hidden" name="existing-desc" value="<?php echo $issue['desc']; ?>">
  <button type="submit" class="btn btn-default" name="update">Update</button>
  <button type="submit" class="btn btn-default" name="delete">Delete</button>
</form>
</div>
<hr>
    <?php
  }
}
else
{
?>
Currently no issues :)
<?php
}
?>

<h3>Resolved issues</h3>

<?php
if ($this->resolved_issues) 
{
  foreach ($this->resolved_issues as $issue) 
  {
    ?>
    <div class="alert alert-success">
    <?php echo date( 'd-M-Y H:i', $issue['date'] ); ?>
    <h4><?php echo $issue['title'];?></h4>
    <?php echo $issue['desc']; ?>
    <form role="form" action="/admin/update" method="post">
      <input type="hidden" name="issue-id" value="<?php echo $issue['id']; ?>">
      <button type="submit" class="btn btn-default" name="delete">Delete</button>
    </form>
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
