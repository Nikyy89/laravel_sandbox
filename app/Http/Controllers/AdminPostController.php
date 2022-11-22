<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\System_logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class AdminPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['roles:admin']);
    }

    public function index(Request $request, Posts $post = null){
        $user = Auth::user();

        if (!isset($post)) {
            /*
               $posts = Posts::paginate(50);
               return view('admin.hirek.index', compact('posts'));
            */

            $posts = $user->posts()->get();

            // Add log in database
            System_logs::addToLog('web', 'Admin menüpont felülete', 'AdminPostController', 'View');

            return view('admin.hirek.index',compact('posts', 'user'));
        } else {
            return view('admin.hirek.edit', ['post' => $post]);
        }
    }

    public function view_new_post(){
        return view('admin.hirek.create');
    }

    public function create_new_post(Request $request){
        $user_id = auth()->user()->id;
        //if (Auth::user()->hasPermissionTo('post_create')) {
        if(auth()->user()->permissions[0]->name == 'post_create'){
            $new_post = Posts::create([
                'user_id' => $user_id,
                'title' => $request['title'],
                'content' => $request['content']
            ]);
        }

        // Add log in database
        System_logs::addToLog('web', 'Új hír készítése', 'AdminPostController', 'CreateNewPost');

        return redirect()->route('admin.hirek.index')->with('success', 'Your post has been created');
    }

    public function edit(Request $request, Posts $post){
        //if (Auth::user()->hasPermissionTo('post_update')) {
        if(auth()->user()->permissions[1]->name == 'post_update'){
            $post->title = $request['title'];
            $post->content = $request['content'];
            $post->save();
        }

        // Add log in database
        System_logs::addToLog('web', 'Hír szerkesztése', 'AdminPostController', 'EditPost');

        return redirect(route('admin.hirek.index'))->with('message','Posts Updated');
    }

    public function delete(Posts $post) {
        // Add log in database
        System_logs::addToLog('web', 'Hír törlése', 'AdminPostController', 'DeletePost');

        //if (Auth::user()->hasPermissionTo('post_delete')) {
            if(auth()->user()->permissions[2]->name == 'post_delete'){
            $post->delete();

            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Permission denied!'
            ]);
        }
    }
}
