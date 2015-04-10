<h2>Edit Flag <?php echo pf_add_new_button(); ?></h2>

<div id="poststuff">
	<div id="post-body" class="metabox-holder columns-2">
		<div id="post-body-content">

			<form action="admin-post.php" method="post" name="edit-form">
				<input type="hidden" name="action" value="pf_update_flag"/>
				<input type="hidden" name="id" value="<?php echo $id ?>"/>

				<div class="pf-form-field primary">
					<input type="text" name="name" id="name" value="<?php echo $name ?>"/>
				</div>
				<div class="pf-form-field">
					<label for="slug">Slug</label>
					<input type="text" name="slug" id="slug" value="<?php echo $slug ?>"/>
					<p class="legend">
						Use in your template: <code>do_shortcode('[flag slug="<?php echo $slug ?>"]');</code>
					</p>
				</div>
				<div class="pf-form-field">
					<label for="unflagged_code">Unflagged Code</label>
					<textarea name="unflagged_code" id="unflagged_code" cols="30" rows="5"><?php echo $unflagged_code ?></textarea>
					<p class="legend">
						Use html whithout quotes. e.g. <code>&lt;img src=star.png /&gt;</code>
					</p>
				</div>
				<div class="pf-form-field">
					<label for="flagged_code">Flagged Code</label>
					<textarea name="flagged_code" id="flagged_code" cols="30" rows="5"><?php echo $flagged_code ?></textarea>
					<p class="legend">
						Use html whithout quotes. e.g. <code>&lt;img src=star.png /&gt;</code>
					</p>
				</div>
				<div>
					<a class="button button-large" href="options-general.php?page=post-flagger-options">Cancel</a>
					<input type="submit" class="button button-primary button-large" value="Update Flag"/>
				</div>
			</form>

		</div>
	</div>
</div>

