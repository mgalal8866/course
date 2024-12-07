/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	config.extraPlugins = 'uploadimage,image2'; // Enable upload plugins
	config.filebrowserUploadUrl = '/upload/image'; // Set the upload URL
	config.filebrowserUploadMethod = 'form'; // Use form-based upload
    config.font_names = 'Cairo/Cairo, sans-serif; Arial/Arial, sans-serif; Courier New/Courier New, Courier, monospace';
	
	
    config.language = currentLocale;
	 
    // Enable the Font plugin (for font family and font size)
    config.extraPlugins = 'font';

	config.toolbar = [
		['Undo', 'Redo', '-', 'RemoveFormat'],
		['Bold', 'Italic', 'Underline', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
		{ name: 'styles', items: ['FontSize','Font'] },
		{ name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
		{ name: 'textdirection', items: ['BidiLtr', 'BidiRtl'] },
		{
			name: 'insert',
			items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Smiley']
		},
		{
			name: 'colors',
			items: ['TextColor', 'BGColor']
		},
		// {
		// 	name: 'wirisplugins',
		// 	items: ['ckeditor_wiris_formulaEditor', 'ckeditor_wiris_formulaEditorChemistry']
		// }
	]
		;

	config.versionCheck = false;
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
