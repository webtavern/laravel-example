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
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
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
@endsection

@push('js')
  <script>
      function showNotification(from, align, handle_type, task_id) {

          $.notify({
              icon: "add_alert",
              message: "Task <b>ID="+task_id+"</b> "+handle_type+"."

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
                          $('[data-id='+task_id+']').removeClass('btn-success');
                          $('[data-id='+task_id+']').addClass('btn-danger').text('Stop task');
                          showNotification('top', 'right', 'started', task_id);
                          break;
                      case 'closed':
                          $('[data-id='+task_id+']').removeClass('btn-danger');
                          $('[data-id='+task_id+']').addClass('btn-success').text('Start task');
                          showNotification('top', 'right', 'stopped', task_id);
                          break;
                  }

              },
              error: function(response) {
                  console.log(response);
              }
          });

      }


      $(document).ready(function () {



      });
  </script>
@endpush
