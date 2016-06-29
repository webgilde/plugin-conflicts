<?php if ( is_array( $all_plugins ) && count( $all_plugins ) ) : 
?><table>
    <tbody>
    <th><?php _e( 'plugin', 'plugin-conflicts' ); ?></th>
    <th><?php _e( 'active', 'plugin-conflicts' ); ?></th>
    <?php /* <th><?php _e( 'switching', 'plugin-conflicts' ); ?></th>*/?>
    <th><?php _e( 'inactive', 'plugin-conflicts' ); ?></th>
    </tbody>
    <?php
foreach ( $all_plugins as $_plugin_path => $_plugin ) :
    // load status
    if ( isset( $plugins[ $_plugin_path ] ) ) {
        $status = $plugins[ $_plugin_path ];
    } else {
        if(is_plugin_active( $_plugin_path )){
            $status = 'active';
        } else {
            $status = 'inactive';
        }
    }
    ?><tr>
        <td><?php echo $_plugin['Name']; ?></td>
        <td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]" value="active" <?php checked( 'active', $status ); ?>></td>
        <?php /* <td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]" value="switching" <?php checked( 'switching', $status ); ?>></td>*/ ?>
        <td><input type="radio" name="<?php echo PC_SLUG; ?>[plugins][<?php echo $_plugin_path; ?>]" value="inactive" <?php checked( 'inactive', $status ); ?>></td>
</tr><?php
endforeach;
?></table><?php
endif;