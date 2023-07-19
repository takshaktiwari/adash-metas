<?php

namespace Takshak\Ametas\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Takshak\Ametas\Actions\MetatagAction;
use Takshak\Ametas\Models\Metatag;

class MetatagController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('global')) {
            $globalTags = Metatag::whereNull('url')->first();
            if($globalTags) {
                return redirect()->route('admin.metatags.show', [$globalTags]);
            } else {
                return redirect()->route('admin.metatags.create', ['global' => 1]);
            }
        }

        $metatags = Metatag::whereNotNull('url')->select('id', 'url')->paginate(50);

        return View::first(['admin.metatags.index', 'ametas::admin.metatags.index'])
            ->with([
                'metatags'   =>  $metatags
            ]);
    }

    public function create()
    {
        return View::first(['admin.metatags.create', 'ametas::admin.metatags.create']);
    }

    public function store(Request $request, MetatagAction $action)
    {
        $request->validate([
            'url'       =>  'nullable|required_without:global|url|unique:metatags,url',
            'tags'      =>  'required|array|min:1',
            'contents'  =>  'required|array|min:1',
        ]);

        $metatag = $action->save($request);
        cache()->forget('metatags');
        return redirect()->route('admin.metatags.show', [$metatag])->withSuccess('SUCCESS !! New Metatag is successfully generated.');
    }

    public function show(Metatag $metatag)
    {
        return View::first(['admin.metatags.show', 'ametas::admin.metatags.show'])->with(['metatag' => $metatag]);
    }

    public function edit(Metatag $metatag)
    {
        return View::first(['admin.metatags.edit', 'ametas::admin.metatags.edit'])->with(['metatag' => $metatag]);
    }

    public function update(Request $request, Metatag $metatag, MetatagAction $action)
    {
        $request->validate([
            'url'       =>  'nullable|required_without:global|url|unique:metatags,url,'.$metatag->id,
            'tags'      =>  'required|array|min:1',
            'contents'  =>  'required|array|min:1',
        ]);
        $metatag = $action->save($request);
        cache()->forget('metatags');
        return redirect()->route('admin.metatags.show', [$metatag])->withSuccess('SUCCESS !! Metatag is successfully updated.');
    }

    public function destroy(Metatag $metatag)
    {
        $metatag->delete();
        cache()->forget('metatags');
        return redirect()->route('admin.metatags.index')->withSuccess('SUCCESS !! Metatag is successfully deleted.');
    }
}
