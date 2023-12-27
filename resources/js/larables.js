import Swal from 'sweetalert2';

function Larables() {
	/**
	 * Initiate the object.
	 */
	this.init = function () {
		this.registerBulkEvents();
		this.registerPerPageEvents();
		this.registerSearchEvents();
		this.registerCheckboxEvents();
		this.registerSortEvents();
	}

	/**
	 * Register the bulk events.
	 */
	this.registerBulkEvents = function () {

		var wrapperElement = document.querySelector("[larables-wrapper='yes']");
		var bulkOptionsElement = wrapperElement.querySelector("[larables-id='bulk-options-select']");
		var checkboxName = wrapperElement.getAttribute('larables-checkbox-name');
		var form = wrapperElement.querySelector("[larables-id='bulk-options-form']");

		if (bulkOptionsElement == null) {
			return;
		}

		bulkOptionsElement.addEventListener('change', function (event) {

		    var element = event.target;
		    var checkedValues = [];
		    var method = "post";

		    // A bulk action must be selected
		    if (element.value == '') {
		        return Swal.fire({
		            title: 'Error',
		            icon: 'error',
		            text: 'Oops, you did not select a bulk action!',
		        });
		    }

		    // Get all the checked items and add them to the form for submitting
		    wrapperElement.querySelectorAll("[larables-id='checkbox-child']").forEach(function (checkbox) {

		        if (checkbox.checked != true) {
		            return;
		        }

		        // Store the checked value
		        checkedValues.push(checkbox.value);

		        // Create form input
		        var inputElement = document.createElement('input');
		        inputElement.setAttribute('type', 'hidden');
		        inputElement.setAttribute('name', checkboxName+'[]');
		        inputElement.setAttribute('value', checkbox.value);

		        // Add to existing form
		        form.appendChild(inputElement);
		    });

		    // If there are no checked items, we reset the bulk option and also
		    // let the user know that nothing was selected.
		    if (checkedValues.length < 1) {

		        element.value = '';

		        return Swal.fire({
		            title: 'Error',
		            icon: 'error',
		            text: 'Oops, there is no checked value to submit!',
		        });
		    }

		    // Get the selected option element
		    var option = element.options[element.selectedIndex];
		    var requestType = option.getAttribute('request_type').toLowerCase();
		    var route = option.getAttribute('route');

		    if (requestType == 'get') {
		        method = 'get';
		    }

		    // If request type is not post or patch, we don't need the token field
		    if (requestType != 'post' && requestType != 'patch') {
		        document.querySelector("[larables-id='bulk-options-csrf-token']").removeAttribute('name');
		    }

		    // Add the token if request method is post or patch
		    if (requestType == 'post' || requestType == 'patch') {
		        form.querySelector("[larables-id='bulk-options-csrf-token']").setAttribute('name', '_token');
		    }

		    // If request type is get or post, we don't need the method spoofing
		    if (requestType == 'get' || requestType == 'post') {
		        form.querySelector("[larables-id='bulk-options-method']").removeAttribute('name');
		    }

		    // If request type is not get and post, add method spoofing
		    if (requestType != 'get' && requestType != 'post') {
		        var methodElement = form.querySelector("[larables-id='bulk-options-method']");
		        methodElement.setAttribute('name', '_method');
		        methodElement.setAttribute('value', requestType);
		    }

		    // Set the form method, form action and an action selected
		    form.setAttribute('method', method);
		    form.setAttribute('action', route);
      		form.querySelector("[larables-id='bulk-options-name']").value = element.value;

		    // Finally we submit the form
		    form.submit();
		});
	}

	/**
	 * Register the per page events.
	 */
	this.registerPerPageEvents = function () {
		var form = document.querySelector("[larables-id='per-page-form']")
		var perPageElement = document.querySelector("[larables-id='per-page-select']");

		if (perPageElement == null) {
			return;
		}

		perPageElement.addEventListener('change', function (event) {

		    var element = event.target;

		    if (element.value == '') {
		        return Swal.fire({
		            title: 'Error',
		            icon: 'error',
		            text: 'Oops, looks like you did not specify the amount of entries you want to be displayed!',
		        });
		    }

		    var input = document.createElement('input');
		    input.setAttribute('name', element.getAttribute('name'));
		    input.setAttribute('value', element.value);

		    form.appendChild(input);

		    form.submit();
		});
	}

	/**
	 * Register the search events.
	 */
	this.registerSearchEvents = function () {
		var self = this;
		var searchInput = document.querySelector("[larables-id='search-input']");
		var searchButton = document.querySelector("[larables-id='search-button']");
		var searchForm = document.querySelector("[larables-id='search-form']");

		if (searchInput == null || searchButton == null || searchForm == null) {
			return;
		}

		// Submit form when search is cleared
		searchInput.addEventListener('input', function (event) {
			if (event.target.value.length == 0) {
				return searchForm.submit();
			}
		});

		searchInput.addEventListener('change', function (event) {
			self.handleSearch(searchInput, searchForm);
		});

		searchButton.addEventListener('click', function (event) {
			self.handleSearch(searchInput, searchForm);
		});
	}

	/**
	 * Register the checkbox events.
	 */
	this.registerCheckboxEvents = function () {
		document.querySelectorAll("[larables-id='checkbox-parent']").forEach(function (element) {
			element.addEventListener('click', function (event) {
		        // We cycle through the body checkboxes and make them the same checked state as the clicked parent checkbox
		        document.querySelectorAll("[larables-id='checkbox-child']").forEach(function (checkbox) {
		            checkbox.checked = element.checked;
		        });

		        // Make all parent checkbox the same checked state as the one that was clicked
		        document.querySelectorAll("[larables-id='checkbox-parent']").forEach(function (mainCheckbox) {
		            mainCheckbox.checked = element.checked;
		        });
		    });
		});
	}

	/**
	 * Register the sort events.
	 */
	this.registerSortEvents = function () {
		document.querySelectorAll("[larables-id='column-sort-button']").forEach(function (element) {
			element.addEventListener('click', function (event) {
				element.parentElement.querySelector('form').submit();
			});
		});
	}

	/**
	 * Handle the search.
	 */
	this.handleSearch = function (searchInput, form) {
	    if (searchInput.value.length >= 2) {
	        var input = document.createElement("input");
	        input.setAttribute('type', 'hidden');
	        input.setAttribute('name', searchInput.getAttribute('name'));
	        input.setAttribute('value', searchInput.value);

	        form.appendChild(input);

	        return form.submit();
	    }

	    return Swal.fire({
	        title: 'Error',
	        icon: 'error',
	        text: 'Oops, your search query must contain 2 or more characters!',
	    });
	}
}

new Larables().init();
