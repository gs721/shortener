<?php


namespace App\Services;


use App\Models\Link;
use Hashids\Hashids;

class ShortenerService
{
    private Hashids $hashids;

    private int $hashLength = 6;

    /**
     * ShortenerService constructor.
     */
    public function __construct()
    {
        $this->hashids = new Hashids(config('app.key'), $this->hashLength);
    }

    public function getShortUrl(string $url): string
    {
        $link = Link::where('url', $url)->first();
        if (!$link) {
            $link = Link::create(['url' => $url]);
        }
        $hash = $this->hashids->encode($link->id);
        return url('/') . '/' . $hash;
    }

    public function getOriginalUrl(string $hash): string
    {
        $id = $this->hashids->decode($hash);
        if (count($id) > 0) {
            $link = Link::where('id', $id[0])->first();
            if ($link) {
                return $link->url;
            }
        }
        throw new \Exception('link not found');
    }
}
