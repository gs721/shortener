<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\ShortenerService;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    private ShortenerService $shortenerService;

    /**
     * ShortenerController constructor.
     * @param ShortenerService $shortenerService
     */
    public function __construct(ShortenerService $shortenerService)
    {
        $this->shortenerService = $shortenerService;
    }


    public function create(Request $request)
    {
        $request->validate(['url' => 'required|max:255']);
        $url = $request->input('url');
        $shortUrl = $this->shortenerService->getShortUrl($url);
        return [
            'shortUrl' => $shortUrl,
        ];
    }
}
