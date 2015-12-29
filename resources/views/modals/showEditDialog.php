<md-dialog aria-label="Edit Post" ng-cloak>
  <form ng-controller="PostController as ps">
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Edit Post</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="cancel()" aria-label="CloseModal">
          <md-icon>close</md-icon>
        </md-button>
      </div>
    </md-toolbar>
    <md-dialog-content>
      <div class="md-dialog-content">
        <md-input-container class="md-block">
          <label>Title</label>
          <input name="title" ng-model="post.title">
        </md-input-container>
        <md-input-container class="md-block">
          <label>Content...</label>
          <textarea name="message" ng-model="post.message"></textarea>
        </md-input-container>
      </div>
    </md-dialog-content>
    <md-dialog-actions layout="row">
      <span flex></span>
      <md-button ng-click="cancel()">
       Cancel
      </md-button>
      <md-button ng-click="answer()" style="margin-right:20px;">
        Save
      </md-button>
    </md-dialog-actions>
  </form>
</md-dialog>

