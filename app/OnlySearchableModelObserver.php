<?php
namespace App;
use Laravel\Scout\ModelObserver;
class OnlySearchableModelObserver extends ModelObserver
{
    public function saved($model): void
    {
        if (static::syncingDisabledFor($model)) {
            return;
        }
        if (! $model->shouldBeSearchable()) {
            $model->unsearchable();
            return;
        }
        if (empty(array_intersect_key($model->toSearchableArray(), $model->getDirty()))) {
            return;
        }
        $model->searchable();
    }
}
