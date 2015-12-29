(function() {
  
  'use strict';

  angular
    .module('blogApp')
    .controller('PostController', ['UserService', 'PostService', '$mdDialog', '$mdMedia', '$scope', PostController])

    function PostController(UserService, PostService, $mdDialog, $mdMedia, $scope) {
      var vm = this;
      vm.user = UserService.loggedUser().success(function(loggedUser){
        vm.user = loggedUser;
      });
      vm.messageList = PostService.query();
      vm.title = '';
      vm.message = '';
      vm.post = {};

      vm.formatDate = function(date) {
        return new Date(date.split("-").join("/"));
      }

      vm.postMessage = function(ev) {
        if (vm.title.trim() == '') return showDialog(ev, 'Warning', 'Please enter the title.', 'titleAlert', 'OK');
        if (vm.message.trim() == '') return showDialog(ev, 'Warning', 'Please enter the content.', 'contentAlert', 'OK');

        var post = new PostService;
        post.title = vm.title;
        post.message = vm.message;
        post.$save();

        vm.messageList = PostService.query();
        vm.message = '';
        vm.title = '';
      }

      vm.deletePost = function(ev, postId) {
        var confirm = confirmDialog(ev, 'Warning', 'Are you sure you want to delete this post?', 'deletePost', 'Yes', 'No');
        $mdDialog.show(confirm).then(function() {
          vm.post = PostService.get({ id: postId }, function() {
            vm.post.$delete(function(response) {
              vm.messageList = PostService.query();
            });
          });
        }, function() {
          console.log('Deletion cancelled.');
        }); 
      }

      vm.showEditPost = function(ev, post) {
        vm.post = post;
        var customDialog = showCustomDialog(ev, '/modals/showEditDialog');

        customDialog.then(function(answer) {
          
        }, function() {
          // Cancel
        });
      }

      function showDialog(ev, title, textContent, ariaLabel, okString) {
        $mdDialog.show(
          $mdDialog.alert()
            .parent(angular.element(document.querySelector('#popupContainer')))
            .clickOutsideToClose(false)
            .title(title)
            .textContent(textContent)
            .ariaLabel(ariaLabel)
            .ok(okString)
            .targetEvent(ev)
        );
      }

      function confirmDialog(ev, title, textContent, ariaLabel, okString, cancelString) {
        return $mdDialog.confirm()
          .title(title)
          .textContent(textContent)
          .ariaLabel(ariaLabel)
          .targetEvent(ev)
          .ok(okString)
          .cancel(cancelString);
      }

      function showCustomDialog(ev, templateUrl) {
        var useFullScreen = ($mdMedia('sm') || $mdMedia('xs'))  && $scope.customFullscreen;
            
        $scope.$watch(function() {
          return $mdMedia('xs') || $mdMedia('sm');
        }, function(wantsFullScreen) {
          $scope.customFullscreen = (wantsFullScreen === true);
        });

        return $mdDialog.show({
          controller: DialogController,
          templateUrl: templateUrl,
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose: false,
          fullscreen: useFullScreen
        });
      
      }

      function DialogController($scope, $mdDialog) {
        $scope.post = vm.post;

        $scope.hide = function() {
          $mdDialog.hide();
        };
        $scope.cancel = function() {
          vm.messageList = PostService.query();
          $mdDialog.cancel();
        };
        $scope.answer = function(answer) {
          vm.post = PostService.get({ id: vm.post.id }, function() {
            vm.post.title = $scope.post.title;
            vm.post.message = $scope.post.message;
            vm.post.$update(function(response) {
              vm.messageList = PostService.query();
            });  
          });

          $mdDialog.hide(answer);
        };
      }

    } // end of PostController

})();