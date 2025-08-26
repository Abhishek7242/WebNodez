<?php
// app/Observers/IndexNowObserver.php

namespace App\Observers;

use App\Helpers\IndexNowHelper;

class IndexNowObserver
{
    public function created($model)
    {
        IndexNowHelper::submitUrl($model->getIndexNowUrl());
    }

    public function updated($model)
    {
        IndexNowHelper::submitUrl($model->getIndexNowUrl());
    }

    public function deleted($model)
    {
        IndexNowHelper::submitUrl($model->getIndexNowUrl());
    }
}
