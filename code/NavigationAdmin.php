<?php

class NavigationAdmin extends ModelAdmin
{

    private static $managed_models = array(
        'NavigationItem'
    );
    private static $url_segment = 'nav-items';
    private static $menu_title = 'Navigation';

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);
        // $gridFieldName is generated from the ModelClass, eg if the Class 'Product'
        // is managed by this ModelAdmin, the GridField for it will also be named 'Product'
        if (class_exists('GridFieldOrderableRows')) {
            $gridFieldName = $this->sanitiseClassName($this->modelClass);
            if ($gridFieldName == 'NavigationItem' && array_key_exists('Sort',
                    DataObject::database_fields('NavigationItem'))
            ) {
                $gridField = $form->Fields()->fieldByName($gridFieldName);
                $gridField->getConfig()->addComponent(new GridFieldOrderableRows());
            }
        }

        return $form;
    }

}