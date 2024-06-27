<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\WebsitePageContentModel;
use App\Models\WebsitePageModel;
use Illuminate\Http\Request;

class WebsitePageController extends Controller
{
    public function add_website_page($clientId)
    {
        $active = "";
        $client = ClientsModel::findOrFail($clientId);
        $pages = WebsitePageModel::where('client_id', $clientId)->get();
        $content = WebsitePageContentModel::whereIn('website_page_id', $pages->pluck('id'))->get();
        return view('admin.add_website_page', compact('client', 'active', 'pages', 'content'));
    }
    public function add_website_page_insert(Request $request, $clientId)
    {
        $this->validate($request, [
            'page_name' => 'required',
            'meta_title' => 'required',
            'meta_discription' => 'required',
            'meta_keywords' => 'required',
        ]);

        $client = ClientsModel::findOrFail($clientId);

        if ($client) {
            $page = new WebsitePageModel();
            $page->client_id = $clientId;
            $page->website_page_name = $request->page_name;

            if ($page->save()) {
                WebsitePageContentModel::create([
                    'website_page_id' => $page->id,
                    'meta_title' => $request->meta_title,
                    'meta_discription' => $request->meta_discription,
                    'meta_keywords' => $request->meta_keywords,
                ]);

                return redirect()->back()->with('success', 'Page and Content Added Successfully');
            }
        }

        return redirect()->back()->with('error', 'Something went wrong');

    }
    public function delete_page($pageId)
    {
        $page = WebsitePageModel::findOrFail($pageId);
        $page->delete();
        return redirect()->back()->with('success', 'Page Deleted Successfully');
    }

    public function edit_content_page($clientId,$pageId){
        $active = "";
        $page = WebsitePageModel::findOrFail($pageId);
        $client=ClientsModel::findOrFail($clientId);
        $content = WebsitePageContentModel::where('website_page_id', $pageId)->first();
        return view('admin.edit_website_page_content', compact('page', 'active', 'content','client'));
    }
    public function edit_content_page_post(Request $request ,$pageId){
        $this->validate($request, [
            'page_name' => 'required',
            'meta_title' => 'required',
            'meta_discription' => 'required',
            'meta_keywords' => 'required',
        ]);
        $status=0;
        if($request->status=="on"){
            $status=1;
        }
        $page=WebsitePageModel::findOrFail($pageId);

        $success=$page->update([
            'page_name' => $request->page_name,
            'status'=>$status,
        ]);
        if($success){
            $content = WebsitePageContentModel::where('website_page_id', $pageId)->first();
            $content->update([
                'meta_title' => $request->meta_title,
                'meta_discription' => $request->meta_discription,
                'meta_keywords' => $request->meta_keywords,
            ]);
            return redirect()->back()->with('success','Page Updated Successfully !');
        }
    }
}

