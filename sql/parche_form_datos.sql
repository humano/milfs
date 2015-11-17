-- PARCHE A LA TABLA form_datos
-- Este parche crea un nuevo campo en la tabla

ALTER TABLE `form_datos` ADD `proceso` INT(11) NULL AFTER `form_id`;