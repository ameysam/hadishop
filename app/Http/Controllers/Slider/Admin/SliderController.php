<?php

namespace App\Http\Controllers\Slider\Admin;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderAdminRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Slider;
use App\Services\File\Src\FileSaveService;
use App\Services\Grid\Grid;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
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
     * @var Slider
     */
    private $record;

    public function __construct()
    {
        if($this->id = Router::getParam('id'))
        {
            $this->record = Slider::with('files')->findOrFail($this->id);
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
            'route_items' => route('admin.slider.items'),
            'route_index' => route('admin.slider.index'),
        ];

        return view('sliders._self.admin.index', $data);
    }


    public function items(Grid $grid)
    {
        $records = Slider::query();

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
                'action' => route('admin.slider.store'),
            ],
        ];

        return view('sliders._self.admin.form', $data);
    }


    public function store(SliderAdminRequest $request, FileSaveService $fileSaveService)
    {
        return DB::transaction(function () use ($request, $fileSaveService) {

            $record = Slider::create($request->all());

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
        if(!empty($this->record->files[0]))
        {
            $this->record->file = $this->record->files[0];
        }

        $data = [
            'record' => $this->record,
        ];

        return view('sliders._self.admin.show', $data);
    }


    public function edit()
    {
        if(!empty($this->record->files[0]))
        {
            $this->record->file = $this->record->files[0];
        }

        $data = [
            'record' => $this->record,
            'form' => [
                'method' => 'put',
                'action' => route('admin.slider.update', $this->id),
            ],
        ];

        return view('sliders._self.admin.form', $data);
    }


    public function update(SliderAdminRequest $request, FileSaveService $fileSaveService)
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


    public function forceDelete()
    {
        Slider::whereIn('id', $this->ids)->delete();

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
                'title' => 'اسلایدرها',
                'link' => '#',
            ],
            [
                'title' => 'فهرست اسلایدرها',
                'link' => route('admin.slider.index'),
            ],
        ];

        if($action == 'create')
        {
            $breadcrumb[] =
                [
                    'title' => 'تعریف اسلایدر جدید',
                    'link' => route('admin.slider.create'),
                ];
        }
        else if($action == 'show')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده اسلایدر',
                    'link' => route('admin.slider.show', $this->record->id),
                ];
        }
        else if($action == 'edit')
        {
            $breadcrumb[] =
                [
                    'title' => $this->record->name ? $this->record->name : 'مشاهده اسلایدر',
                    'link' => route('admin.slider.show', $this->record->id),
                ];
            $breadcrumb[] =
                [
                    'title' => 'ویرایش',
                    'link' => route('admin.slider.edit', $this->record->id),
                ];
        }
        $this->setBreadcrumb($breadcrumb);
    }
}
