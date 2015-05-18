<?php
class StyleSheet_SiteConfigExtension extends DataExtension {
  /**
   * FIELDS
  */

  private static $db = array (
    'StyleSheetCustomCSS' => 'Text'
  );

  /**
   * CMS FIELDS
   */

  public function updateCMSFields(FieldList $fields) {    
    /**
     * APPEARANCE TAB
     */

    $tab = 'Root.Appearance.StyleSheet';

    $field = new TextareaField('StyleSheetCustomCSS', 'Custom CSS');
    $fields->addFieldToTab($tab, $field);

    $html = $this->owner->renderWith('StyleSheet_CMS_Preview');
    $field = new LiteralField('Preview', $html);
    $fields->addFieldToTab($tab, $field);
  }

  public function onAfterWrite() {
    $this->ExportStyleSheet();
  }

  public function ExportStyleSheet() {
    //create file
    $data = $this->RenderStyleSheet();

    //minify data
    $data = str_replace(' ', '', $data); //removes spaces
    $data = str_replace("\r\n", '', $data); //removes new lines
    $data = str_replace("\t", '', $data); //removes tabs

    $this->forceFilePutContents(STYLE_SHEET_SAVE_PATH, $data);
  }

  /**
   * create file with content, and create folder structure if doesn't exist 
   * @param String $filepath
   * @param String $message
   */
  public function forceFilePutContents ($filepath, $message){
      try {
          $isInFolder = preg_match("/^(.*)\/([^\/]+)$/", $filepath, $filepathMatches);
          if($isInFolder) {
              $folderName = $filepathMatches[1];
              $fileName = $filepathMatches[2];
              if (!is_dir($folderName)) {
                  mkdir($folderName, 0777, true);
              }
          }
          file_put_contents($filepath, $message);
      } catch (Exception $e) {
          echo "ERR: error writing '$message' to '$filepath', ". $e->getMessage();
      }
  }

  public function RenderStyleSheet() {    
    return $this->owner->renderWith('StyleSheet');
  }

  public function getStyleObjects() {
    $data = DataObject::get('StyleObject');
    return $data;
  }
}