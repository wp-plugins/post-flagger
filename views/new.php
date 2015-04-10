<h2>Add New Flag</h2>

<div id="poststuff">
	<div id="post-body" class="metabox-holder columns-2">
		<div id="post-body-content">

			<form action="admin-post.php" method="post" name="edit-form">
				<input type="hidden" name="action" value="pf_create_flag"/>

				<div class="pf-form-field primary">
					<input type="text" name="name" id="name" placeholder="Add a flag name"/>
				</div>
				<div class="pf-form-field">
					<label for="slug">Slug</label>
					<input type="text" name="slug" id="slug" placeholder="e.g. view"/>
				</div>
				<div class="pf-form-field">
					<label for="unflagged_code">Unflagged Code</label>
					<textarea name="unflagged_code" id="unflagged_code" cols="30" rows="5"></textarea>
				</div>
				<div class="pf-form-field">
					<label for="flagged_code">Flagged Code</label>
					<textarea name="flagged_code" id="flagged_code" cols="30" rows="5"></textarea>
				</div>
				<div>
					<a class="button button-large" href="options-general.php?page=post-flagger-options">Cancel</a>
					<input type="submit" class="button button-primary button-large" value="Create Flag"/>
				</div>
			</form>

		</div>
	</div>
</div>

