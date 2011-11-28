<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="nice">
	<label for="s"><?php _e( "Search", "custom" ); ?></label>
	<input type="text" class="small input-text" name="s" id="s" placeholder="<?php esc_attr_e( "Search", "custom" ); ?>" />
	<input type="submit" class="button small radius" name="submit" id="searchsubmit" value="<?php esc_attr_e( "Search", "custom" ); ?>" />
</form>