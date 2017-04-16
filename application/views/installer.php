<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/hinato/assets/img/favicon.png">
  <link rel="stylesheet" href="/hinato/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/hinato/assets/css/main.css">
  <title>Installer</title>
</head>
<body style="background-color:#24292E;">
  <div class="container">
	  <div class="row">
      <div class="col-xs-12">
        <img src="/hinato/assets/img/logo.png" alt="HINATO" class="img-responsive" style="max-height:50px;margin:10px auto;">
        <h2 style="color:#F5F5F5;" class="text-center">Web-app installer</h2>
      </div>
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
         <form style="margin-top:30px;" action="admin/installer" method="post">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-cloud"></span></div>
                <input type="text" class="form-control" name="hostname" placeholder="database hostname or IP" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <input type="text" class="form-control" name="username" placeholder="database user" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input type="password" class="form-control" name="password" placeholder="database password">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-hdd"></span></div>
                <input type="text" class="form-control" name="database" placeholder="database name" required="required">
              </div>
            </div>
            <div class="form-group environment-radio">
              <div>
                <input type="checkbox" name="installDB" id="installDB" value="yes"><label for="installDB"> Install database</label>
              </div>
              <p>Choose environment for this installation:</p>
              <div>
                <input type="radio" name="environment" id="Production" value="production" checked="checked"><label for="Production"> Production</label>
              </div>
              <div>
                <input type="radio" name="environment" id="Testing" value="testing"><label for="Testing"> Testing</label>
              </div>
              <div>
                <input type="radio" name="environment" id="Development" value="development"><label for="Development"> Development</label>
              </div>
            </div>
            <input type="hidden" name="dbprefix" value="">
            <button type="submit" class="btn btn-primary col-xs-12">Submit</button>
        </form>
    </div>
  </div>
  </div>
</body>
</html>
