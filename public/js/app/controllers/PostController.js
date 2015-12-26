(function() {
  
  'use strict';

  angular
    .module('blogApp')
    .controller('PostController', ['$scope', '$uibModal', 'PostService', PostController])

    function PostController($scope, $uibModal, PostService) {
      var vm = this;
      vm.messageList = PostService.query();
      vm.message = '';

      vm.postMessage = function() {
        if (vm.message.trim() == '') return;

        var post = new PostService;
        post.user_id = 1;
        post.message = vm.message;
        post.$save();

        vm.messageList = PostService.query();
        vm.message = '';
      }

      vm.deletePost = function(id) {
        if (confirm('Are you sure you want to delete this post?')) {
          vm.post = PostService.get({ id: id }, function() {
            vm.post.message = $scope.message;
            vm.post.$delete(function(response) {
              vm.messageList = PostService.query();
              alert(response.message);
            });
          });
        }
      };

      $scope.animationsEnabled = true;

      vm.showEditPostModal = function(id, message) {
        var postObject = {
          id: id,
          message: message
        };
        var modalInstance = $uibModal.open({
          animation: $scope.animationsEnabled,
          templateUrl: 'editPostModal.html',
          controller: ModalInstanceCtrl,
          size: 'lg',
          resolve: {
            post: function () {
              return postObject;
            }
          }
        });

        modalInstance.result.then(function () {
        }, function () {
        });
      };

      $scope.toggleAnimation = function () {
        $scope.animationsEnabled = !$scope.animationsEnabled;
      };

      function ModalInstanceCtrl($scope, $uibModalInstance, post, PostService) {
        $scope.id = post.id;
        $scope.message = post.message;

        $scope.ok = function () {
          $scope.post = PostService.get({ id: post.id }, function() {
            $scope.post.message = $scope.message;
            $scope.post.$update(function(response) {
              vm.messageList = PostService.query();
              alert(response.message);
            });  
          });
          $uibModalInstance.close();
        };

        $scope.cancel = function () {
          $uibModalInstance.dismiss('cancel');
        };
      }

    } // end of PostController

})();