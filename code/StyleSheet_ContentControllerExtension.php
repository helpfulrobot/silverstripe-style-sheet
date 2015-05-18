<?php
class StyleSheet_ContentControllerExtension extends Extension {
  /**
   * Imports the generated Style Sheet
   */

  public function onAfterInit() {
    $siteConfig = SiteConfig::current_site_config();
    Requirements::css(STYLE_SHEET_PATH);
  }
}