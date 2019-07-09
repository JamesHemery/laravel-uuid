<?php

namespace Jamesh\Uuid;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UuidPivot extends Pivot
{

    use HasUuid;

}
