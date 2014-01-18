<div class="entryButtonWrapper">
  <button type="button" class="btn" id="cancelComposeButton">Close</button>
  <button type="button" class="btn btn-primary"  id="saveButton"><span class="glyphicon glyphicon-ok"></span>Save</button>
  <select class="form-control">
    <option>Personal</option>
    @foreach(Auth::user()->groups as $group)
      <option>{{ $group->name }}</option>
    @endforeach
  </select>
</div>


<div id="toolbarWrapper">
  <div id="toolbar" style="display: none;">
    
    <a data-wysihtml5-command="bold" title="CTRL+B"><span class="glyphicon glyphicon-bold"></span></a> |
    <a data-wysihtml5-command="italic" title="CTRL+I"><span class="glyphicon glyphicon-italic"></span></a> |
    <a data-wysihtml5-command="createLink"><span class="glyphicon glyphicon-link"></span></a> |
    <a data-wysihtml5-command="insertImage">insert image</a> |
    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">h1</a> |
    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">h2</a> |
    <a data-wysihtml5-command="insertUnorderedList">insertUnorderedList</a> |
    <a data-wysihtml5-command="insertOrderedList">insertOrderedList</a> |
    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a> |
    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a> |
    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a> |
    <a data-wysihtml5-command="insertSpeech">speech</a>
    <a data-wysihtml5-action="change_view">switch to html view</a>
    
    <div data-wysihtml5-dialog="createLink" style="display: none;">
      <label>
	Link:
	<input data-wysihtml5-dialog-field="href" value="http://">
      </label>
      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
    </div>
    
    <div data-wysihtml5-dialog="insertImage" style="display: none;">
      <label>
	Image:
	<input data-wysihtml5-dialog-field="src" value="http://">
      </label>
      <label>
	Align:
	<select data-wysihtml5-dialog-field="className">
          <option value="">default</option>
          <option value="wysiwyg-float-left">left</option>
          <option value="wysiwyg-float-right">right</option>
	</select>
      </label>
      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
    </div>
    
  </div> <!-- toolbar -->
</div> <!-- toolbarWrapper -->
<div id="writingboxWrapper">
  <textarea id="writingbox" name="writingbox" class="writingbox" spellcheck="false" entryId="{{ $id  }}">{{ $content }}</textarea>
</div>

