@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Used Space</p>
              <h3 class="card-title">49/50
                <small>GB</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title">$34,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Fixed Issues</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-user-circle-o"></i>
              </div>
              <p class="card-category">Users</p>
              <h3 class="card-title">{{$users_count}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Orders in work</h4>
                        <p class="card-category">{{\Carbon\Carbon::now()}}</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Product</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>

                            @foreach($working_tasks as $working_task)
                                <tr>
                                    <td>{{$working_task->id}}</td>
                                    <td>{{$working_task->product->title}}</td>
                                    <td>{{$working_task->quantity}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Working users</h4>
                        <p class="card-category">{{\Carbon\Carbon::now()}}</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Name</th>
                                <th>E-mail</th>
                            </thead>
                            <tbody>
                            @foreach($working_users as $working_user)
                                <tr>
                                    <td>{{$working_user->name}}</td>
                                    <td>{{$working_user->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- first data row -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#tasks" data-toggle="tab">
                        <i class="material-icons">list</i> Tasks
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">message</i> Messages
                        <div class="ripple-container"></div>
                          @if($last_messages->where('status', 0)->count())
                              <span id="unread-messages" class="notification" style="position: absolute;top: 0;border: 1px solid #FFF;right: -5px;
                              font-size: 9px;background: #f44336;color: #FFFFFF;min-width: 20px;padding: 0px 5px;height: 20px;border-radius: 10px;
                              text-align: center;line-height: 19px;vertical-align: middle;display: block;">{{$last_messages->where('status', 0)->count()}}</span>
                          @endif
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tasks">
                  <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($user_tasks as $task)
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->product->title}}</td>
                            <td>{{$task->quantity}}</td>
                            <td><button id="handle_task"
                                        class="btn {{$task->in_works->contains('closed_at', null) ? 'btn-danger' : 'btn-success'}} btn-block"
                                        data-id="{{$task->id}}"
                                        onclick="handle('{{$task->id}}')">{{$task->in_works->contains('closed_at', null) ? 'Stop task' : 'Start task'}}</button></td>
                        </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>

                    @foreach($last_messages as $last_message)
                        <tr class="click-direct" data-from="{{$last_message->from_id}}" data-to="{{auth()->user()->id}}" style="cursor: pointer">
                            <td><b>{{$users->where('id', $last_message->from_id)->pluck('name')[0]}}</b></td>
                            <td><b>{{$last_message->body}}</b></td>
                            <td>{{$last_message->created_at}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- user task row -->
    </div>
  </div>
    @include('direct')


@endsection
@if(auth()->user())
    @push('js')
        <script>

            let users_online = [];

            function showNotification(from, align, handle_type, task_id) {

                $.notify({
                    icon: "add_alert",
                    message: "Task <b>ID=" + task_id + "</b> " + handle_type + "."

                }, {
                    type: 'info',
                    timer: 3000,
                    placement: {
                        from: from,
                        align: align
                    }
                });
            }

            function handle(task_id) {

                console.log($(this));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('task.handle') }}',
                    type: "post",
                    data: {
                        order_id: task_id,
                    },
                    success: function (response) {
                        switch (response) {
                            case 'opened':
                                $('[data-id=' + task_id + ']').removeClass('btn-success');
                                $('[data-id=' + task_id + ']').addClass('btn-danger').text('Stop task');
                                showNotification('top', 'right', 'started', task_id);
                                break;
                            case 'closed':
                                $('[data-id=' + task_id + ']').removeClass('btn-danger');
                                $('[data-id=' + task_id + ']').addClass('btn-success').text('Start task');
                                showNotification('top', 'right', 'stopped', task_id);
                                break;
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                });

            }

            $(document).ready(function () {

                function sd() {
                    let el = $('#message-container');

                    let el_h = el.height();

                    $('.sidebar-wrap').scrollTop(el_h);
                }

                $('.click-direct').click(function () {

                    let from_id = $(this).attr('data-from');
                    let to_id = $(this).attr('data-to');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('message.history') }}',
                        type: "post",
                        data: {
                            from_id: from_id,
                            to_id: to_id,
                        },
                        success: function (response) {
                            $('#message-container').html(response);
                            setTimeout(sd, 100);
                            if ($("#send-form input[name=to_id]").length) {
                                $("#send-form input[name=to_id]").attr('value', from_id);
                            } else {
                                $('#send-form').append('<input type="hidden" name="to_id" value="' + from_id + '">');
                            }
                            $('.direct-messages').show();

                            //subscribe online channel

                            Echo.join('online').here((users) => {
                                // console.log('Participant on channel:');
                                // console.log(users);
                                for (let key in users) {
                                    users_online.push(users[key]);
                                }
                            }).joining((user) => {
                                // console.log('Join on channel:');
                                // console.log(user);

                                users_online.push(user);

                            }).leaving((user) => {
                                // console.log('Leave channel:');
                                // console.log(user);

                                let index = users_online.indexOf(user);
                                if (index > -1) {
                                    users_online.splice(index, 1);
                                }
                            });


                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });

                });

                $('.sidebar-header-col-right').click(function () {
                    $('.direct-messages').hide();
                    Echo.leave('online');
                });

                $('#send').click(function () {

                    let message = $('textarea[name=message]').val();
                    let to_id = $('input[name=to_id]').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('message.send') }}',
                        type: "get",
                        data: {
                            message: message,
                            to_id: to_id,
                        },
                        success: function () {
                            $('textarea[name=message]').val('');
                            setTimeout(sd, 100);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });

                })
            });

            // subscribe private channel if user log in

            let user_id = {{auth()->user()->id}} +'';
            let channel = 'direct.' + user_id;

            Echo.private(channel).listen(".AttendanceSystem\\Events\\NewMessage", (response) => {

                // console.log(response);

                if (response.id == user_id) {
                    $('#message-container').append('<div class="m-container"><div class="message-page-message-chat message-page-message-chat--message-to">' +
                        '<div class="message-page-message-chat--message">' + response.message + '</div>' +
                        '<div class="message-page-message-chat--message-info"></div>' +
                        '</div></div>');
                } else {
                    $('#message-container').append('<div class="m-container"><div class="message-page-message-chat message-page-message-chat--message-from">' +
                        '<div class="message-page-message-chat--message">' + response.message + '</div>' +
                        '<div class="message-page-message-chat--message-info"></div>' +
                        '</div></div>')
                }

                function updateStatus() {

                    // console.log(users_online.indexOf(parseInt(response.id)));

                    if (users_online.indexOf(parseInt(response.id)) != -1) {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '{{ route('message.status') }}',
                            type: "post",
                            data: {
                                id: response.message_id,
                            },
                            error: function (e) {
                                console.log(e);
                            }
                        });
                    }
                }

                setTimeout(updateStatus, 1500);
            });
        </script>
    @endpush
@endif
