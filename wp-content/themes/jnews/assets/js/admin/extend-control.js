( function( api, $ ) {

    api.control( 'jnews_additional_js', function setupCustomCssControl( control ) {
        control.deferred.embedded.done( function allowTabs() {
            var $textarea = control.container.find( 'textarea' ), textarea = $textarea[0];

            $textarea.on( 'blur', function onBlur() {
                $textarea.data( 'next-tab-blurs', false );
            } );

            $textarea.on( 'keydown', function onKeydown( event ) {
                var selectionStart, selectionEnd, value, tabKeyCode = 9, escKeyCode = 27;

                if ( escKeyCode === event.keyCode ) {
                    if ( ! $textarea.data( 'next-tab-blurs' ) ) {
                        $textarea.data( 'next-tab-blurs', true );
                        event.stopPropagation(); // Prevent collapsing the section.
                    }
                    return;
                }

                // Short-circuit if tab key is not being pressed or if a modifier key *is* being pressed.
                if ( tabKeyCode !== event.keyCode || event.ctrlKey || event.altKey || event.shiftKey ) {
                    return;
                }

                // Prevent capturing Tab characters if Esc was pressed.
                if ( $textarea.data( 'next-tab-blurs' ) ) {
                    return;
                }

                selectionStart = textarea.selectionStart;
                selectionEnd = textarea.selectionEnd;
                value = textarea.value;

                if ( selectionStart >= 0 ) {
                    textarea.value = value.substring( 0, selectionStart ).concat( '\t', value.substring( selectionEnd ) );
                    $textarea.selectionStart = textarea.selectionEnd = selectionStart + 1;
                }

                event.stopPropagation();
                event.preventDefault();
            } );
        } );
    } );

} )( wp.customize, jQuery );