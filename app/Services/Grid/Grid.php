<?php


namespace App\Services\Grid;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Grid
{
    use Filter;

    /**
     * Determines value of requested page to paginate
     *
     * @var int
     */
    protected $page;

    /**
     * Determines how many rows should be taken for the query
     *
     * @var int
     */
    protected $rows;

    /**
     * Indicates the column which is requested for sorting
     *
     * @var string
     */
    protected $sort;

    /**
     * Indicates the ordering of column which is only ASC or DESC
     *
     * @var string
     */
    protected $order;

    /**
     * Determines total number of records which exists in database
     *
     * @var int
     */
    protected $total;


    /**
     * @var Request
     *
     */
    private $request;

    public function __construct(Request $request = null)
    {
        // if($request)
        // {
            $this->request = request();
        // }
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }



    /**
     * Prepare query for JEasyUi grid table
     *
     * @param Builder $query
     * @return array
     */
    public function items($query)
    {
        $this->page = $this->request->page ?? 1;
        $this->rows = $this->request->rows ?? 10;

        $this->filter($this->request, $query);

        // dd($query->toSql());

        $count = DB::table(DB::raw("({$query->toSql()}) as sub"))
        ->mergeBindings($query->getQuery())->count();

        $this->total = $count;
        // $this->total = $query->count();

        $this->order($query);

        $query->skip(($this->page - 1) * $this->rows)->take($this->rows);

        return [
            'total' => $this->total,
            'rows' => $query->get()
        ];
    }

    /**
     * If there is an order request from the client, we order
     * and return the ordered query to user otherwise we return the query
     *
     * @param Builder $query
     * @return mixed
     */
    public function order($query)
    {
        $this->order = $this->request['order'] ?: 'desc';
        $this->sort = $this->request['sort'] ?: 'id';

        $sorts = explode(',', $this->sort);
        $orders = explode(',', $this->order);
        foreach ($sorts as $key => $value) {
            $query->orderBy($value, $orders[$key]);
        }

        return $query;
    }

}
