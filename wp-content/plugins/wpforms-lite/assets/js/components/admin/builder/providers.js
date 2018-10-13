/* global WPForms, jQuery, Map, wpforms_builder, wpforms_builder_providers, _ */

var WPForms = window.WPForms || {};
WPForms.Admin = WPForms.Admin || {};
WPForms.Admin.Builder = WPForms.Admin.Builder || {};

/**
 * WPForms Providers module.
 *
 * @since 1.4.7
 */
WPForms.Admin.Builder.Providers = WPForms.Admin.Builder.Providers || (function ( document, window, $ ) {

	'use strict';

	/**
	 * Private functions and properties.
	 *
	 * @since 1.4.7
	 *
	 * @type {Object}
	 */
	var __private = {

		/**
		 * All templating functions for providers are stored here in a Map.
		 * Key is a template name, value - Underscore.js templating function.
		 *
		 * @since 1.4.7
		 *
		 * @type {Map}
		 */
		previews: new Map(),

		/**
		 * Internal cache storage, do not use it directly, but app.cache.{(get|set|delete|clear)()} instead.
		 * Key is the provider slug, value is a Map, that will have it's own key as a connection id (or not).
		 *
		 * @since 1.4.7
		 *
		 * @type {Object.<string, Map>}
		 */
		cache: {},

		/**
		 * Config contains all configuration properties.
		 *
		 * @since 1.4.7
		 *
		 * @type {Object.<string, *>}
		 */
		config: {
			/**
			 * List of templates that should be compiled.
			 *
			 * @since 1.4.7
			 *
			 * @type {string[]}
			 */
			templates: [
				'wpforms-providers-builder-content-connection-fields',
				'wpforms-providers-builder-content-connection-conditionals'
			]
		}
	};

	/**
	 * Public functions and properties.
	 *
	 * @since 1.4.7
	 *
	 * @type {Object}
	 */
	var app = {

		/**
		 * By default, there is no provider.
		 * If set - will be used in templating etc.
		 *
		 * @since 1.4.7
		 *
		 * @type {string}
		 */
		provider: '',
		providerHolder: {},

		form: $( '#wpforms-builder-form' ),
		spinner: '<i class="fa fa-circle-o-notch fa-spin wpforms-button-icon" />',

		/**
		 * All ajax requests are grouped together with own properties.
		 *
		 * @since 1.4.7
		 */
		ajax: {
			/**
			 * Merge custom AJAX data object with defaults.
			 *
			 * @since 1.4.7
			 *
			 * @param {Object} custom
			 *
			 * @returns {Object}
			 */
			_mergeData: function ( custom ) {

				var data = {
					id: $( '#wpforms-builder-form' ).data( 'id' ),
					nonce: wpforms_builder.nonce,
					action: 'wpforms_builder_provider_ajax_' + app.provider
				};

				$.extend( data, custom );

				return data;
			},

			/**
			 * Make an AJAX request. It's basically a wrapper around jQuery.ajax, but with some defaults.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} provider
			 * @param {*} custom Object of user-defined $.ajax()-compatible parameters.
			 *
			 * @return {Promise}
			 */
			request: function ( provider, custom ) {

				// Setting provider should be done first, as it's used in _mergeData().
				if ( typeof provider !== 'undefined' ) {
					app.setProvider( provider );
				}

				custom.data = app.ajax._mergeData( custom.data || {} );

				var params = {
					url: wpforms_builder.ajax_url,
					type: 'post',
					dataType: 'json',
					beforeSend: function () {
						app.getProviderHolder()
						   .find( '.wpforms-builder-provider-title-spinner' )
						   .show();
					}
				};

				$.extend( params, custom );

				return $.ajax( params )
						.fail( function ( jqXHR, textStatus ) {
							/*
							 * Right now we are logging into browser console.
							 * In future that might be something better.
							 */
							console.error( 'provider:', app.provider );
							console.error( jqXHR );
							console.error( textStatus );
						} )
						.always( function () {
							app.getProviderHolder()
							   .find( '.wpforms-builder-provider-title-spinner' )
							   .hide();
						} );
			}
		},

		/**
		 * Temporary in-memory cache handling for all providers.
		 *
		 * @since 1.4.7
		 */
		cache: {
			provider: '',

			/**
			 * Define the cache owner. Chainable.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} provider Intended to be a provider slug.
			 *
			 * @returns {app.cache}
			 */
			as: function ( provider ) {

				this.provider = provider;

				return this;
			},

			/**
			 * Get the value from cache by key.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} key
			 *
			 * @returns {*} Null if some error occurs.
			 */
			get: function ( key ) {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					return null;
				}

				return __private.cache[ this.provider ].get( key );
			},

			/**
			 * Get the value from cache by key and an ID.
			 * Useful when Object is stored under key and we need specific value.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} key
			 * @param {string} id
			 *
			 * @returns {*} Null if some error occurs.
			 */
			getById: function( key, id ) {

				if ( typeof this.get( key )[ id ] === 'undefined' ) {
					return null;
				}

				return this.get( key )[ id ];
			},

			/**
			 * Save the data to cache.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} key Intended to be a string, but can be everything that Map supports as a key.
			 * @param {*} value Data you want to save in cache.
			 *
			 * @returns {Map} All the cache for the provider. IE11 returns 'undefined' for an undefined reason.
			 */
			set: function ( key, value ) {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					__private.cache[ this.provider ] = new Map();
				}

				return __private.cache[ this.provider ].set( key, value );
			},

			/**
			 * Add the data to cache to a particular key.
			 *
			 * @since 1.4.7
			 *
			 * @example app.cache.as('provider').addTo('connections', connection_id, connection);
			 *
			 * @param {string} key Intended to be a string, but can be everything that Map supports as a key.
			 * @param {string} id ID for a value that should be added to a certain key.
			 * @param {*} value Data you want to save in cache.
			 *
			 * @returns {Map} All the cache for the provider. IE11 returns 'undefined' for an undefined reason.
			 */
			addTo: function( key, id, value ) {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					__private.cache[ this.provider ] = new Map();
					this.set( key, {} );
				}

				var data = this.get( key );
				data[id] = value;

				return this.set(
					key,
					data
				);
			},

			/**
			 * Delete the cache by key.
			 *
			 * @since 1.4.7
			 *
			 * @param {string} key
			 *
			 * @returns boolean|null True on success, null on data holder failure, false on error.
			 */
			delete: function ( key ) {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					return null;
				}

				return __private.cache[ this.provider ].delete( key );
			},

			/**
			 * Delete particular data from a certain key.
			 *
			 * @since 1.4.7
			 *
			 * @example app.cache.as('provider').deleteFrom('connections', connection_id);
			 *
			 * @param {string} key Intended to be a string, but can be everything that Map supports as a key.
			 * @param {string} id ID for a value that should be delete from a certain key.
			 *
			 * @returns {Map} All the cache for the provider. IE11 returns 'undefined' for an undefined reason.
			 */
			deleteFrom: function( key, id ) {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					return null;
				}

				var data = this.get( key );

				delete data[id];

				return this.set(
					key,
					data
				);
			},

			/**
			 * Clear all the cache data.
			 *
			 * @since 1.4.7
			 */
			clear: function () {

				if (
					typeof __private.cache[ this.provider ] === 'undefined' ||
					! __private.cache[ this.provider ] instanceof Map
				) {
					return;
				}

				__private.cache[ this.provider ].clear();
			}
		},

		/**
		 * Start the engine. DOM is not ready yet, use only to init something.
		 *
		 * @since 1.4.7
		 */
		init: function () {

			// Do that when DOM is ready.
			$( document ).ready( app.ready );
		},

		/**
		 * DOM is fully loaded.
		 * Should be hooked into in addons, that need to work with DOM, templates etc.
		 *
		 * @since 1.4.7
		 */
		ready: function () {

			app.providerHolder = $( '.wpforms-builder-provider' );

			app.addTemplates( __private.config.templates );

			app.bindActions();
			app.ui.bindActions();

			$( '#wpforms-panel-providers' ).trigger( 'WPForms.Admin.Builder.Providers.ready' );
		},

		/**
		 * Process all generic actions/events, mostly custom that were fired by our API.
		 *
		 * @since 1.4.7
		 */
		bindActions: function () {

			// On Form save - notify user about required fields.
			$( document ).on( 'wpformsSaved', function () {
				var $connectionBlocks = $( '#wpforms-panel-providers' ).find( '.wpforms-builder-provider-connection' );

				if ( ! $connectionBlocks.length ) {
					return;
				}

				// We need to show him "Required fields empty" popup only once.
				var isShownOnce = false;

				$connectionBlocks.each( function () {
					var isRequiredEmpty = false;
					// Do the actual required fields check.
					$( this ).find( 'input.wpforms-required, select.wpforms-required, textarea.wpforms-required' ).each( function () {
						var value = $( this ).val();
						if ( _.isEmpty( value ) ) {
							$( this ).addClass( 'wpforms-error' );
							isRequiredEmpty = true;
						}
						else {
							$( this ).removeClass( 'wpforms-error' );
						}
					} );

					// Notify user.
					if ( isRequiredEmpty && ! isShownOnce ) {
						var $titleArea = $( this ).closest( '.wpforms-builder-provider' ).find( '.wpforms-builder-provider-title' ).clone();
						$titleArea.find( 'button' ).remove();
						var msg = wpforms_builder.provider_required_flds;

						$.alert( {
							title: wpforms_builder.heads_up,
							content: msg.replace( '{provider}', '<strong>' + $titleArea.text().trim() + '</strong>' ),
							icon: 'fa fa-exclamation-circle',
							type: 'orange',
							buttons: {
								confirm: {
									text: wpforms_builder.ok,
									btnClass: 'btn-confirm',
									keys: [ 'enter' ]
								}
							}
						} );

						// Save that we have already showed the user, so we won't bug it anymore.
						isShownOnce = true;
					}
				} );
			} );

			/*
			 * Update form state when each connection is loaded into the DOM.
			 * This will prevent a please-save-prompt to appear, when navigating
			 * out and back to Marketing tab without doing any changes anywhere.
			 */
			$( '#wpforms-panel-providers' ).on( 'connectionRendered', function() {
				if ( wpf.initialSave === true ) {
					wpf.savedState = wpf.getFormState( '#wpforms-builder-form');
				}
			} );
		},

		/**
		 * All methods that modify UI of a page.
		 *
		 * @since 1.4.7
		 */
		ui: {

			/**
			 * Process UI related actions/events: click, change etc - that are triggered from UI.
			 *
			 * @since 1.4.7
			 */
			bindActions: function() {

				// CONNECTION: ADD/DELETE.
				app.providerHolder
				   .on( 'click', '.js-wpforms-builder-provider-connection-add', function ( e ) {
					   e.preventDefault();

					   app.ui.connectionAdd();
				   } )
				   .on( 'click', '.js-wpforms-builder-provider-connection-delete', function ( e ) {
					   e.preventDefault();

					   app.ui.connectionDelete(
						   $( this ).closest( '.wpforms-builder-provider-connection' )
					   );
				   } );

				// CONNECTION: FIELDS - ADD/DELETE.
				app.providerHolder
				   .on( 'click', '.js-wpforms-builder-provider-connection-fields-add', function ( e ) {
					   e.preventDefault();

					   var $table = $( this ).parents( '.wpforms-builder-provider-connection-fields-table' ),
						   $clone = $table.find( 'tr' ).last().clone( true ),
						   nextID = parseInt( /\[(\d+)\]/g.exec( $clone.find( 'input' ).attr( 'name' ) )[ 1 ], 10 ) + 1;

					   // Clear the row and increment the counter.
					   $clone.find( 'input' )
							 .attr( 'name', $clone.find( 'input' ).attr( 'name' ).replace( /\[fields_meta\]\[(\d+)\]/g, '[fields_meta][' + nextID + ']' ) )
							 .val( '' );
					   $clone.find( 'select' )
							 .attr( 'name', $clone.find( 'select' ).attr( 'name' ).replace( /\[fields_meta\]\[(\d+)\]/g, '[fields_meta][' + nextID + ']' ) )
							 .val( '' );

					   // Re-enable "delete" button.
					   $clone.find( '.js-wpforms-builder-provider-connection-fields-delete' ).removeClass( 'hidden' );

					   // Put it back to the table.
					   $table.find( 'tbody' ).append( $clone.get( 0 ) );
				   } )
				   .on( 'click', '.js-wpforms-builder-provider-connection-fields-delete', function ( e ) {
					   e.preventDefault();

					   var $row = $( this ).parents( '.wpforms-builder-provider-connection-fields-table tr' );

					   $row.remove();
				   } );
			},

			/**
			 * Add a connection to a page.
			 * This is a multi-step process, where the 1st step is always the same for all providers.
			 *
			 * @since 1.4.7
			 */
			connectionAdd: function() {

				$.confirm( {
					title: false,
					content: wpforms_builder_providers.prompt_connection.replace( /%type%/g, 'connection' )
					+ '<input autofocus="" type="text" id="wpforms-builder-provider-connection-name" placeholder="' + wpforms_builder_providers.prompt_placeholder + '">'
					+ '<p class="error">' + wpforms_builder_providers.error_name + '</p>',
					backgroundDismiss: false,
					closeIcon: false,
					icon: 'fa fa-info-circle',
					type: 'blue',
					buttons: {
						confirm: {
							text: wpforms_builder.ok,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
							action: function () {
								var name = this.$content.find( '#wpforms-builder-provider-connection-name' ).val(),
									error = this.$content.find( '.error' );

								if ( name === '' ) {
									error.show();
									return false;
								}
								else {
									app.providerHolder.trigger( 'connectionCreate', [ name ] );
								}
							}
						},
						cancel: {
							text: wpforms_builder.cancel
						}
					}
				} );

			},

			/**
			 * What to do with UI when connection is deleted.
			 *
			 * @since 1.4.7
			 *
			 * @param {Object} $connection jQuery DOM element for a connection.
			 */
			connectionDelete: function( $connection ) {

				$.confirm( {
					title: false,
					content: wpforms_builder_providers.confirm_connection,
					icon: 'fa fa-exclamation-circle',
					type: 'orange',
					buttons: {
						confirm: {
							text: wpforms_builder.ok,
							btnClass: 'btn-confirm',
							keys: [ 'enter' ],
							action: function () {
								// We need this BEFORE removing, as some handlers might need DOM element.
								app.providerHolder.trigger( 'connectionDelete', [ $connection ] );

								$connection.fadeOut( 'fast', function () {
									$( this ).remove();

									app.providerHolder.trigger( 'connectionDeleted', [ $connection ] );
								} );
							}
						},
						cancel: {
							text: wpforms_builder.cancel
						}
					}
				} );
			}
		},

		/**
		 * Set a current provider.
		 *
		 * @since 1.4.7
		 *
		 * @param {string} provider Slug of a provider.
		 */
		setProvider: function ( provider ) {
			app.provider = provider;
		},

		/**
		 * Get a jQuery DOM object, that has all the provider-related DOM inside.
		 *
		 * @since 1.4.7
		 *
		 * @returns {Object} jQuery DOM element.
		 */
		getProviderHolder: function () {
			return $( '#' + app.provider + '-provider' );
		},

		/**
		 * Register and compile all templates.
		 * All data is saved in a Map.
		 *
		 * @since 1.4.7
		 *
		 * @param {string[]} templates Array of template names.
		 */
		addTemplates: function ( templates ) {

			templates.forEach( function ( template ) {
				__private.previews.set( template, wp.template( template ) );
			} );
		},

		/**
		 * Get a templating function (to compile later with data).
		 *
		 * @since 1.4.7
		 *
		 * @param {string} template ID of a template to retrieve from a cache.
		 *
		 * @returns {*} After compiling will always return a string.
		 */
		getTemplate: function ( template ) {

			var preview = __private.previews.get( template );

			if ( typeof preview !== 'undefined' ) {
				return preview;
			}

			return function () {
				return '';
			};
		}

		////
	};

	// Provide access to public functions/properties.
	return app;

})( document, window, jQuery );

// Initialize.
WPForms.Admin.Builder.Providers.init();
