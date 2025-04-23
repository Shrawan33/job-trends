<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Helpers\FunctionHelper;

class AuthorFields extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'model' => '',
        'updated_by' => '',
        'updated_on' => '',
        'information' => 'author_fields'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if (!empty($this->config['model'])) {
            $this->config['model']->created = $this->config['model']->created_at ? FunctionHelper::fromSqlDateTime($this->config['model']->created_at->toDateTimeString()) : '';
            $this->config['model']->updated = $this->config['model']->updated_at ? FunctionHelper::fromSqlDateTime($this->config['model']->updated_at->toDateTimeString()) : '';
        }

        if (!empty($this->config['updated_on'])) {
            $this->config['updated_on'] = FunctionHelper::fromSqlDateTime($this->config['updated_on']->toDateTimeString());
        }

        return view("widgets.{$this->config['information']}", [
            'config' => $this->config,
        ]);
    }
}
