if (typeof andrewdanilov === "undefined" || !andrewdanilov) {
	var andrewdanilov = {};
}

andrewdanilov.inputImages = {
	functions: {},
	register: function(id, func) {
		this.functions[id] = func;
	},
	callFunction: function(id, response) {
		return this.functions[id](response, id);
	}
};

andrewdanilov.getInputName = function(formName, formAttribute, multiple) {
	var matches = formAttribute.match(/(^|.*\])([\w\.\+]+)(\[.*|$)/);
	var prefix = matches[1];
	var attribute = matches[2];
	var suffix = matches[3];
	if (multiple) {
		suffix += '[]';
	}
	if (formName === '' && prefix === '') {
		return attribute + suffix;
	} else if (formName !== '') {
		return formName + prefix + '[' + attribute + ']' + suffix;
	}
	return '';
};

/**
 * @return {boolean}
 */
var InputImagesHandler = function(files, id) {
	var wrapper = $('#' + id + '_wrapper');

	// If there is an empty input field, which indicates that images items have been deleted before,
	// we need to remove this indicator field as we add new images.
	const empty_input = wrapper.children('input[value=""]');
	if (empty_input.length) {
		empty_input.remove();
	}

	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + andrewdanilov.getInputName(formName, formAttribute, true) + '">';
	for (var i in files) {
		var newItem = $('<div class="input-images-item"><div class="input-images-preview"><img src="" alt="" /></div>' + input + '<div class="input-images-remove fa fa-times"></div></div>');
		if (files.hasOwnProperty(i)) {
			newItem.find('img').attr('src', files[i].url);
			newItem.find('input').val(files[i].url);
			items.append(newItem);
		}
	}
	return true;
};

/**
 * @return {boolean}
 */
var InputImageHandler = function(file, id) {
	var wrapper = $('#' + id + '_wrapper');

	// If there is an empty input field, which indicates that images items have been deleted before,
	// we need to remove this indicator field as we add new images.
	const empty_input = wrapper.children('input[value=""]');
	if (empty_input.length) {
		empty_input.remove();
	}

	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + andrewdanilov.getInputName(formName, formAttribute, false) + '">';
	var newItem = $('<div class="input-images-item"><div class="input-images-preview"><img src="" alt="" /></div>' + input + '<div class="input-images-remove fa fa-times"></div></div>');
	newItem.find('img').attr('src', file.url);
	newItem.find('input').val(file.url);
	items.empty().append(newItem);
	return true;
};

/**
 * @return {boolean}
 */
var InputImagesSimpleHandler = function(response, id) {
	var wrapper = $('#' + id + '_wrapper');

	// If there is an empty input field, which indicates that images items have been deleted before,
	// we need to remove this indicator field as we add new images.
	const empty_input = wrapper.children('input[value=""]');
	if (empty_input.length) {
		empty_input.remove();
	}

	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + formName + '[' + formAttribute + '][]">';
	var newItem = $('<div class="input-images-item"><div class="input-images-preview"><img src="" alt="" /></div>' + input + '<div class="input-images-remove fa fa-times"></div></div>');
	newItem.find('img').attr('src', response.url);
	newItem.find('input').val(response.url);
	items.append(newItem);
	return true;
};

/**
 * @return {boolean}
 */
var InputImageSimpleHandler = function(response, id) {
	var wrapper = $('#' + id + '_wrapper');

	// If there is an empty input field, which indicates that images items have been deleted before,
	// we need to remove this indicator field as we add new images.
	const empty_input = wrapper.children('input[value=""]');
	if (empty_input.length) {
		empty_input.remove();
	}

	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + formName + '[' + formAttribute + ']">';
	var newItem = $('<div class="input-images-item"><div class="input-images-preview"><img src="" alt="" /></div>' + input + '<div class="input-images-remove fa fa-times"></div></div>');
	newItem.find('img').attr('src', response.url);
	newItem.find('input').val(response.url);
	items.empty().append(newItem);
	return true;
};

$(function () {
	var items = $('.input-images-wrapper .input-images-items');
	if (typeof items.sortable !== 'undefined') {
		items.sortable({
			containment: "parent"
		});
	}
	items.on('click', '.input-images-remove', function () {
		const image_item = $(this).parents('.input-images-item');
		const widget_wrapper = image_item.parent().parent();

		const is_last_item = image_item.siblings('.input-images-item').length === 0;

		if (is_last_item) {
			// If it is last, we need to empty it and move it to widget wrapper to keep of deleting.
			// We need an empty hidden field to send it with form data if there is no other image fields
			// (otherwise it won't be saved as empty and leaves previous image field untouched)
			const input = image_item.find('input').val('').appendTo(widget_wrapper);
		}

		$(this).parents('.input-images-item').remove();
	});
});