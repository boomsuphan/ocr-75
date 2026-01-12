<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($semester->name) ? $semester->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_start') ? 'has-error' : ''}}">
    <label for="date_start" class="control-label">{{ 'Date Start' }}</label>
    <input class="form-control" name="date_start" type="date" id="date_start" value="{{ isset($semester->date_start) ? $semester->date_start : ''}}" >
    {!! $errors->first('date_start', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_end') ? 'has-error' : ''}}">
    <label for="date_end" class="control-label">{{ 'Date End' }}</label>
    <input class="form-control" name="date_end" type="date" id="date_end" value="{{ isset($semester->date_end) ? $semester->date_end : ''}}" >
    {!! $errors->first('date_end', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
