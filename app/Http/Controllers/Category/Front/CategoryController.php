<?php

namespace App\Http\Controllers\Category\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Routing\Router;

class CategoryController extends Controller
{
    /**
     * @var int
     */
    private $id;

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
    }

    public function show()
    {
        $products = Product::with('category')->whereCategory($this->record)->orderAvailable()->latest('id')->paginate(12);

        // return
        $data = [
            'record' => $this->record,
            'products' => $products,
        ];

        return view('categories._self.front.show', $data);
    }
}
