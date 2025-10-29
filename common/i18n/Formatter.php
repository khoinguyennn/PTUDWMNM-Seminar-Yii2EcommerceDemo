<?php
/**
 * User: TheCodeholic
 * Date: 12/18/2020
 * Time: 10:48 AM
 */

namespace common\i18n;

/**
 * Class Formatter
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package common\i18n
 */
class Formatter extends \yii\i18n\Formatter
{
    public function asCurrency($value, $currency = null, $options = [], $textOptions = [])
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        
        $value = $this->normalizeNumericValue($value);
        
        if (!is_numeric($value)) {
            return $this->nullDisplay;
        }
        
        // Format the number with thousand separators
        $formattedValue = number_format($value, 0, $this->decimalSeparator, $this->thousandSeparator);
        
        // Return with currency code after the value with styling
        return $formattedValue . ' <span class="currency">VND</span>';
    }

    public function asOrderStatus($status)
    {
        if ($status == \common\models\Order::STATUS_COMPLETED) {
            return \yii\bootstrap4\Html::tag('span', 'Completed', ['class' => 'badge badge-success']);
        } else if ($status == \common\models\Order::STATUS_PAID) {
            return \yii\bootstrap4\Html::tag('span', 'Paid', ['class' => 'badge badge-primary']);
        } else if ($status == \common\models\Order::STATUS_DRAFT) {
            return \yii\bootstrap4\Html::tag('span', 'Unpaid', ['class' => 'badge badge-secondary']);
        } else {
            return \yii\bootstrap4\Html::tag('span', 'Failured', ['class' => 'badge badge-danger']);
        }
    }
}