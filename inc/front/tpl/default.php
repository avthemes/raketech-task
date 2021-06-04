<tr <?php echo ( $tpl == "admin" && isset( $review_data['brand_id'] )  ? 'id="' . $review_data['brand_id'] . '"': '' ); ?>>
	<?php if( $tpl == "admin" ) { ?>
	<td class="admin-cell" width="40" title="<?php esc_attr( 'Click and drag to sort', 'raketech' );?>">
		<img src="<?php echo plugins_url( '/inc/assets/images/arrow-up.png', RT_PLUGIN_URL );?>" alt="<?php esc_attr_e( 'Move up', 'raketech' );?>" />
		<img src="<?php echo plugins_url( '/inc/assets/images/arrow-down.png', RT_PLUGIN_URL );?>" alt="<?php esc_attr_e( 'Move down', 'raketech' );?>" />
	</td>
	<?php } ?>
	<td class="rcell">
		<a href="<?php echo isset( $review_data['brand_id'] ) ? home_url( '/' . $review_data['brand_id'] ) : '#';?>">
			<img src="<?php echo esc_url( $review_data['logo'] ); ?>" class="img-responsive" />
		</a>
		<div class="mt-2">
			<a href="<?php echo isset( $review_data['brand_id'] ) ? home_url( '/' . $review_data['brand_id'] ) : '#';?>">
				<?php _e( 'Review', 'raketech' );?>
			</a>
		</div>
	</td>
	<td class="rcell">
		<div class="star-review">
			<?php if( isset( $review_data['info']['rating'] ) && (int)$review_data['info']['rating'] > 0 ) { ?>
			<div class="review" style="width: <?php echo round( ( 100 / 5 ) * (int)$review_data['info']['rating'] );?>%;"></div>
			<?php } ?>
		</div>
		<div><?php echo isset( $review_data['info']['bonus'] ) ? $review_data['info']['bonus'] : '';?></div>
	</td>
	<td class="rcell text-left">
		<?php if( isset( $review_data['info']['features'] ) && ! empty( $review_data['info']['features'] ) && is_array( $review_data['info']['features'] ) ) { ?>
		<ul>
			<?php foreach( $review_data['info']['features'] as $feature ) { if( ! empty( $feature ) ) { ?>
			<li><?php echo $feature;?></li>
			<?php } } ?>
		</ul>
		<?php } ?>
	</td>
	<td class="rcell">
		<a href="<?php echo isset( $review_data['play_url'] ) ? esc_url( $review_data['play_url'] ) : '#';?>" title="<?php esc_attr_e( 'Click to Play', 'raketech' );?>" class="btn-play">
			<?php _e( 'PLAY NOW', 'raketech' );?>
		</a>
		<div class="small">
			<?php echo isset( $review_data['terms_and_conditions'] ) ? $review_data['terms_and_conditions'] : '';?>
		</div>
	</td>
</tr>