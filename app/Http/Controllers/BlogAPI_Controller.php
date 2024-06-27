<?php

namespace App\Http\Controllers;

use App\Models\BlogExtraModel;
use App\Models\BlogModel;
use App\Models\ClientsModel;
use Illuminate\Http\Request;

class BlogAPI_Controller extends Controller
{
    public function all_blog($api)
    {
        $client = ClientsModel::where('api_key', $api)->first();

        if ($client) {
            if ($client->status == 1) {

                $allBlogs = BlogModel::where('client_api_key', $api)
                    ->Where('client_id', $client->id)
                    ->get();

                // Filter blogs where status is 1
                $activeBlogs = $allBlogs->filter(function ($blog) {
                    return $blog->status == 1;
                });

                if ($activeBlogs->isNotEmpty()) {
                    return response()->json($activeBlogs);
                } else {
                    return response()->json([
                        'error' => 'No active blogs found',
                        'status' => 'No active blogs',
                        'message' => 'No blogs with an active status were found for this client',
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Your account is not active',
                    'status' => 'Status is not active by admin',
                    'message' => 'Please contact your admin!',
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Invalid API key',
                'status' => 'Invalid API key',
                'message' => 'Please check your API key',
            ]);
        }
    }

    public function single_blog($api, $blogID)
    {
        $client = ClientsModel::where('api_key', $api)->first();

        if (!$client) {
            return response()->json([
                'error' => 'Invalid API key',
                'status' => 'Invalid API key',
                'message' => 'Please check your API key',
            ], 401);
        }

        if ($client->status != 1) {
            return response()->json([
                'error' => 'Your account is not active',
                'status' => 'Status is not active by admin',
                'message' => 'Please contact your admin!',
            ], 403);
        }

        $blog = BlogModel::where('id', $blogID)
                         ->where('status', '1')
                         ->where(function ($query) use ($api, $client) {
                             $query->where('client_api_key', $api)
                                   ->orWhere('client_id', $client->id);
                         })
                         ->first();

        if (!$blog) {
            return response()->json([
                'error' => 'Blog not found or not active',
                'status' => 'Blog not found or inactive',
                'message' => 'The requested blog is either not found or inactive',
            ], 404);
        }

        $extraData = BlogExtraModel::where('blog_id', $blog->id)->get();

        return response()->json([
            'blog' => $blog,
            'extra_data' => $extraData,
        ]);
    }

}
