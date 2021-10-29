<?php
declare(strict_types=1);

namespace App\Enjoythetrip\Presenters;
trait ArticlePresenter
{
    public function getLinkAttribute()
    {
        return route('article', ['id' => $this->id]);
    }

    public function getTypeAttribute()
    {
        return $this->title . ' article';
    }
}
