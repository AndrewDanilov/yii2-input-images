/**
 * @return {boolean}
 */
var InputImagesHandler = function(files, id) {
	var wrapper = $('#' + id + '_wrapper');
	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + formName + '[' + formAttribute + '][]">';
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
	var formName = wrapper.attr('data-form-name');
	var formAttribute = wrapper.attr('data-form-attribute');
	var items = wrapper.find('.input-images-items');
	var input = '<input type="hidden" name="' + formName + '[' + formAttribute + ']">';
	var newItem = $('<div class="input-images-item"><div class="input-images-preview"><img src="" alt="" /></div>' + input + '<div class="input-images-remove fa fa-times"></div></div>');
	newItem.find('img').attr('src', file.url);
	newItem.find('input').val(file.url);
	items.empty().append(newItem);
	return true;
};

/**
 * @return {boolean}
 */
var InputImageFrontendHandler = function(response, id) {
	var wrapper = $('#' + id + '_wrapper');
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
		$(this).parents('.input-images-item').remove();
	});
});