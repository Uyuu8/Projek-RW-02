@extends('layouts.backend.app')

@section('title','Activity Log')

@section('content')
<div class="card">
    <div class="card-body">

        <h4>Activity Log</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Waktu</th>
                    <th>Perubahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? '-' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ class_basename($log->model_type) }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        @if($log->new_values)
                            @foreach($log->new_values as $field => $value)
                                <div style="font-size: 12px;">
                                    <strong>{{ $field }}</strong> :
                                    {{ $log->old_values[$field] ?? '-' }}
                                    →
                                    {{ $value }}
                                </div>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $logs->links() }}

    </div>
</div>
@endsection
