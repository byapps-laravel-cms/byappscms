<?php

namespace Wms\ExtendForm\Classes;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use Backend\Classes\ControllerBehavior;
use Backend\Classes\FormField;
use Backend\Classes\ListColumn;
use Backend\Widgets\Form as BackendForm;
use Backend\Widgets\Lists as BackendLists;
use Cms\Classes\Page as CmsPage;
use Wms\ExtendForm\Fields\ListSwitchField;

class Extend
{
    protected static $imageMap = null;
    protected static $showImageMaps = null;

    public static function getListColumnTypes()
    {
        return [
            'repeater' => [self::class, 'evalRepeaterListColumn'],
            'switcher' => [ListSwitchField::class, 'render'],
        ];
    }

    public static function extendForm()
    {
        \Event::listen('backend.list.extendColumns', function (BackendLists $list) {
            foreach ($list->config->columns as $name => $config) {
                if (empty($config['type']) || $config['type'] !== 'switcher') {
                    continue;
                }

                // Store field config here, before that unofficial fields was removed
                ListSwitchField::storeFieldConfig($name, $config);

                $column = [
                    'clickable' => false,
                    'type'      => 'switcher'
                ];

                if (isset($config['label'])) {
                    $column['label'] = $config['label'];
                }
                if (isset($config['width'])) {
                    $column['width'] = $config['width'];
                }

                // Set this column not clickable
                // if other column with same field name exists configs are merged
                $list->addColumns([
                    $name => $column
                ]);
            }
        });

        \Event::listen('backend.form.extendFields', function(BackendForm $form) {
            $form->addViewPath('$/wms/extendform/partials/form/');

            if ($form->model instanceof CmsPage) {
                $form->addFields([
                    'settings[meta_keywords]' => [
                        'label' => 'wms.extendform::lang.cms.page.meta-keywords',
                        'tab'   => 'cms::lang.editor.meta',
                    ],
                ], 'primary');
            }

            foreach ($form->fields as $name => $field) {
                if (isset($field['type']) && strtolower($field['type']) == 'imagemap') {
                    $form->removeField($name);
                }
            }
            foreach ($form->tabs['fields'] as $name => $field) {
                if (isset($field['type']) && strtolower($field['type']) == 'imagemap') {
                    $form->removeField($name);
                }
            }
            foreach ($form->secondaryTabs['fields'] as $name => $field) {
                if (strpos($form->getController()->bodyClass, 'compact-container') === false) {
                    continue;
                }
                if (!isset($field['type']) || strtolower($field['type']) != 'imagemap') {
                    continue;
                }

                if (isset($field['image']) && isset($field['fields']) && count($field['fields'])) {
                    $field = $form->getField($name);
                    /* @var $field FormField */
                    foreach ($field->config['fields'] as $fieldName => $fieldConfig) {
                        if ($formField = $form->getField($fieldName)) {
                            $field->config['fields'][$fieldName]['id'] = $formField->getId();
                            $field->config['fields'][$fieldName]['label'] = $formField->label;
                        } else {
                            unset($field->config['fields'][$fieldName]);
                        }
                    }
                    self::$imageMap = $name;
                    break;
                } else {
                    $form->removeField($name);
                }
            }
            if (self::$imageMap) {
                foreach ($form->secondaryTabs['fields'] as $name => $field) {
                    if (self::$imageMap != $name) {
                        $form->removeField($name);
                    }
                }
                $form->getController()->addDynamicProperty('imageMap', true);
            }
        });
    }

    public static function extendController()
    {
        Controller::extend(function(Controller $controller) {
            /* @var $controller Controller */
            $controller->addDynamicMethod('getTitle', function() use (&$controller) {
                return isset($controller->title) ? $controller->title : $controller->pageTitle;
            });
        });

        FormController::extend(function(FormController $formController) use (&$setTitle) {
            \Event::listen('backend.page.beforeDisplay', function($controller, $action) use (&$formController, &$setTitle) {
                self::setControllerTitle($controller, $formController, $action);
            });
        });

        ListController::extend(function(ListController $listController) use (&$setTitle) {
            \Event::listen('backend.page.beforeDisplay', function(Controller $controller, $action) use (&$listController, &$setTitle) {
                self::setControllerTitle($controller, $listController, $action);

                /**
                 * Switch a boolean value of a model field
                 */
                $controller->addDynamicMethod('index_onSwitchInetisListField', function () use ($controller) {

                    $field = post('field');
                    $id = post('id');
                    $modelClass = post('model');

                    if (empty($field) || empty($id) || empty($modelClass)) {
                        \Flash::error('Following parameters are required : id, field, model');

                        return null;
                    }

                    $item = $modelClass::where('id', $id)->select('id', $field)->first();
                    $item->{$field} = !$item->{$field};

                    $item->forceSave();

                    return $controller->listRefresh($controller->primaryDefinition);
                });
            });
        });
    }

    /**
     * @param Controller $controller
     * @param ControllerBehavior $behavior
     * @param string $action
     */
    protected static function setControllerTitle(&$controller, &$behavior, $action = null)
    {
        if (method_exists($behavior, $action)) {
            $config = $behavior->getConfig();
            $delimiter = ' ';
            if (isset($config->title)) {
                $defaultTitle = explode($delimiter, $config->title);
                foreach ($defaultTitle as $key => $item) {
                    $defaultTitle[$key] = trans($item);
                }
                $defaultTitle = implode($delimiter, $defaultTitle);
            } else {
                $name = explode($delimiter, isset($config->name) ? $config->name : '');
                foreach ($name as $key => $item) {
                    $name[$key] = trans($item);
                }
                $name = implode($delimiter, $name);
                if (strpos($name, ' ') === false) {
                    $name = mb_strtolower($name);
                }
                $defaultTitle = "backend::lang.form.{$action}_title";
                if (trans($defaultTitle) == $defaultTitle) {
                    $defaultTitle = '';
                }
                $configTitle = isset($config->$action['title']) ? $config->$action['title'] : $defaultTitle;
                $defaultTitle = trans($configTitle, ['name' => $name]);
            }
            if (isset($config->pageName)) {
                $name = explode($delimiter, $config->pageName);
                foreach ($name as $key => $item) {
                    $name[$key] = trans($item);
                }
                $name = implode($delimiter, $name);
                if (isset($configTitle)) {
                    $title = trans($configTitle, ['name' => $name]);
                } else {
                    $title = $name;
                }

                $defaultTitle = explode($title, $defaultTitle);
                $title = explode(' ', $title);
                $count = count($title);
                for ($i = $count > 1 ? 1 : 0; $i < $count; $i++) {
                    $title[$i] = mb_strtolower($title[$i]);
                }
                $title = implode(' ', $title);
                $defaultTitle = implode($title, $defaultTitle);
            } else {
                $title = $defaultTitle;
            }
            $controller->pageTitle = $defaultTitle;
            $controller->addDynamicProperty('title', $title);

            if (isset($config->$action['flashSave'])) {
                $config->$action['flashSave'] = trans($config->$action['flashSave']);
                $flashIncline = isset($config->$action['flashIncline']) ? $config->$action['flashIncline'] : null;
                switch ($flashIncline) {
                    case 'she':
                        $trans = "wms.extendform::lang.form.she.{$action}_success";
                        break;
                    case 'it':
                        $trans = "wms.extendform::lang.form.it.{$action}_success";
                        break;
                    default:
                        $trans = "backend::lang.form.{$action}_success";
                        break;
                }
                $config->$action['flashSave'] = trans($trans, ['name' => $config->$action['flashSave']]);
                $behavior->setConfig($config);
            }
        }
    }

    public static function evalRepeaterListColumn($value, ListColumn $column)
    {
        if (!is_array($value) || !count($value)) {
            return '';
        }

        $title = isset($column->config['title']) ? $column->config['title'] : null;
        $counter = isset($column->config['counter']) ? $column->config['counter'] : null;
        $prefix = isset($column->config['prefix']) ? trans($column->config['prefix']) : null;
        $postfix = isset($column->config['postfix']) ? trans($column->config['postfix']) : null;

        $result = '<ul style="padding-left: 20px;">';
        foreach ($value as $key => $item) {
            if (is_array($item)) {
                $count = '';
                if ($title && isset($item[$title])) {
                    $text = $item[$title];
                } else {
                    $text = array_shift($item);
                }
                if ($counter) {
                    if ($counter == 'all') {
                        $count = count($value[$key]);
                    } elseif (isset($item[$counter]) && is_array($item[$counter])) {
                        $count = count($item[$counter]);
                    }
                    $count = " <i>($count)</i>";
                }

                $result .= "<li>$prefix$text$count$postfix</li>";
            } else {
                if ($counter) {
                    return "$prefix" . count($value) . "$postfix";
                } else {
                    $result .= "<li>$prefix$item$postfix</li>";
                }
            }
        }
        $result .= '</ul>';

        return $result;
    }
}