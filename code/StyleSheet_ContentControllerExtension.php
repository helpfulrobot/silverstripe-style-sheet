<?php
class StyleSheet_ContentControllerExtension extends Extension {
  /**
   * Imports the generated Style Sheet
   */

  public function onAfterInit() {
    Requirements::css(STYLESHEET_CSS_PATH);
  }
}