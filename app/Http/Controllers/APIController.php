<?php

namespace App\Http\Controllers;

use App\Models\WebsitePageContentModel;
use App\Models\WebsitePageModel;
use Illuminate\Http\Request;
use App\Models\ClientsModel;

class APIController extends Controller
{
    public function get_api($apiLink, $pageName)
    {
        // Find the client by api_link
        $client = ClientsModel::where('api_link', $apiLink)->first();

        if ($client) {
            if ($client->status == 1) {
                $pages = WebsitePageModel::where('client_id', $client->id)->get();

                // Iterate through the pages to find the matching pageName
                foreach ($pages as $page) {
                    if ($page->website_page_name == $pageName) {
                        // Get the content associated with the page
                        $content = WebsitePageContentModel::where('website_page_id', $page->id)->first();

                        if ($content) {
                            // Return the required fields as plain text
                            return response("{$content->meta_discription}\n{$content->meta_title}\n{$content->meta_keywords}", 200)
                                ->header('Content-Type', 'text/plain');
                        } else {
                            // Return a plain text response if no content is found
                            return response('Content not found', 404)
                                ->header('Content-Type', 'text/plain');
                        }
                    }
                }

                // Return a plain text response if no matching page is found
                return response('Page not found', 404)
                    ->header('Content-Type', 'text/plain');
            }
        } else {
            return response('Client is active', 200)
                ->header('Content-Type', 'text/plain');
        }

    }
}

