<?php

namespace App\Custom;

use App\Traits\Labels;
use Illuminate\Database\Eloquent\Model as ModelLaravel;

/**
 * Class Model
 * @package App\Custom
 */
abstract class BaseModel extends ModelLaravel
{
    use Labels;

    public function isDirtyOrFail(): BaseModel
    {
        if (!$this->isDirty()) {
            throw new \Exception('Nenhum dado para alteração.', 499);
        }

        return $this;
    }
}
