<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BlogService;
use Illuminate\Support\Facades\Storage;

class ExportDataController extends Controller
{
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * This function creates a csv file from filtered Blog query
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return string $fileUrl
     */

    public function exportToCsv(Request $request)
    {
        $blogs  = $this->blogService->filteredBlogQuery($request);
        $blogs = $blogs->get();

        $filename = 'download-' . auth()->user()->username . '.csv';
        $columns = 'Blog ID,Title,Category,Comments count';

        Storage::disk('csv')->put($filename, $columns);

        foreach ($blogs as $value) {
            $content = $value->id . ',' . $value->title . ',' . $value->category->name . ',' .  $value->comments_count;
            Storage::disk('csv')->append($filename, $content);
        }

        return Storage::disk('csv')->url($filename);
    }
}
