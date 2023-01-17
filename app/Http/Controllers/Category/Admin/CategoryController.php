<?php

namespace App\Http\Controllers\Category\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAdminRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Category;
use App\Services\Grid\Grid;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $ids;

    /**
     * @var Category
     */
    private $record;

    public function __construct()
    {
        if($this->id = Router::getParam('id'))
        {
            $this->record = Category::findOrFail($this->id);
        }
        if($ids = Router::getParam('ids'))
        {
            $this->ids = explode(',', $ids);
        }

        $this->breadcrumb();
    }

    public function index()
    {
        $data = [
            'route_items' => route('admin.category.items'),
            'route_index' => route('admin.category.index'),
        ];

        return view('categories._self.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = Category::query();

        $records = $grid->items($records);

        $records['rows'] = $records['rows']->each(function ($item) {
            $item->created_at_farsi = jdate($item->created_at)->format('Y/m/d');
        });

        return $records;
    }


    public function create()
    {
        $data = [
            'form' => [
                'method' => 'post',
                'action' => route('admin.category.store'),
            ],
        ];

        return view('categories._self.admin.form', $data);
    }


    public function store(CategoryAdminRequest $request)
    {
        return DB::transaction(function () use ($request) {

            Category::create($request->all());

            return new SuccessResponse();
        });
    }


    public function show()
    {
        $data = [
            'record' => $this->record,
        ];

        return view('categories._self.admin.show', $data);
    }


    public function edit()
    {
        $data = [
            'record' => $this->record,
            'form' => [
                'method' => 'put',
                'action' => route('admin.category.update', $this->id),
            ],
        ];

        return view('categories._self.admin.form', $data);
    }


    public function update(CategoryAdminRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $this->record->update($request->all());

            return new SuccessResponse();
        });
    }


    public function softDelete()
    {
        return DB::transaction(function () {

            Category::withTrashed()->whereIn('id', $this->ids)->delete();

            return new SuccessResponse('ok');
        });
    }


    public function forceDelete()
    {
        Category::withTrashed()->whereIn('id', $this->ids)->forceDelete();

        return new SuccessResponse('ok');
    }

    /**
     * Set breadcrumb.
     */
    private function breadcrumb()
    {
        $action = Router::actionName();

        $breadcrumb = [
            [
                'title' => 'دسته‌بندی‌‌ها',
                'link' => '#',
            ],
            [
                'title' => 'فهرست دسته‌بندی‌‌ها',
                'link' => route('admin.category.index'),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف دسته‌بندی جدید',
                    'link' => route('admin.category.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده دسته‌بندی',
                    'link' => route('admin.category.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده دسته‌بندی',
                    'link' => route('admin.category.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.category.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
