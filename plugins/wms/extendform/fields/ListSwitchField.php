<?php

namespace Wms\ExtendForm\Fields;

use Backend\Classes\ListColumn;

class ListSwitchField
{
    /**
     * Default field configuration
     * all these params can be overrided by column config
     * @var array
     */
    protected static $defaultFieldConfig = [
        'icon'       => [
            true  => 'icon-toggle-on',
            false => 'icon-toggle-off',
        ],
        'titleTrue'  => 'wms.extendform::lang.listswitch.title_true',
        'titleFalse' => 'wms.extendform::lang.listswitch.title_false',
        'textTrue'   => 'wms.extendform::lang.listswitch.text_true',
        'textFalse'  => 'wms.extendform::lang.listswitch.text_false',
        'request'    => 'onSwitchInetisListField'
    ];

    protected static $listConfig = [];

    /**
     * @param       $field
     * @param array $config
     *
     * @internal param $name
     */
    public static function storeFieldConfig($field, array $config)
    {
        self::$listConfig[$field] = array_merge(self::$defaultFieldConfig, $config, ['name' => $field]);
    }

    /**
     * @param            $value
     * @param ListColumn $column
     * @param \Model      $record
     *
     * @return string HTML
     */
    public static function render($value, ListColumn $column, \Model $record)
    {
        $field = new self($value, $column, $record);
        $config = $field->getConfig();

        $result = '<a href="javascript:;"'
            . ' data-request="' . $config['request']
            . '" data-request-data="' . $field->getRequestData()
            . '" data-stripe-load-indicator title="'
            . $field->getButtonTitle() . '">'
            . $field->getButtonValue() . '</a>';

        return $result;
    }

    /**
     * ListSwitchField constructor.
     *
     * @param            $value
     * @param ListColumn $column
     * @param \Model      $record
     */
    public function __construct($value, ListColumn $column, \Model $record)
    {
        $this->name = $column->columnName;
        $this->value = $value;
        $this->column = $column;
        $this->record = $record;
    }

    /**
     * @param $config
     *
     * @return mixed
     */
    protected function getConfig($config = null)
    {
        if (is_null($config)) {
            return optional(self::$listConfig)[$this->name];
        }

        return isset(self::$listConfig[$this->name][$config]) ? self::$listConfig[$this->name][$config] : null;
    }

    /**
     * Return data-request-data params for the switch button
     *
     * @return string
     */
    public function getRequestData()
    {
        $modelClass = str_replace('\\', '\\\\', get_class($this->record));

        $data = [
            "id: {$this->record->{$this->record->getKeyName()}}",
            "field: '$this->name'",
            "model: '$modelClass'"
        ];

        if (post('page')) {
            $data[] = "page: " . post('page');
        }

        return implode(', ', $data);
    }

    /**
     * Return button text or icon
     *
     * @return string
     */
    public function getButtonValue()
    {
        $icon = $this->getConfig('icon');
        if (!$icon) {
            return trans($this->getConfig($this->value ? 'textTrue' : 'textFalse'));
        }

        $icon = isset($icon[$this->value]) ? $icon[$this->value] : self::$defaultFieldConfig['icon'][$this->value];

        $color = $this->getConfig('color');
        $color = isset($color[$this->value]) ? $color[$this->value] : null;
        $size = $this->getConfig('size') ?: 20;
        $font = '';
        if ($color) {
            $font .= "color: $color;";
        }
        $font .= "font-size: {$size}px;";
        if (!empty($font)) {
            $font = " style=\"$font\"";
        }

        return "<i class=\"$icon\"$font></i>";
    }

    /**
     * Return button hover title
     *
     * @return string
     */
    public function getButtonTitle()
    {
        return trans($this->getConfig($this->value ? 'titleTrue' : 'titleFalse'));
    }
}