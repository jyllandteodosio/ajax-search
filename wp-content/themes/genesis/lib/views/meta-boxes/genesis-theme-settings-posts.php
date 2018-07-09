<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/genesis/
 */

?>
<table class="form-table">
<tbody>

	<tr valign="top">
		<th scope="row"><label for="<?php $this->field_id( 'content_archive' ); ?>"><?php esc_html_e( 'Display', 'genesis' ); ?></label></th>
		<td>
			<select name="<?php $this->field_name( 'content_archive' ); ?>" id="<?php $this->field_id( 'content_archive' ); ?>">
			<?php
			$archive_display = apply_filters(
				'genesis_archive_display_options',
				array(
					'full'     => __( 'Entry content', 'genesis' ),
					'excerpts' => __( 'Entry excerpts', 'genesis' ),
				)
			);
			foreach ( (array) $archive_display as $value => $name ) {
				echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->get_field_value( 'content_archive' ), esc_attr( $value ), false ) . '>' . esc_html( $name ) . '</option>' . "\n";
			}
			?>
			</select>
		</td>
	</tr>

	<tr id="genesis_content_limit_setting" valign="top">
		<th scope="row"><label for="<?php $this->field_id( 'content_archive_limit' ); ?>"><?php esc_html_e( 'Limit content to', 'genesis' ); ?></label></th>
		<td>
			<input type="text" name="<?php $this->field_name( 'content_archive_limit' ); ?>" class="small-text" id="<?php $this->field_id( 'content_archive_limit' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'content_archive_limit' ) ); ?>" />
			<?php esc_html_e( 'characters', 'genesis' ); ?>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Featured Image', 'genesis' ); ?></th>
		<td>
			<p><label for="<?php $this->field_id( 'content_archive_thumbnail' ); ?>"><input type="checkbox" name="<?php $this->field_name( 'content_archive_thumbnail' ); ?>" id="<?php $this->field_id( 'content_archive_thumbnail' ); ?>" value="1"<?php checked( $this->get_field_value( 'content_archive_thumbnail' ) ); ?> />
	<?php esc_html_e( 'Include the Featured Image?', 'genesis' ); ?></label></p>

			<div id="genesis_image_extras">
				<p>
					<label for="<?php $this->field_id( 'image_size' ); ?>"><?php esc_html_e( 'Image Size:', 'genesis' ); ?></label>
					<select name="<?php $this->field_name( 'image_size' ); ?>" id="<?php $this->field_id( 'image_size' ); ?>">
					<?php
					$sizes = genesis_get_image_sizes();
					foreach ( (array) $sizes as $name => $size )
						echo '<option value="' . esc_attr( $name ) . '"' . selected( $this->get_field_value( 'image_size' ), $name, FALSE ) . '>' . esc_html( $name ) . ' (' . absint( $size['width'] ) . ' &#x000D7; ' . absint( $size['height'] ) . ')</option>' . "\n";
					?>
					</select>
				</p>

				<p>
					<label for="<?php $this->field_id( 'image_alignment' ); ?>"><?php esc_html_e( 'Image Alignment:', 'genesis' ); ?></label>
					<select name="<?php $this->field_name( 'image_alignment' ); ?>" id="<?php $this->field_id( 'image_alignment' ); ?>">
						<option value=""><?php esc_html_e( '- None -', 'genesis' ) ?></option>
						<option value="alignleft" <?php selected( $this->get_field_value( 'image_alignment' ), 'alignleft' ); ?>><?php esc_html_e( 'Left', 'genesis' ) ?></option>
						<option value="alignright" <?php selected( $this->get_field_value( 'image_alignment' ), 'alignright' ); ?>><?php esc_html_e( 'Right', 'genesis' ) ?></option>
                <option value="aligncenter" <?php selected( $this->get_field_value( 'image_alignment' ), 'aligncenter' ); ?>><?php _e( 'Center', 'genesis' ) ?></option>
					</select>
				</p>
			</div>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="<?php $this->field_id( 'posts_nav' ); ?>"><?php esc_html_e( 'Entry Pagination', 'genesis' ); ?></label></th>
		<td>
			<p><select name="<?php $this->field_name( 'posts_nav' ); ?>" id="<?php $this->field_id( 'posts_nav' ); ?>">
				<option value="prev-next"<?php selected( 'prev-next', $this->get_field_value( 'posts_nav' ) ); ?>><?php esc_html_e( 'Previous / Next', 'genesis' ); ?></option>
				<option value="numeric"<?php selected( 'numeric', $this->get_field_value( 'posts_nav' ) ); ?>><?php esc_html_e( 'Numeric', 'genesis' ); ?></option>
			</select></p>

			<p><span class="description"><?php esc_html_e( 'These options will affect any blog listings page, including archive, author, blog, category, search, and tag pages.', 'genesis' ); ?></span></p>
		</td>
	</tr>

</tbody>
</table>
