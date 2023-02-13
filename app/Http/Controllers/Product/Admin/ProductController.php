<?php

namespace App\Http\Controllers\Product\Admin;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserActivationType;
use App\Constants\Types\User\UserGenderType;
use App\Constants\Types\User\UserRegisterStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductAdminRequest;
use App\Http\Requests\User\UserAdminRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Category;
use App\Models\Center;
use App\Models\CustomRole;
use App\Models\Product;
use App\Models\User;
use App\Services\Center\Admin\CenterService;
use App\Services\File\Src\FileSaveService;
use App\Services\Grid\Grid;
use App\Services\Province\Admin\ProvinceService;
use App\Services\User\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
     * @var Product
     */
    private $record;

    public function __construct()
    {
        if($this->id = Router::getParam('id'))
        {
            $this->record = Product::with('files')->findOrFail($this->id);
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
            'route_items' => route('admin.product.items'),
            'route_index' => route('admin.product.index'),
            'categories' => Category::getAllItemsForDropdown(),
        ];

        return view('products._self.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = Product::with('category');

        $records = $grid->items($records);

        $records['rows'] = $records['rows']->each(function ($item) {
            $item->price_fa = number_format($item->price);
            $item->suggest_farsi = $item->suggest_fa;
            $item->special_farsi = $item->special_fa;
            $item->created_at_farsi = jdate($item->created_at)->format('Y/m/d');
        });

        return $records;
    }


    public function create()
    {
        $data = [
            'form' => [
                'method' => 'post',
                'action' => route('admin.product.store'),
            ],
            'categories' => Category::get(),
        ];

        return view('products._self.admin.form', $data);
    }


    public function store(ProductAdminRequest $request, FileSaveService $fileSaveService)
    {
        return DB::transaction(function () use ($request, $fileSaveService) {

            $record = Product::create($request->all());

            # Upload append files.
            if($request->hasFile('file'))
            {
                $files = $request->file('file');

                $fileSaveService
                    ->setDestination('public')
                    ->setFileableRecord($record)
                    ->setUser($this->currentUser())
                    ->setUploader($this->currentUser())
                    ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                    ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                    ->save($files);
            }

            return new SuccessResponse();
        });
    }


    public function show()
    {
        // if(!empty($this->record->files[0]))
        // {
        //     $this->record->file = $this->record->files[0];
        // }

        $data = [
            'record' => $this->record,
        ];

        return view('products._self.admin.show', $data);
    }


    public function edit()
    {
        $data = [
            'record' => $this->record,
            'form' => [
                'method' => 'put',
                'action' => route('admin.product.update', $this->id),
            ],
            'categories' => Category::get(),
        ];

        return view('products._self.admin.form', $data);
    }


    public function update(ProductAdminRequest $request, FileSaveService $fileSaveService)
    {
        return DB::transaction(function () use ($request, $fileSaveService) {

            $this->record->update($request->all());

            # Upload append files.
            if($request->hasFile('file'))
            {
                $files = $request->file('file');

                $this->record->files()->delete();

                $fileSaveService
                    ->setDestination('public')
                    ->setFileableRecord($this->record)
                    ->setUser($this->currentUser())
                    ->setUploader($this->currentUser())
                    ->setReasonType(FileReasonType::FILE_REASON_LOGO)
                    ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_PUBLIC)
                    ->save($files);
            }
            else if($request['delete_photo'])
            {
                $this->record->files()->delete();
            }

            return new SuccessResponse();
        });
    }


    public function softDelete()
    {
        Product::withTrashed()->whereIn('id', $this->ids)->delete();

        return new SuccessResponse('ok');
    }


    public function forceDelete()
    {
        Product::withTrashed()->whereIn('id', $this->ids)->forceDelete();

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
                'title' => 'کالاها',
                'link' => '#',
            ],
            [
                'title' => 'فهرست کالاها',
                'link' => route('admin.product.index'),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف کالا جدید',
                    'link' => route('admin.product.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده کالا',
                    'link' => route('admin.product.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده کالا',
                    'link' => route('admin.product.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.product.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
