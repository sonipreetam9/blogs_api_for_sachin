<?php

namespace App\Http\Controllers;

use App\Models\BlogExtraModel;
use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function client_add_blog_page()
    {
        $active = "add-blog";
        return view('client.add_blog_page', compact('active'));
    }
    public function client_add_blog_post(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url_link' => 'required',
            'short_about' => 'required',
            'blog_seo_title' => 'required',
            'blog_seo_description' => 'required',
            'date' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,svg,webp,png|max:2080',
        ]);
        $client_id = auth()->guard('client')->id();
        $client = auth()->guard('client')->user();
        $api_key = $client->api_key;
        $target_dir = 'uploads/Blog Thumbnail';
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($target_dir), $fileName);
        $storePath = '/' . $target_dir . '/' . $fileName;
        BlogModel::create([
            'title' => $request->title,
            'url_link' => $request->url_link,
            'short_about' => $request->short_about,
            'blog_seo_title' => $request->blog_seo_title,
            'blog_seo_description' => $request->blog_seo_description,
            'date' => $request->date,
            'file' => $storePath,
            'client_id' => $client_id,
            'client_api_key' => $api_key,
        ]);

        return redirect()->back()->with('success', 'Blog added successfully');
    }

    public function client_all_blog_page()
    {
        $client = auth()->guard('client')->user();
        $blogs = BlogModel::where('client_id', $client->id)->get();
        $active = "blog-list";
        return view('client.all_blog_list', compact('blogs', 'active'));
    }
    public function client_delete_blog($blogId)
    {
        $blog = BlogModel::findOrFail($blogId);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            $blog->delete();
            return redirect()->back()->with('success', 'Blog deleted successfully');
        }
        return redirect()->back()->with('error', 'You are not authorized to delete this blog');
    }
    public function client_edit_blog_page($blogId)
    {
        $blog = BlogModel::findOrFail($blogId);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            $active = "blog-list";
            return view('client.edit_blog_page', compact('blog', 'active'));
        }
        return redirect()->back()->with('error', 'You are not authorized to edit this blog');
    }
    public function client_edit_blog_post(Request $request)
    {
        $blog = BlogModel::findOrFail($request->blog_id);
        $client = auth()->guard('client')->user();
        $status = 0;
        if ($request->status == "on") {
            $status = 1;
        }
        if ($blog->client_id == $client->id) {
            $this->validate($request, [
                'title' => 'required',
                'url_link' => 'required',
                'short_about' => 'required',
                'blog_seo_title' => 'required',
                'blog_seo_description' => 'required',
                'date' => 'required',
                'file' => 'nullable|file|mimes:jpg,jpeg,svg,webp,png|max:2080',
            ]);
            // dd($request->all());
            if ($request->hasFile('file')) {
                $target_dir = 'uploads/Blog Thumbnail';
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($target_dir), $fileName);
                $storePath = '/' . $target_dir . '/' . $fileName;
                $blog->update([
                    'title' => $request->title,
                    'url_link' => $request->url_link,
                    'short_about' => $request->short_about,
                    'blog_seo_title' => $request->blog_seo_title,
                    'blog_seo_description' => $request->blog_seo_description,
                    'date' => $request->date,
                    'file' => $storePath,
                    'status' => $status
                ]);
            } else {
                $blog->update([
                    'title' => $request->title,
                    'url_link' => $request->url_link,
                    'short_about' => $request->short_about,
                    'blog_seo_title' => $request->blog_seo_title,
                    'blog_seo_description' => $request->blog_seo_description,
                    'date' => $request->date,
                    'status' => $status,
                ]);
            }
            return redirect()->back()->with('success', 'Blog updated successfully');
        }
        return redirect()->back()->with('error', 'You are not authorized to edit this blog');
    }
    public function client_add_blog_data_page($id)
    {
        $blog = BlogModel::findOrFail($id);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            $active = "blog-list";
            $extraBlogs = BlogExtraModel::where('blog_id', $id)->get();
            return view('client.add_blog_extra_data', compact('id', 'active','extraBlogs'));
        } else {

            return redirect()->back()->with('error', 'You are not authorized to edit this blog');
        }
    }
    public function client_add_blog_data_post(Request $request)
    {
        $this->validate($request, [
            'blog_id' => 'required',
            'heading' => 'required',
            'data' => 'required',
        ]);
        $encode_data = base64_encode($request->data);

        $blog = BlogModel::findOrFail($request->blog_id);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            BlogExtraModel::create([
                'blog_id' => $request->blog_id,
                'heading' => $request->heading,
                'bdata' => $encode_data,
            ]);
            return redirect()->back()->with('success', 'Blog data added successfully');
        }
        return redirect()->back()->with('error', 'You are not authorized to add this blog data');
    }
    public function client_delete_blog_data_post(Request $request){

        $blog = BlogModel::findOrFail($request->blog_id);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            BlogExtraModel::findOrFail($request->id)->delete();
            return redirect()->back()->with('success-deleted', 'Blog data deleted successfully');
        }
        return redirect()->back()->with('error', 'You are not authorized to delete this blog data');
    }
    public function client_edit_blog_data_page($blog_id,$id){
        $blog = BlogModel::findOrFail($blog_id);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            $blogData=BlogExtraModel::findOrFail($id);
            $active = "blog-list";
            return view('client.edit_blog_data',compact('blogData','blog_id','active'));
        }else{
            return redirect()->back()->with('error', 'You are not authorized to edit this blog data');
        }
    }
    public function client_edit_blog_data_post(Request $request){
        $blog = BlogModel::findOrFail($request->blog_id);
        $client = auth()->guard('client')->user();
        if ($blog->client_id == $client->id) {
            // dd($request->all());
            $this->validate($request, [
                'blog_id' => 'required',
                'heading' => 'required',
                'data' => 'required',
            ]);
            $encode_data = base64_encode($request->data);
            BlogExtraModel::findOrFail($request->id)->update([
                'heading'=> $request->heading,
                'bdata'=> $encode_data,
            ]);
            return redirect()->back()->with('success', 'Blog data updated successfully');
        }
        return redirect()->back()->with('error', 'You are not authorized to edit this blog data');
    }
}
