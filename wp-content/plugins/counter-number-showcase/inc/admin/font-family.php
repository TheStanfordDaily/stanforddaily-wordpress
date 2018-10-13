<select name="font_family" id="font_family" class="standard-dropdown" onchange="get_font_group()"  style="width:100%" >
	<optgroup label="Default Fonts">
		<option value="Arial"           <?php if($font_family == 'Arial' ) { echo "selected"; } ?>>Arial</option>
		<option value="Arial Black"    <?php if($font_family == 'Arial Black' ) { echo "selected"; } ?>>Arial Black</option>
		<option value="Courier New"     <?php if($font_family == 'Courier New' ) { echo "selected"; } ?>>Courier New</option>
		<option value="Georgia"         <?php if($font_family == 'Georgia' ) { echo "selected"; } ?>>Georgia</option>
		<option value="Grande"          <?php if($font_family == 'Grande' ) { echo "selected"; } ?>>Grande</option>
		<option value="Helvetica" 	<?php if($font_family == 'Helvetica' ) { echo "selected"; } ?>>Helvetica Neue</option>
		<option value="Impact"         <?php if($font_family == 'Impact' ) { echo "selected"; } ?>>Impact</option>
		<option value="Lucida"         <?php if($font_family == 'Lucida' ) { echo "selected"; } ?>>Lucida</option>
		<option value="Lucida Grande"         <?php if($font_family == 'Lucida Grande' ) { echo "selected"; } ?>>Lucida Grande</option>
		<option value="Open Sans"   <?php if($font_family == 'Open Sans' ) { echo "selected"; } ?>>Open Sans</option>
		<option value="OpenSansBold"   <?php if($font_family == 'OpenSansBold' ) { echo "selected"; } ?>>OpenSansBold</option>
		<option value="Palatino Linotype"       <?php if($font_family == 'Palatino Linotype' ) { echo "selected"; } ?>>Palatino</option>
		<option value="Sans"           <?php if($font_family == 'Sans' ) { echo "selected"; } ?>>Sans</option>
		<option value="sans-serif"           <?php if($font_family == 'sans-serif' ) { echo "selected"; } ?>>Sans-Serif</option>
		<option value="Tahoma"         <?php if($font_family == 'Tahoma' ) { echo "selected"; } ?>>Tahoma</option>
		<option value="Times New Roman"          <?php if($font_family == 'Times New Roman' ) { echo "selected"; } ?>>Times New Roman</option>
		<option value="Trebuchet"      <?php if($font_family == 'Trebuchet' ) { echo "selected"; } ?>>Trebuchet</option>
		<option value="Verdana"        <?php if($font_family == 'Verdana' ) { echo "selected"; } ?>>Verdana</option>
	</optgroup>
</select>