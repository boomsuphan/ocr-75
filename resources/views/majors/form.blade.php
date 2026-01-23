<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($major->name) ? $major->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}}">
    <label for="faculty_id" class="control-label">{{ 'Faculty Id' }}</label>
    <input class="form-control" name="faculty_id" type="text" id="faculty_id" value="{{ isset($major->faculty_id) ? $major->faculty_id : ''}}" >
    {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
