@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jenkins Credential
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jenkinsCredential, ['route' => ['jenkinsCredentials.update', $jenkinsCredential->id], 'method' => 'patch']) !!}

                        @include('jenkins_credentials.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection