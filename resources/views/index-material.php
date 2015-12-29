<!DOCTYPE html>
<html>
<head>
  <title>BlogNow</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="bower_components/angular-material/angular-material.css">
  <link rel="stylesheet" href="css/style.css"></head>
<body ng-app="blogApp">

  <md-toolbar class="md-whiteframe-1dp" layout="row" layout-wrap layout-align="space-between center" ng-controller="PostController as ps">
    <md-button class="navbar-brand" href="/">BlogNow</md-button>
    <p>Welcome {{ ps.user.name }}</p>
    <md-button href="/logout">Logout</md-button>
  </md-toolbar> 

  <div layout-gt-sm="row" layout-padding layout-align="center start"
    ng-controller="PostController as ps"
    > 
    <div>
      <div id="main-content" >
        <md-card layout="column" layout-padding>
          <span class="md-title">New Post</span>
          <md-input-container class="md-block">
            <label>Title</label>
            <input name="title" ng-model="ps.title">
          </md-input-container>
          <md-input-container class="md-block">
            <label>Content...</label>
            <textarea name="message" ng-model="ps.message"></textarea>
          </md-input-container>
          <div layout="row" layout-align="end end">
            <md-button class="md-raised md-primary" ng-click="ps.postMessage($event)">Post</md-button>  
          </div>
        </md-card>

        <div id="message-list">
          <md-card ng-repeat="post in ps.messageList | orderBy: '-id' | filter: ps.searchPost ">
            <md-card-title layout="row" layout-align="space-between start" layout-padding>
              <md-card-title-text>
                <div layout="row" layout-align="start center">
                  <span class="md-title">{{ post.title }}</span>
                  <md-button ng-show="ps.user.id == post.user_id" class="md-icon-button" ng-click="ps.showEditPost($event, post)" aria-label="CloseModal">
                    <md-icon>edit</md-icon>
                  </md-button>
                </div>
                <span class="md-subhead">by {{ post.user.name }}</span>
                <span class="md-subhead">Posted on {{ ps.formatDate(post.created_at) | date:'medium' }}</span>
                <p>{{ post.message }}</p>
              </md-card-title-text>
              <div>
                <md-button ng-show="ps.user.id == post.user_id" class="md-icon-button" ng-click="ps.deletePost($event, post.id)" aria-label="CloseModal">
                  <md-icon>close</md-icon>
                </md-button>
              </div>
            </md-card-title>
          </md-card>
        </div>

      </div>
    </div>

    <div>
      <md-card layout="column" layout-padding>
        <md-input-container class="md-block">
          <label>Search Post</label>
          <input name="title" ng-model="ps.searchPost">
        </md-input-container>
      </md-card>
    </div>
  </div>

  <!-- Angular Dependencies -->
  <script src="bower_components/angular/angular.js"></script>
  <script src="bower_components/angular-resource/angular-resource.js"></script>
  <script src="bower_components/angular-animate/angular-animate.js"></script>
  <script src="bower_components/angular-aria/angular-aria.js"></script>
  <script src="bower_components/angular-material/angular-material.js"></script>

  <!-- Application -->
  <script src="js/app/app.js"></script>
  <script src="js/app/services/PostService.js"></script>
  <script src="js/app/services/UserService.js"></script>
  <script src="js/app/controllers/PostController.js"></script>

</body>
</html>