<?php
$title = strip_tags( $instance['title'] );
$menu  = strip_tags( $instance['menu'] );
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

?>			
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'bcmw' ); ?>: 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'menu' ); ?>"><?php _e( 'Choose menu', 'bcmw' ); ?>: 
		<select id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>">

			<?php foreach( $menus as $custom_menu ): ?>

				<option value="<?php echo $custom_menu->term_id; ?>" <?php if( $menu == $custom_menu->term_id ): ?>selected="selected"<?php endif; ?>><?php echo $custom_menu->name; ?></option>

			<?php endforeach; ?>

		</select>
	</label>
</p>