<?php
class YOP_Poll_View {

    /**
     * -------------------------------------
     * Render a Template.
     * -------------------------------------
     *
     * @param $filePath - include path to the template.
     * @param null $viewData - any data to be used within the template.
     * @return string -
     *
     */
    public static function render( $filePath, $viewData = null ) {
        // Was any data sent through?
        ( $viewData ) ? extract( $viewData ) : null;
        ob_start();
        include ( $filePath );
        $template = ob_get_contents();
        ob_end_clean();
        return $template;
    }
}
