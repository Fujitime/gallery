<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $comments = Comment::latest()->paginate(5);
        } else {
            $comments = $user->comments()->latest()->paginate(5);
        }
        return view('dashboard.comments.action', compact('comments'));
    }

    public function store(Request $request, Gallery $gallery)
    {
        $request->validate([
            'content' => 'required|string|max:255', // Limit content length
        ], [
            'content.required' => 'The comment content must be filled in.',
            'content.max' => 'The comment content cannot exceed :max characters.',
        ]);

        try {
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->gallery_id = $gallery->id;
            $comment->content = $request->input('content');
            $comment->save();
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to add comment. Please try again later.');
        }

        return Redirect::back()->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment)
    {
        $gallery = $comment->gallery; // Get the gallery associated with the comment
        // Ensure the user has permission to edit the comment
        if (Auth::user()->role === 'admin' || $comment->user_id === Auth::id()) {
            return view('dashboard.comments.edit', compact('comment', 'gallery'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function update(Request $request, Comment $comment)
    {
        // Ensure the user has permission to update the comment
        if (Auth::user()->role === 'admin' || $comment->user_id === Auth::id()) {
            $request->validate([
                'content' => 'required|string|max:255', // Limit content length
            ], [
                'content.required' => 'The comment content must be filled in.',
                'content.max' => 'The comment content cannot exceed :max characters.',
            ]);

            try {
                $comment->update([
                    'content' => $request->input('content'),
                ]);
            } catch (\Exception $e) {
                return Redirect::back()->with('error', 'Failed to update comment. Please try again later.');
            }

            return redirect()->route('comments.action')->with('success', 'Comment updated successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function destroy(Comment $comment)
    {
        // Ensure the user has permission to delete the comment
        if (Auth::user()->role === 'admin' || $comment->user_id === Auth::id()) {
            try {
                $comment->delete();
            } catch (\Exception $e) {
                return Redirect::back()->with('error', 'Failed to delete comment. Please try again later.');
            }

            return Redirect::back()->with('success', 'Comment deleted successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
