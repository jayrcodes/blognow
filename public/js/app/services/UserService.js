(function() {
  
  'use strict';

  angular
    .module('blogApp')
    .service('UserService', ['$http', UserService])

    function UserService($http) {
      var user = {};
      user.loggedUser = function() {
        return $http.get('/api/loggedUser');
      }
      return user;
    }

})();