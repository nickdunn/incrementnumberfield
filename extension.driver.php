<?php

	Class extension_incrementnumberfield extends Extension{
	
		public function about(){
			return array('name' => 'Field: Increment Number',
						 'version' => '1.3',
						 'release-date' => '2011-04-01',
						 'author' => array('name' => 'Nick Dunn')
				 		);
		}
		
		public function uninstall(){
			Symphony::Database()->query("DROP TABLE `tbl_fields_incrementnumber`");
		}

		public function update($previousVersion){	
			if(version_compare($previousVersion, '1.3', '<')){
				Symphony::Database()->query("ALTER TABLE `tbl_fields_incrementnumber` 
					ADD `developers_only` enum('yes','no') NOT NULL default 'no'");
			}
			return true;
		}

		public function install(){
			
			if(!file_exists(EXTENSIONS . '/numberfield/fields/field.number.php')) {
				Administration::instance()->Page->pageAlert(
					__('Increment Number field could not be installed because the Number field needs to be installed first.'),
					Alert::ERROR
				);
				return false;
			}
			
			return Symphony::Database()->query("CREATE TABLE `tbl_fields_incrementnumber` (
			  `id` int(11) unsigned NOT NULL auto_increment,
			  `field_id` int(11) unsigned NOT NULL,
			  `developers_only` enum('yes','no') NOT NULL default 'no',
			  PRIMARY KEY  (`id`),
			  UNIQUE KEY `field_id` (`field_id`)
			) TYPE=MyISAM");
		}
			
	}