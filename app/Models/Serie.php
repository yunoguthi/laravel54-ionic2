<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use CodeFlix\Media\SeriePaths;
use CodeFlix\Media\ThumbUpload;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Traits\TransformableTrait;

class Serie extends Model implements TableInterface
{
    use TransformableTrait;
    use SeriePaths;
    use ThumbUpload;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'thumb'];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
        }
    }
}
