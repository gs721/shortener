<?php

namespace App\Http\Controllers;

use App\Services\ShortenerService;

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


    public function index()
    {
        return view('shortener');
    }

    public function redirect(string $hash)
    {
        $url = $this->shortenerService->getOriginalUrl($hash);
        return redirect($url);
    }
}
