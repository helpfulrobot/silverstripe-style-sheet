<?php
class StyleObject extends DataObject {
  /**
   * Triggers a new Style Sheet to be generated every time a change is made to a Style Object
   */

  public function onAfterWrite() {
    parent::onAfterWrite();
    SiteConfig::current_site_config()->ExportStyleSheet();
  }

  /**
   * Uses the owner's ClassName and ID to generate an unique CSSClass.
   * Pass a prefix for Styles like Color.
   * Ex: BackgroundColor.CSSClass('background')
   * Generates: background-color-42 where 42 is equal to the ID of the Color
   */

  public function CSSClass($prefix=0) {
    $className = strtolower($this->ClassName);
    $id = $this->ID;
    $CSSClass = $className . '-' . $id;
    
    if ($prefix) {
      $CSSClass = $prefix . '-' . $CSSClass;
    }

    return $CSSClass;
  }

  public function RenderStyleSheet() {
    $html = ViewableData::renderWith($this->ClassName . '_Style');
    return $html;
  }
}