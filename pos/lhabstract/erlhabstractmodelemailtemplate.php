<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lh_abstract_email_templates";
$def->class = "erLhAbstractModelEmailTemplate";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['name'] = new ezcPersistentObjectProperty();
$def->properties['name']->columnName   = 'name';
$def->properties['name']->propertyName = 'name';
$def->properties['name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['from_name'] = new ezcPersistentObjectProperty();
$def->properties['from_name']->columnName   = 'from_name';
$def->properties['from_name']->propertyName = 'from_name';
$def->properties['from_name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['from_email'] = new ezcPersistentObjectProperty();
$def->properties['from_email']->columnName   = 'from_email';
$def->properties['from_email']->propertyName = 'from_email';
$def->properties['from_email']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'available_locales' ) as $locale) {
	$def->properties['content_'.strtolower($locale)] = new ezcPersistentObjectProperty();
	$def->properties['content_'.strtolower($locale)]->columnName   = 'content_'.strtolower($locale);
	$def->properties['content_'.strtolower($locale)]->propertyName = 'content_'.strtolower($locale);
	$def->properties['content_'.strtolower($locale)]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
}

foreach (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'available_locales' ) as $locale) {
	$def->properties['subject_'.strtolower($locale)] = new ezcPersistentObjectProperty();
	$def->properties['subject_'.strtolower($locale)]->columnName   = 'subject_'.strtolower($locale);
	$def->properties['subject_'.strtolower($locale)]->propertyName = 'subject_'.strtolower($locale);
	$def->properties['subject_'.strtolower($locale)]->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;
}


return $def;
?>