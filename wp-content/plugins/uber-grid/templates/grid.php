<?php if ($this->font_families()): ?>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=<?php echo urlencode(implode('|', $this->font_families())) ?>">
<?php endif ?>

<style>
    @keyframes un-loader {
      0% {transform: rotate(0); }
      100% {transform: rotate(360deg);}
    }
    body div.uber-grid-loader {
        position: relative;
        width: 35px;
        height: 35px;
        animation: un-loader infinite .75s linear;
        border: 6px solid #EAEAEA;
        border-left-color: #999;
        border-radius: 100%;
        display: block;
        margin: 25px auto !important;
    }
</style>

<div class="<?php echo $this->get_classes() ?>"
    id="uber-grid-wrapper-<?php echo $this->id ?>"
    data-slug="<?php echo esc_attr($this->slug) ?>"
    data-effect="<?php echo $this['effects']['hover'] ?>">
<div class="uber-grid-loader"></div>
<?php $tags = $this->get_tags($cells) ?>
<?php if (count($tags)): ?>
    <div class="uber-grid-filters">
        <?php if (!$this['filters']['exclude_all']): ?>
                <div><a href="#"><?php _e($this['filters']['all'], 'uber-grid')?></a></div>
        <?php endif ?>
        <?php foreach($tags as $tag): ?>
                <div><a href="#<?php echo esc_attr(sanitize_title($tag)) ?>"><?php echo esc_html($tag)?></a></div>
        <?php endforeach ?>
    </div>
<?php endif ?>
	<div class="uber-grid-cells-wrapper">
		<div class="<?php echo $this->grid_classes() ?>" id="uber-grid-<?php echo $this->id ?>" data-cell-width="<?php echo $this['layout']['cell_width'] ?>" data-cell-border="<?php echo $this['layout']['cell_border_width'] ?>" data-cell-gap="<?php echo $this['layout']['cell_gap'] ?>">
			<?php $this->render_cells($cells, $options) ?>
		</div>
	</div>
	<?php if ($this['pagination']['enable']): ?>
		<div class="uber-grid-pagination"></div>
	<?php endif ?>
</div>
<script>
(function(){
    var id = 'uber-grid-wrapper-<?php echo $this->id ?>';
    var el = document.getElementById(id);
    var options = <?php echo json_encode(wp_parse_args(
        array('lightbox_enable' => $options['lightbox']),
        $this->js_options())) ?>;
    function isVisible() {
        return el.offsetWidth !== 0 || el.offsetHeight !== 0; }
    function runWhen(condition, callback) {
        function run() {
            if (condition()) {
                callback();
            } else {
                setTimeout(run, 500);
            }
        }
        run()
    }
    function show() { window.ubergrid(el, options); }
    function ready(callback) {
        if (document.readyState == 'complete') {
            setTimeout(callback, 0);
        } else {
            document.addEventListener("DOMContentLoaded", callback);
        }
    }
    function loadScript(callback, url, id){
        var script = document.getElementById(id);
        if (!script) {
            script = document.createElement('SCRIPT')
            script.setAttribute('src', url);
            script.id = id;
            script.addEventListener('load', callback);
            document.documentElement.appendChild(script)
        } else {
            script.addEventListener('load', callback);
        }
    }
    function run(e) {
			setTimeout(function() {
					runWhen(isVisible, show);
			}, 100);
		}
    ready(function(){
        if (window.ubergrid) {
            run()
        } else {
            loadScript(run, options.scriptUrl, 'uber-grid-script');
        }
    });
})();
</script>
