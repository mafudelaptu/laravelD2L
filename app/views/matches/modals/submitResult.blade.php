<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
	aria-hidden="true">×</button>
	<h3 id="myModalLabel">Submit your Match result</h3>
</div>

<div class="modal-body">

	<div class="alert alert-warning">
		<h4>Warning:</h4>
		you can't change your submission afterwards, please be sure you
		submit the right result!
	</div>

	<div align="center">
		<div class="h2">Your Team:</div>
		<div class="alert alert-danger hide" data-dismiss="alert"
		id="checkWinLoseErrorDiv">
		Please
		select, whether your team won or lost!
	</div>
	<div class="btn-group btn-group-lg" data-toggle="buttons"
	id="checkWinLose">
	<label class="btn btn-success" for="checkWinLoseWon">
		<input type="radio" name="result" id="checkWinLoseWon" value="won"> Won
	</label>
	<label class="btn btn-danger" for="checkWinLoseLost">
		<input type="radio" name="result" id="checkWinLoseLost" value="lost"> Lost
	</label>
</div>

</div>
<div class="control-group hide" id="screenshotUploadForm">
	<label class="control-label" for="screenshotUpload">Screenshot:<a
		href="help.php#ScreenshotUpload" target="_blank"><i
		class="icon-question-sign t"
		title="How should the Screenshot look like?"></i></a></label>
		<div class="controls">
			<input id="screenshotUpload" type="file" name="files"
			data-url="inc/jquery_fileUpload/server/php/" accept="image/*">
			<div id="progress" class="progress hide">
				<div class="bar" style="width: 0%;"></div>
			</div>
			<div id="fileUploaded"></div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button id="myModalCancelButton" class="btn btn-default" data-dismiss="modal"
	aria-hidden="true">Cancel</button>
	<button type="submit" id="submitMatchResultButton"
	class="btn btn-success">Submit
	result!</button>
</div>
