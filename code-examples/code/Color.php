<?php
class Color extends StyleObject {
  /**
   * FIELDS
  */

  private static $db = array (
    'Name' => 'Text',
    'Value' => 'Text'
  );

  private static $default_sort='Name ASC';

  private static $summary_fields = array (    
    'Name' => 'Name',
    'Value' => 'Value'
  );

  /**
   * CMS FIELDS
   */

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    
    /**
     * MAIN TAB
     */

    $tab = 'Root.Main';

    $field = new TextField('Name');
    $fields->addFieldToTab($tab, $field);

    $field = new TextField('Value');
    $fields->addFieldToTab($tab, $field);
    
    return $fields;
  }
}