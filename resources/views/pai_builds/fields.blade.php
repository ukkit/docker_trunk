<!-- Pai Version Field -->
<div class="form-group col-sm-4">
    {!! Form::label('pai_version', 'PAI Version:') !!}
    {!! Form::text('pai_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Pai Build Field -->
<div class="form-group col-sm-4">
    {!! Form::label('pai_build', 'PAI Build Number:') !!}
    {!! Form::number('pai_build', null, ['class' => 'form-control']) !!}
</div>

<!-- Pv Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('pv_id', 'Pv Id:') !!}
    {!! Form::text('pv_id', null, ['class' => 'form-control']) !!}
</div> --}}

@if($this_is_edit)
<!-- Is Release Build Field -->
<div class="form-group col-sm-4">
    {!! Form::label('is_release_build', 'This is Release Build?') !!}
    <div class="form-control">
            <label class="radio-inline">
            <input type="radio" name="is_release_build" value="Y" @if($record->is_release_build == "N")  checked @endif> Yes
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_release_build" value= "N" checked> No
        </label>
    </div>
</div>
{{-- <div class="form-group col-sm-6">
    {!! Form::label('is_release_build', 'Is Release Build:') !!}
    {!! Form::text('is_release_build', null, ['class' => 'form-control']) !!}
</div> --}}
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('paiBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
