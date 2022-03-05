/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */


	const config = {
		selector: "#autoComplete",
		data: {
			src: async (query) => {
			  try {

				result = await $.ajax({
					url: "./wp-admin/admin-ajax.php",
					type: 'POST',
					data: {
						action:'wpa56343_search', 
						search_string: query 
					},
					dataType: "json"
				});
		
				return result;
			  } catch (error) {
				return error;
			  }
			},
			// Data 'Object' key to be searched
			keys: ["title"]
		},
		resultItem: {
			highlight: {
				render: true
			}
		},
		destination: function() {

			console.log( 'wat' );

		}
	};

	if ( $('#autoComplete').length ) {
	
		const autoCompleteJS = new autoComplete( config );

		document.querySelector("#autoComplete").addEventListener("selection", function (event) {
			window.location.href = 'https://madmonkeystudio.com.co/webflix/pelicula/' + event.detail.selection.value.link;
		});

	}


