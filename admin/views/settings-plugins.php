<?php if ( is_array( $all_plugins ) && count( $all_plugins ) ) : ?>
	<table class="widefat plugins">
		<thead>
		<tr>
			<th></th>
			<th style="padding-left: 10px;"><?php _e( 'Plugin', 'plugin-conflicts' ); ?></th>
			<th style="padding-left: 10px;"><?php _e( 'Active', 'plugin-conflicts' ); ?></th>
			<?php /* <th style="padding-left: 10px;"><?php _e( 'switching', 'plugin-conflicts' ); ?></th>*/ ?>
			<th style="padding-left: 10px;"><?php _e( 'Inactive', 'plugin-conflicts' ); ?></th>
			<th style="padding-left: 10px;"><?php _e( 'Original Status', 'plugin-conflicts' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $all_plugins as $_plugin_path => $_plugin ) :
			// load status
			if ( isset( $plugins[ $_plugin_path ] ) ) {
				$status = $plugins[ $_plugin_path ];
			} else {
				if ( is_plugin_active( $_plugin_path ) ) {
					$status = 'active';
				} else {
					$status = 'inactive';
				}
			}
			?>
			<tr class="<?php echo $status; ?>">
				<th class="check-column"></th>
				<td><?php echo $_plugin['Name']; ?></td>
				<td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]"
				           value="active" <?php checked( 'active', $status ); ?>></td>
				<?php /* <td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]" value="switching" <?php checked( 'switching', $status ); ?>></td>*/ ?>
				<td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]"
				           value="inactive" <?php checked( 'inactive', $status ); ?>></td>
				<td><?php echo is_plugin_active( $_plugin_path ) ? '<span style="color: #0073aa">active</span>' : '<span style="color: #a0a5aa">inactive</span>'; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
		<tr>
			<th></th>
			<th style="padding-left: 10px;"><?php _e( 'Plugin', 'plugin-conflicts' ); ?></th>
			<th style="padding-left: 10px;"><?php _e( 'Active', 'plugin-conflicts' ); ?></th>
			<?php /* <th style="padding-left: 10px;"><?php _e( 'switching', 'plugin-conflicts' ); ?></th>*/ ?>
			<th style="padding-left: 10px;"><?php _e( 'Inactive', 'plugin-conflicts' ); ?></th>
			<th style="padding-left: 10px;"><?php _e( 'Original Status', 'plugin-conflicts' ); ?></th>
		</tr>
		</tfoot>
	</table>
	<?php
endif;
