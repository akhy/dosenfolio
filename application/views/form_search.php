		<div id="searchBox">
			<div id="searchBoxInner">
				<?php $this->load->helper('form') ?>
				<?php echo form_open('staff'); ?>
					Search staff name:
					<input type="text" autocomplete="off" name="searchString" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
					<input type="submit" value="Search" />
				<?php echo form_close() ?>
				
				
			</div>
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</div>
			</div>
		</div>