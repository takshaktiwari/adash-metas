<?php

namespace Takshak\Ametas\View\Components\Ametas;

use Illuminate\View\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Takshak\Ametas\Models\Metatag;

class Metatags extends Component
{
    public $url;
    public $metatag;
    public function __construct($url = null, $tags = [])
    {
        $this->url = $url ? $url : url()->current();
        $metatags = cache()->rememberForever('metatags', function () {
            return Metatag::get();
        });


        $pageTags = $metatags->filter(function ($metatag) {
            return Str::of($metatag->url)->contains($this->url) ? true : false;
        })
            ->first();



        if (!$pageTags) {
            $pageTags = $metatags->filter(fn ($item) => $item->url == url('/'))->first();
        }

        $globalTags = $metatags->filter(fn ($item) => $item->url == null)->first()?->tags?->toArray();
        $this->metatag = $pageTags ? $pageTags?->tags?->toArray() : [];

        foreach ($globalTags as $gTag) {
            $hasTag = false;
            foreach ($this->metatag as $tag) {
                if($tag['name'] == $gTag['name']) {
                    $hasTag = true;
                    break;
                }
            }

            if(!$hasTag) {
                $this->metatag[] = $gTag;
            }
        }

        foreach ($tags as $name => $content) {
            $this->metatag[] = [
                'name' => $name,
                'content' => $content
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return View::first([
            'components.ametas.metatags',
            'ametas::components.ametas.metatags'
        ]);
    }
}
