<?php

namespace App\Services\Contracts;

use App\Models\Model;

abstract class Service
{
    /**
     * destroy
     * Destroy or Restore the record.
     * @return bool
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function destroy($record)
    {
        if ($record->deleted_at == null)
        {
            return $record->delete();
        }
        else
        {
            return $record->restore();
        }
    }


    /**
     * destroyMulti
     * Destroy or Restore multi records.
     * @param mixed $records
     * @return bool
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function destroyMulti($records)
    {
        foreach ($records as $item)
        {
            $this->destroy($item);
        }
        return true;
    }


    public function forceDelete(array $ids, string $model)
    {
        return $model::withTrashed()->whereIn('id', $ids)->forceDelete();
    }
}
