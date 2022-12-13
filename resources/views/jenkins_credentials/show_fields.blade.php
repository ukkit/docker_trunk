<!-- Server Name Ip Field -->
<div class="form-group">
    {!! Form::label('server_name_ip', 'Server Name Ip:') !!}
    <p>{{ $jenkinsCredential->server_name_ip }}</p>
</div>

<!-- Jenkins User Field -->
<div class="form-group">
    {!! Form::label('jenkins_user', 'Jenkins User:') !!}
    <p>{{ $jenkinsCredential->jenkins_user }}</p>
</div>

<!-- Jenkins Token Field -->
<div class="form-group">
    {!! Form::label('jenkins_token', 'Jenkins Token:') !!}
    <p>{{ $jenkinsCredential->jenkins_token }}</p>
</div>

<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $jenkinsCredential->note }}</p>
</div>

