# ExtendForm plugin
Extends standard form functionality

#### Sidebar in form

To automatically create a form with sidebar, use command `php artisan create:wms:controller {Plugin} {Name}`
* Fields for sidebar are taken from `secondaryTabs` in `models/{Model}/fields.yaml`
* For sidebar operation in the controller in the parameter `bodyClass` must have a class `compact-container`

#### Value map

To enable the value map, you need to create a controller with the sidebar
 and specify the visibility of the value map in the settings (If Settings Plugin is installed).

Also in `secondaryTabs` you need to specify the settings of the value map

    secondaryTabs:
      fields:
        imageMap:
          label: Value map
          type: imageMap
          size: 18
          color: green // by default "red"
          image: /plugins/{path to image}
          fields:
            {field name}: // Block field
              left: 165
              top: 50
              width: 30
              height: 20
            {field name}: // Text field
              left: 165
              top: 50
              size: 18 // For each field type "text" can be set separately

If width and height are specified, then the field will be of type “block”,
 if not, then of type “text”

* __Importantly!__ if `secondaryTabs` has field _(first)_ type `imageMap`,
 then all other fields will be deleted.

### Form List

#### Switcher

Switch bool fields in list

    columns:
      active:
        label: Activity
        type: switcher
        icon:
          true: icon-toggle-on   // by default "oc-icon-check"
          false: icon-toggle-off // by default "oc-icon-times"
        size: 25                 // Font size.
        color: red

By default, the `size` and` color` fields are as parent.