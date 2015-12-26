(function() {
  
  'use strict';

  angular
    .module('blogApp')
    .service('PostService', ['$resource', PostService])

    function PostService($resource) {
      return $resource('/api/post/:id', { id: '@id' }, {
        update: {
          method: 'PUT' 
        }
      });
    }

})();