<!DOCTYPE html>
<html>
<head>
  <title>BlogNow</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
</head>
<body ng-app="blogApp">
  <div>
    <nav id="top-nav" class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">BlogNow</a>
        </div>

        <div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/logout">Logout</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav> 


    <div id="main-content" ng-controller="PostController as ps">
      <h4>Post Message:</h4>
      <div class="row">
        <div id="post-message">
          <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" ng-click="ps.postMessage()">Post</button>
            </span>
            <input type="text" ng-model="ps.message" class="form-control" placeholder="message...">
          </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->

      <div id="message-list">
        <div class="panel panel-default" ng-repeat="post in ps.messageList | orderBy: '-id'">
          <div class="panel-heading">
            <div class="post-id">{{ post.id }}</div>
            <div class="post-date">
              {{ post.created_at }} 
              <button class="btn btn-warning" ng-click="ps.showEditPostModal(post.id, post.message)">Edit</button>
              <button class="btn btn-danger" ng-click="ps.deletePost(post.id)">Delete</button>
            </div>
          </div>
          <div class="panel-body">
            {{ post.message }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Angular Dependencies -->
  <script src="bower_components/angular/angular.js"></script>
  <script src="bower_components/angular-resource/angular-resource.js"></script>
  <script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>

  <!-- Application -->
  <script src="js/app/app.js"></script>
  <script src="js/app/services/PostService.js"></script>
  <script src="js/app/controllers/PostController.js"></script>



  <div ng-controller="PostController">
      <script type="text/ng-template" id="editPostModal.html">
          <div class="modal-header">
              <h3 class="modal-title">I'm a modal!</h3>
          </div>
          <div class="modal-body">
            <p>Id: {{ id }}</p>
            <div class="form-group">
              <label>Message:</label>
              <input type="text" ng-model="message" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" ng-click="ok()">Save</button>
              <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
          </div>
      </script>
  </div>



</body>
</html>