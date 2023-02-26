<?php

namespace App\Http\Controllers\Product\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function index(Request $request)
    {
        $categories = Category::latest('id')->get();



        $query = Product::with('category');

        $phrase = $request->query('q');
        if($phrase)
        {
            $query->search($phrase);
        }

        $records = $query->orderAvailable()->latest('id')->paginate(12);

        // return
        $data = [
            'categories' => $categories,
            'records' => $records,
        ];

        return view('products._self.front.index', $data);
    }


    public function show()
    {
        $records = Product::whereCategory($this->record->category)->with('category')->orderAvailable()->inRandomOrder()->take(10)->get();

        $this->record->increment('visit_count');

        $data = [
            'record' => $this->record,
            'records' => $records,
        ];

        return view('products._self.front.show', $data);
    }
}
