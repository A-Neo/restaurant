<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Service\PageService;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\Traits\HandlesSlidesDeletion;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    use HandlesSlidesDeletion;

    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function deleteSlide(Request $request)
    {
        $page = $this->pageService->getPageById($request->pageId);
        $image = Image::find($request->imageId);

        $this->pageService->deleteSlide($page, $image, $this->pageService->getImageService());
        return response()->json(['success' => 'Slide deleted successfully']);
    }

    public function onlyTrash()
    {
        $items = Page::onlyTrashed()->get();
        return view('admin.pages.trash', compact('items'));
    }

    public function restoreModel($id)
    {
        $item = Page::onlyTrashed()
            ->where('id', $id)
            ->first();

        $item->restore();
        return redirect()->route('admin.pages.index')->with('success', 'Страница восстановлена');
    }

    public function fullDelete($id)
    {
        $item = Page::find($id);
        $item->forceDelete();
        return redirect()->route('admin.pages.index')->with('success', 'Страница полностью удалена');
    }
    public function index()
    {
        $pages = $this->pageService->getAllPages();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(PageRequest $request)
    {
        $this->pageService->createPage($request->validated());
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page, $sliders = null)
    {
        if ($request->file('sliders')) {
            $sliders = $request->file('sliders');
            $request->request->remove('sliders');
        }

        $this->pageService->updatePage($page, $request->validated(), $sliders);
        return redirect()->route('admin.pages.index');
    }

    public function destroy(Page $page)
    {
        $this->pageService->deletePage($page);
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
