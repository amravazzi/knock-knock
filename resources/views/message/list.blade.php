@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List Messages</div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                              <!-- Task Name -->
                              <td class="table-text">
                                  <div class="message">
                                    <div>{{ $message->title }}</div>
                                    <div>{{ $message->content }}</div>
                                  </div>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
