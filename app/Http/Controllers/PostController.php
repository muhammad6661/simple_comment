<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::first();
        $posts = Post::latest()->paginate(8);
        // dd($posts) ;
        return view('front.post.index', compact('posts'));
    }
    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::user()->id)->latest()->paginate(8);
        return view('front.post.myposts', compact('posts'));
    }
    public function createPost()
    {
        return view('front.post.create');
    }

    public function storePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:5120',
        ]);
        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $item) {
                $message .= '<p style="text-align: left">' . $item . '</p>';
            }
            return response()->json(['status' => 0, 'message' => $message]);
        }
        $input = $request->all();
        $file = $request->file('image');
        $name = time() . '' . uniqid(64) . '.' . $file->getClientOriginalExtension();
        $file->move('public/uploads/posts', $name);
        $input['image'] = $name;
        $input['user_id'] = Auth::user()->id;
        Post::create($input);
        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function editPost($id)
    {
        $post = Post::where(['user_id' => Auth::user()->id, 'id' => $id])->firstOrFail();
        return view('front.post.edit', compact('post'));
    }
    public function updatePost(Request $request, $id)
    {
        $post = Post::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        if (is_null($post)) {
            return response()->json(['status' => 0, 'message' => 'Not found']);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            $message = "";
            foreach ($validator->errors()->all() as $item) {
                $message .= '<p style="text-align: left">' . $item . '</p>';
            }
            return response()->json(['status' => 0, 'message' => $message]);
        }
        $input = $request->all();

        if (isset($input['image']) && $input['image'] != "") {
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,svg|max:5120',
            ]);
            if ($validator->fails()) {
                $message = "";
                foreach ($validator->errors()->all() as $item) {
                    $message .= '<p style="text-align: left">' . $item . '</p>';
                }
                return response()->json(['status' => 0, 'message' => $message]);
            }
            $file = $request->file('image');
            $name = time() . '' . uniqid(64) . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/posts', $name);
            if (file_exists('public/uploads/posts/' . $post->image)) {
                unlink('public/uploads/posts/' . $post->image);
            }
            $input['image'] = $name;
        } else {
            unset($input['image']);
        }
        $post->update($input);
        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function deletePost($id)
    {
        $post = Post::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail();
        $post->comments()->delete();
        if (file_exists('public/uploads/posts' . $post->image)) {
            unlink('public/uploads/posts/' . $post->image);
        }
        $post->delete();
        return redirect()->back();
    }

    public function detailPost($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->latest()->take(3)->get();
        $qnt = count(Comment::where('post_id', $id)->get());
        $comments_sliter = Comment::where('post_id', $post->id)->inRandomOrder()->limit(5)->get();
        return view('front.post.detail', compact('post', 'comments', 'qnt', 'comments_sliter'));
    }

    public function addComment(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'error']);
        }
        $input['user_id'] = Auth::user()->id;
        $comment = Comment::create($input);
        $html  = View::make('front.post._comment', compact('comment'))->render();
        return response()->json(['status' => 1, 'html' => $html]);
    }

    public function updateComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'error']);
        }
        $comment = Comment::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        if (is_null($comment)) {
            return response()->json(['status' => 0, 'message' => 'error']);
        }
        $comment->content = $request->get('content');
        $comment->save();
        return response()->json(['status' => 1, 'text' => $comment->content]);
    }

    public function deleteComment($id)
    {
        $comment = Comment::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        if ($comment) {
            $comment->delete();
            return response()->json(['status' => 'success', 'message' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'error']);
    }

    public function moreComment($post_id, $offset)
    {
        $comments = Comment::where('post_id', $post_id)->latest()->skip(($offset - 1) * 3)->take(3)->get();
        $next = Comment::where('post_id', $post_id)->latest()->skip(($offset) * 3)->take(3)->get();
        $html = View::make('front.post._more_comment', compact('comments'))->render();
        $offset++;
        return response()->json(['status' => 1, 'html' => $html, 'offset' => $offset, 'next' => count($next)]);
    }

    public function searchUserByLogin($login, $post_id)
    {
        $user_ids = (new Comment())->select('user_id')->where('post_id', $post_id)->get();
        $ids = [];
        foreach ($user_ids as $item) {
            $ids[] = $item->user_id;
        }
        $users = User::whereIn('id', $ids)->where('login', 'Like', '%' . trim($login) . '%')->get();
        $html = '';
        foreach ($users as $item) {
            $html .= '<li> <a>' . $item->login . '</a> </li>';
        }
        return response()->json(['status' => 1, 'html' => $html, 'count_login' => count($users)]);
    }

    public function filterCommentByUserlogin($login, $post_id, $offset)
    {
        $users = User::where('login', 'Like', '%' . trim($login) . '%')->get();
        if (is_null($users)) {
            return response()->json(['status' => 0, 'message' => 'error']);
        }
        $ids = [];
        foreach ($users as $item) {
            $ids[] = $item->id;
        }
        $comments = Comment::WhereIn('user_id', $ids)->where('post_id', $post_id)->skip(($offset  - 1) * 3)->latest()->take(3)->get();
        $next = Comment::WhereIn('user_id', $ids)->where('post_id', $post_id)->skip(($offset) * 3)->latest()->take(3)->get();
        $html = View::make('front.post._more_comment', compact('comments'))->render();
        $offset++;
        return response()->json(['status' => 1, 'html' => $html, 'offset' => $offset, 'next' => count($next)]);
    }

    public function filterCommentByDateAscOrDesc($post_id, $offset, $filterBy)
    {
        $comments = Comment::where('post_id', $post_id)->orderBy('created_at', $filterBy)->skip(($offset - 1) * 3)->take(3)->get();
        $next = Comment::where('post_id', $post_id)->orderBy('created_at', $filterBy)->skip($offset * 3)->take(3)->get();
        $html = View::make('front.post._more_comment', compact('comments'))->render();
        $offset++;
        return response()->json(['status' => 1, 'html' => $html, 'offset' => $offset, 'next' => count($next)]);
    }
}
