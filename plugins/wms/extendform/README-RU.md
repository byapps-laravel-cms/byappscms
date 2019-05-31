# ExtendForm plugin
Расширяет стандартный функционал формы

#### Сайдбар в форме

Для автоматического создания формы с сайдбаром используйте команду `php artisan create:wms:controller {Plugin} {Name}`
* Параметры для сайдбара берутся из `secondaryTabs` в `models/{Model}/fields.yaml`
* Для работы сайдбара в контроллере в параметре `bodyClass` обязательно должен присутствовать класс `compact-container`

#### Карта значений

Для включения карты значений нужно создать контроллер с сайдбаром
 и указать в настройках видимость карты значений (Если установлен плагин Settings).

Также в параметре `secondaryTabs` нужно указать настройки карты параметров

    secondaryTabs:
      fields:
        imageMap:
          label: Карта значений
          type: imageMap
          size: 18
          color: green // По умолчанию "red"
          image: /plugins/{path to image}
          fields:
            {field name}: // Поле типа блок
              left: 165
              top: 50
              width: 30
              height: 20
            {field name}: // Поле типа текст
              left: 165
              top: 50
              size: 18 // Для каждого поля типа "текст" можно задать отдельно

Если указаны ширина и высота, то поле будет типа "блок", если нет, то типа "текст"
* __Важно!__ если в `secondaryTabs` есть поле _(первое)_ типа `imageMap`, то все остальные поля отуда удаляются.

### Form List

#### Switcher

Переключатель bool полей в листе

    columns:
      active:
        label: Активность
        type: switcher
        icon:
          true: icon-toggle-on   // По умолчанию "oc-icon-check"
          false: icon-toggle-off // По умолчанию "oc-icon-times"
        size: 25                 // Размер шрифта.
        color: red

 По умолчанию поля `size` и `color` как у родителя.