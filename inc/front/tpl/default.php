<style>
/* CSS style applies only to tables with .rt-reviews class and not mess up other tables on the same page */
table.rt-reviews { border-collapse: collapse; text-align: center; width: 100%; font-size: 14px; }
table.rt-reviews tr { background: white; border-bottom: 1px solid }
table.rt-reviews th { background-color: #ffcc00; text-align: center; }
table.rt-reviews th, table.rt-reviews td { padding: 10px 20px; width: 25%; }
table.rt-reviews td span { background: #eee; color: dimgrey; display: none; font-size: 10px; font-weight: bold; padding: 5px; position: absolute; text-transform: uppercase; top: 0; left: 0; }
table.rt-reviews .img-responsive { max-width: 100%; height: auto; }
table.rt-reviews .btn-play { display: block; background-color: green; color: #fff; padding: 10px; border-radius: 5px; text-decoration: none; }
table.rt-reviews .small { font-size: 80%; margin-top: 10px; }
table.rt-reviews .text-left { text-align: left; }
table.rt-reviews ul { margin: 0; padding: 0; list-style: none; }
table.rt-reviews ul li { margin: 0; padding: 0; list-style: none; background-image: url( data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaWQ9IkxheWVyXzEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA3OTI7IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA2MTIgNzkyIiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPgoJLnN0MHtmaWxsOiM0MUFENDk7fQo8L3N0eWxlPjxnPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik01NjIsMzk2YzAtMTQxLjQtMTE0LjYtMjU2LTI1Ni0yNTZTNTAsMjU0LjYsNTAsMzk2czExNC42LDI1NiwyNTYsMjU2UzU2Miw1MzcuNCw1NjIsMzk2TDU2MiwzOTZ6ICAgIE01MDEuNywyOTYuM2wtMjQxLDI0MWwwLDBsLTE3LjIsMTcuMkwxMTAuMyw0MjEuM2w1OC44LTU4LjhsNzQuNSw3NC41bDE5OS40LTE5OS40TDUwMS43LDI5Ni4zTDUwMS43LDI5Ni4zeiIvPjwvZz48L3N2Zz4= ); background-position: left top; background-repeat: no-repeat; background-size: 18px; padding-left: 30px }
table.rt-reviews .star-review {
	background-image: url( data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iNTEycHgiIGlkPSJMYXllcl8xIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4IiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48cGF0aCBkPSJNNDgwLDIwN0gzMDguNkwyNTYsNDcuOUwyMDMuNCwyMDdIMzJsMTQwLjIsOTcuOUwxMTcuNiw0NjRMMjU2LDM2NS40TDM5NC40LDQ2NGwtNTQuNy0xNTkuMUw0ODAsMjA3eiBNMzYyLjYsNDIxLjIgIGwtMTA2LjYtNzZsLTEwNi42LDc2TDE5MiwyOTguN0w4NCwyMjRoMTMxbDQxLTEyMy4zTDI5NywyMjRoMTMxbC0xMDgsNzQuNkwzNjIuNiw0MjEuMnoiLz48L3N2Zz4= ); background-position: left center; background-repeat: repeat-x; background-size: contain; height: 30px; width: 150px; margin: 0 auto; filter: invert(39%) sepia(96%) saturate(1720%) hue-rotate(1deg) brightness(103%) contrast(105%);
}
table.rt-reviews .review {
	background-image: url( data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iNTEycHgiIGlkPSJMYXllcl8xIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB4IiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48cG9seWdvbiBwb2ludHM9IjQ0OCwyMDggMzAxLDIwOCAyNTYsNjQgMjExLDIwOCA2NCwyMDggMTgzLjEsMjk3LjMgMTM2LDQ0OCAyNTYsMzUyIDM3Niw0NDggMzI4LjksMjk3LjMgIi8+PC9zdmc+ ); background-position: left center; background-repeat: repeat-x; background-size: contain; height: 30px; width: 0; filter: invert(0%) sepia(96%) saturate(1720%) hue-rotate(1deg) brightness(103%) contrast(105%);
}

/* Simple CSS for flexbox table on mobile */
@media(max-width: 800px) {
	table.rt-reviews thead { left: -9999px; position: absolute; visibility: hidden; }
    table.rt-reviews tr { border-bottom: 0; display: flex; flex-direction: row; flex-wrap: wrap; margin-bottom: 40px; }
    table.rt-reviews td { border: 1px solid; margin: 0 -1px -1px 0; position: relative; width: 50%; }
    table.rt-reviews td span { display: block; }
}
@media(max-width: 400px) { 
	table.rt-reviews td { width: 100%; }
}
</style>
<table class="rt-reviews">
	<thead>
		<tr>
			<th><?php _e( 'Casino', 'raketech' );?></th>
			<th><?php _e( 'Bonus', 'raketech' );?></th>
			<th><?php _e( 'Features', 'raketech' );?></th>
			<th><?php _e( 'Play', 'raketech' );?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<a href="<?php echo isset( $review_data['brand_id'] ) ? home_url( '/' . $review_data['brand_id'] ) : '#';?>">
					<img src="<?php echo esc_url( $review_data['logo'] ); ?>" class="img-responsive" />
				</a>
				<div class="mt-2">
					<a href="<?php echo isset( $review_data['brand_id'] ) ? home_url( '/' . $review_data['brand_id'] ) : '#';?>">
						<?php _e( 'Review', 'raketech' );?>
					</a>
				</div>
			</td>
			<td>
				<div class="star-review">
					<?php if( isset( $review_data['info']['rating'] ) && (int)$review_data['info']['rating'] > 0 ) { ?>
					<div class="review" style="width: <?php echo round( ( 100 / 5 ) * (int)$review_data['info']['rating'] );?>%;"></div>
					<?php } ?>
				</div>
				<div><?php echo isset( $review_data['info']['bonus'] ) ? $review_data['info']['bonus'] : '';?></div>
			</td>
			<td class="text-left">
				<?php if( isset( $review_data['info']['features'] ) && ! empty( $review_data['info']['features'] ) && is_array( $review_data['info']['features'] ) ) { ?>
				<ul>
					<?php foreach( $review_data['info']['features'] as $feature ) { if( ! empty( $feature ) ) { ?>
					<li><?php echo $feature;?></li>
					<?php } } ?>
				</ul>
				<?php } ?>
			</td>
			<td>
				<a href="<?php echo isset( $review_data['play_url'] ) ? esc_url( $review_data['play_url'] ) : '#';?>" title="<?php esc_attr_e( 'Click to Play', 'raketech' );?>" class="btn-play">
					<?php _e( 'PLAY NOW', 'raketech' );?>
				</a>
				<div class="small">
					<?php echo isset( $review_data['terms_and_conditions'] ) ? $review_data['terms_and_conditions'] : '';?>
				</div>
			</td>
		</tr>
	</tbody>
</table>