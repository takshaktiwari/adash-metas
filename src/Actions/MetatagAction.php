<?php

namespace Takshak\Ametas\Actions;

use Takshak\Ametas\Models\Metatag;

class MetatagAction
{
    public function format($request)
    {
        $tags = [];
        foreach ($request->post('tags') as $key => $tag) {
            $tags[] = [
                'name'		=>	$tag,
                'content'	=>	isset($request->post('contents')[$key])
                                    ? $request->post('contents')[$key]
                                    : null
            ];
        }

        return $tags;
    }

    public function save($request)
    {
        return Metatag::updateOrCreate(
            ['url' => $request->post('url')],
            ['tags' => $this->format($request)]
        );
    }
}
