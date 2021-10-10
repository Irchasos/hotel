<?php
declare(strict_types=1);
namespace App\Enjoythetrip\Presenters;
trait UserPresenter

{
    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->surname;
    }
}
