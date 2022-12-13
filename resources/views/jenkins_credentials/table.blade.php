<div class="table-responsive">
    <table class="table" id="jenkinsCredentials-table">
        <thead>
            <tr>
                <th>Server Name Ip</th>
                <th>Jenkins User</th>
                <th>Jenkins Token</th>
                <th>Note</th>
                @canany('edit_databaseTypes','delete_databaseTypes')
                <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($jenkinsCredentials as $jenkinsCredential)
            <tr>
                <td>{{ $jenkinsCredential->server_name_ip }}</td>
                <td>{{ $jenkinsCredential->jenkins_user }}</td>
                <td>{{ $jenkinsCredential->jenkins_token }}</td>
                <td>{{ $jenkinsCredential->note }}</td>
                @canany('edit_databaseTypes','delete_databaseTypes')
                    <td class="text-center">
                        <div class="btn-btn-group-justified">
                            @can('edit_databaseTypes')
                                {!! Form::open(['class'=>'inline','route' => ['jenkinsCredentials.edit', $jenkinsCredential->id], 'method' => 'get']) !!}
                                {{-- {!! Form::button('<i class="far fa-edit" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!} --}}
                                {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                                {!! Form::close() !!}
                            @endcan
                            @can('delete_databaseTypes')
                                {!! Form::open(['class'=>'inline','route' => ['jenkinsCredentials.destroy', $jenkinsCredential->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete?')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
