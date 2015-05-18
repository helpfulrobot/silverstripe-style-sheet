silverstripe-style-sheet
=======================================

Introduction
---------------------------------------
SilverStripe module which provides a `StyleObject` DataObject and a `Settings->Appearance->StyleSheet` Menu. `StyleObjects` are used to store styling properties (branding colors, icons, etc) in generated css files.

Maintainer Contact
---------------------------------------
-   Stephen Corwin - <stephenjcorwin@gmail.com>
   
Requirements
---------------------------------------
-   SilverStripe 3.1

Features
---------------------------------------
-   Easily create custom StyleObjects
-   Attach custom CSS to be loaded from the `Settings->Appearance->StyleSheet` Menu
-   Generates a minified css file hooking into loaded StyleObjects
-   Automatically imports the minified css file to the SiteTree

Installation
---------------------------------------
Installation can be done either by composer or by manually downloading a release.

####Via Composer:
`composer require stephenjcorwin/silverstripe-style-sheet`

####Manually:
1.   Download the module from [the releases page](https://github.com/stephenjcorwin/silverstripe-style-sheet/releases)
2.   Extract the file
3.   Make sure the folder after being extracted is name 'silverstripe-style-sheet'
4.   Place this directory in your site's root directory

####Configuration:
-   After installation, make sure you rebuild your database through `dev/build`
-    You should see the a new Menu in the CMS for managing `SyleObjects` available through the `Settings->Appearance->StyleSheet` Menu

Uninstall
---------------------------------------
####Via Composer:
`composer remove stephenjcorwin/silverstripe-style-sheet`

####Manually:
1.   Remove the `silverstripe-style-sheet` directory in your site's root directory

####Configuration:
-   After uninstalling, make sure you rebuild your database through `dev/build`

Code Examples
---------------------------------------
####StyleObject Template:
#####Each `StyleObject` has 4 parts:
-   A `ClassName` which extends `StyleObject`
-	A `ClassName_Style.ss` which handles the CSS rules
-	A `ClassName_SiteConfigExtension` to allow the CMS users to create and edit the `StyleObject`
-	And an activation hook in the `config.yml` to enable the `ClassName_SiteConfigExtension`

####`mysite/code/Color.php`
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

####`themes/mytheme/templates/Includes/Color_Style.ss`
	<% loop $Me %>
	 .$CSSClass { color: $Value; }
	 .$CSSClass('background') { background-color: $Value; }
	<% end_loop %>

####`mysite/code/Color_SiteConfigExtension.php`
	<?php
	class Colors_SiteConfigExtension extends DataExtension {
	  /**
	   * CMS FIELDS
	   */

	  public function updateCMSFields(FieldList $fields) {    
	    /**
	     * APPEARANCE TAB
	     */

	    $tab = 'Root.Appearance.Colors';
	    
	    $conf=GridFieldConfig_RelationEditor::create(10);
	    $conf->removeComponentsByType('GridFieldPaginator');
	    $conf->removeComponentsByType('GridFieldPageCount');
	    $data = DataObject::get('Color');
	    $field = new GridField('Color', 'Colors', $data, $conf);
	    $fields->addFieldToTab($tab, $field);
	  }
	}

####`mysite/code/config.yml`
	SiteConfig:
	  extensions:
	    Color_SiteConfigExtension