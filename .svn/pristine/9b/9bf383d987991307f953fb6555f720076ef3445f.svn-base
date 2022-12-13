{{-- <div class="row"> --}}

    <!-- Server Name Ip Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('server_name_ip', 'Server Name/IP Address:') !!}
        {!! Form::text('server_name_ip', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Jenkins User Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('jenkins_user', 'Jenkins User:') !!}
        {!! Form::text('jenkins_user', null, ['class' => 'form-control','placeholder' => 'admin']) !!}
    </div>

    <!-- Jenkins Token Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('jenkins_token', 'Jenkins Token:') !!}
        {!! Form::textarea('jenkins_token', null, ['class' => 'form-control', 'rows' => 1]) !!}
    </div>

    <!-- Note Field -->
    <div class="col-lg-12">
        {!! Form::label('note', 'Note:') !!}
        {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
    </div>

{{-- </div> --}}
</div>
<div class="box-footer">
<!-- Submit Field -->
<div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! route('jenkinsCredentials.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>
{{-- <hr>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('jenkinsCredentials.index') }}" class="btn btn-default">Cancel</a>
</div> --}}

