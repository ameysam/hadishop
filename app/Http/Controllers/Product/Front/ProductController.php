<?php

namespace App\Http\Controllers\Product\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class ProductController extends Controller
{
    /**
     * @var int
     */
    private $id;

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
    }

    public function index()
    {
        $records = Product::with('category')->latest('id')->paginate(2);

        $data = [
            'records' => $records,
        ];

        return view('products._self.admin.index', $data);
    }

    public function show()
    {
        $data = [
            'record' => $this->record,
        ];

        return view('products._self.admin.show', $data);
    }
}
