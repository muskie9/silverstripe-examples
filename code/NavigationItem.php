<?php

class NavigationItem extends DataObject
{

    private static $singular_name = 'Navigation Item';
    private static $plural_name = 'Navigation Items';

    private static $db = array(
        'Title' => 'Varchar(255)',
        'Active' => 'Boolean',
        'Sort' => 'Int'
    );

    private static $has_one = array(
        'Link' => 'SiteTree'
    );

    private static $default_sort = 'Sort';

    private static $summary_fields = array(
        'Title',
        'Link.Title',
        'Active.Nice'
    );

    private static $field_labels = array(
        'Title' => 'Title',
        'Link.Title' => 'Link',
        'Active.Nice' => 'Active'
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(array(
            'Sort'
        ));

        return $fields;
    }

    protected function onBeforeWrite()
    {
        if (!$this->Sort) {
            $this->Sort = NavigationItem::get()->max('Sort') + 1;
        }

        parent::onBeforeWrite();
    }

    public function canCreate($member = null)
    {
        return true;
    }

    public function canEdit($member = null)
    {
        return true;
    }

    public function canDelete($member = null)
    {
        return true;
    }

    public function canView($member = null)
    {
        return true;
    }

}