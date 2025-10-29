<?php

namespace common\components;

use yii\i18n\Formatter as BaseFormatter;

class Formatter extends BaseFormatter
{
    /**
     * Format order status
     */
    public function asOrderStatus($value)
    {
        $statuses = [
            0 => '<span class="badge badge-warning">Pending</span>',
            1 => '<span class="badge badge-info">Processing</span>',
            2 => '<span class="badge badge-success">Completed</span>',
            3 => '<span class="badge badge-danger">Cancelled</span>',
        ];
        
        return isset($statuses[$value]) ? $statuses[$value] : '<span class="badge badge-secondary">Unknown</span>';
    }
}
