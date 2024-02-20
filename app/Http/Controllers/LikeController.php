<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Gallery;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
        ]);

        // Get the current user's ID
        $userId = auth()->id();

        // Check if the user has already liked the gallery
        $existingLike = Like::where('gallery_id', $request->gallery_id)
                            ->where('user_id', $userId)
                            ->first();

        // If the user has already liked the gallery, delete the like (undo like)
        if($existingLike) {
            $existingLike->delete();
            $likesCount = Gallery::findOrFail($request->gallery_id)->likes()->count(); // Get updated likes count
            return response()->json(['success' => true, 'likesCount' => $likesCount, 'liked' => false]);
        }

        // Create a new like
        Like::create([
            'gallery_id' => $request->gallery_id,
            'user_id' => $userId,
        ]);

        // Get the updated likes count for the gallery
        $gallery = Gallery::findOrFail($request->gallery_id);
        $likesCount = $gallery->likes()->count();

        // Return JSON response with success status, updated likes count, and liked status
        return response()->json(['success' => true, 'likesCount' => $likesCount, 'liked' => true]);
    }


    public function sseLikes(Gallery $gallery)
    {
        // Set response type to SSE
        $response = new Response();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        // Keep the connection open
        while (true) {
            // Fetch updated likes count
            $likesCount = $gallery->likes()->count();

            // Send updated data
            echo "event: likesUpdate\n";
            echo "data: $likesCount\n\n";
            ob_flush();
            flush();

            // Sleep for a while before checking again
            sleep(5);
        }

        return $response;
    }


    public function destroy($id)
    {
        // Find and delete the like
        $like = Like::findOrFail($id);
        $like->delete();

        // Get the updated likes count for the gallery
        $gallery = $like->gallery;
        $likesCount = $gallery->likes()->count();

        // Return JSON response with success status and updated likes count
        return response()->json(['success' => true, 'likesCount' => $likesCount]);
    }
}
