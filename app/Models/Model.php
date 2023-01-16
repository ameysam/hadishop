<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Model extends Eloquent
{

    /**
     * @internal
     * @var array
     */
    protected $guarded = ['id'];


    public static function classBasename()
    {
        return class_basename(get_called_class());
    }


    /**
     * @internal
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @internal
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get child class name.
     *
     * @internal
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function getClass()
    {
        return get_called_class();
    }


    public static function getRecord($id)
    {
        return get_called_class()::find($id);
    }

    /**
     * This function get ids and titles of all records in a table in json or array.
     * The main usage of this method is to get all items to show in a dropdown in the grid in admin panel for search reasons.
     * You could add an additional where clause as a string. This string should be a simple raw sql query like this:
     * "`id` = 4" or "`category_type` = 'App\\\Exam'"
     * Pay attention to three backslashes above for escaping backslash!!!
     *
     * @author S.Tehranchi <sadjadteh@gmail.com>
     * @param bool $all
     * @param string $where_condition
     * @param bool $is_json
     * @param string $table_name
     * @return array|string
     */
    public static function getAllItemsForDropdown(string $where_condition = '', bool $all = TRUE, bool $is_json  = TRUE, string $table_name = '')
    {
        /**
         * Get the whole class name (the class name with its namespace).
         */
        $full_class_name = get_called_class();

        /**
         * Get the class name without its namespace.
         */
        $class = substr($full_class_name, strrpos($full_class_name, '\\') + 1);

        /**
         * If the table name is not sent by the user, we use the plural form of the class name as default.
         */
        if (!$table_name)
        {
            $table_name = Str::plural(Str::snake($class));
        }

        $items = DB::table($table_name);

        /**
         * If there is an additional where clause, it is added here.
         */
        if ($where_condition) {
            $items->whereRaw($where_condition);
        }

        /**
         * Get all items as an id=>title array.
         */
        $items = $items->pluck('name', 'id');

        $item_array = [];

        /**
         * If there is a need to have an all records item (We need it by default.), we add it to our array.
         */
        if ($all)
        {
            $item_array[] = [
                'text' => __('custom.all_items'),
                'value' => '',
            ];
        }

        /**
         * Build up our array by the records retrieved from the database.
         */
        foreach ($items as $key => $value)
        {
            $item_array[] = [
                'text' => $value,
                'value' => $key,
            ];
        }

        /**
         * If the user doesn't need a json, the array itself will be returned.
         */

        if (!$is_json) {
            return $item_array;
        }

        return json_encode($item_array);
    }
}
