<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Jobs\StorePost;
use App\Jobs\UpdatePost;

use Auth;
use Validator;

class PostController extends Controller {   

    public function loggedUser() {
        return Auth::user();
    } 
    
    public function index() {
        return Post::with('user')->get();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), Post::$rules);
        if ($validator->fails()) {
            $result['message'] = $validator->errors()->all();
            return json_encode($result);
        }       
        $this->dispatch(new StorePost(Auth::user()->id, $request->title, $request->message));
    }

    public function show($id) {   
        return Post::findOrFail($id);        
    }

    public function update(Request $request, $id) {
    	$post = Post::findOrFail($id);
    	$this->dispatch(new UpdatePost($post, Auth::user()->id, $request->title, $request->message));
    }

    public function destroy($id) {
    	$post = Post::findOrFail($id);
        $post = Post::destroy($id);
    }

    public function showEditDialog() {
        return view('modals.showEditDialog');
    }

}
