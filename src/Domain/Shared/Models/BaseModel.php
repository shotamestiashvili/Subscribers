<?php

namespace Domain\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class BaseModel
{
    use HasFactory;

    protected static function newFactory()
    {
        $parts = str(get_called_class())->explode("\\");
        $domain = $parts[1];
        $model = $parts->last();

        return app(
            "Database\\Factories\\{$domain}\\{$model}Factory"
        );
    }
}
