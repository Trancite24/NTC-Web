@extends('layouts.admin-lite')
@section('title')
    View Users
@endsection
@section('page-header')
    View Users
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">View User</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($active_users as $active_user)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h4>{{$active_user->name}}</h4>

                            <p>{{$active_user->type}}</p>
                            <p>{{$active_user->email}}</p>

                        </div>
                        <div class="icon">
                            <img src="{{$active_user->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="user-image" >
                        </div>
                        <a href="/admin/users/suspend/{{$active_user->id}}" class="small-box-footer">block User <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="row justify-content-center">
            @foreach($inactive_users as $inactive_user)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h4>{{$inactive_user->name}}</h4>

                            <p>{{$inactive_user->type}}</p>
                            <p>{{$inactive_user->email}}</p>
                        </div>
                        <div class="icon">
                            <img src="{{$inactive_user->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="user-image">
                        </div>
                        <a href="/admin/users/activate/{{$inactive_user->id}}" class="small-box-footer">Activate User <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


 <div class="modal fade" id="parameters-success-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                      @isset($suspended_user)
                      <h4 class="modal-title text-center">Success</h4>
                      @endisset
                      @isset($failed_user)
                      <h4 class="modal-title text-center">Invalid Operation</h4>
                      @endisset
                      @isset($activated_user)
                      <h4 class="modal-title text-center">Success</h4>
                      @endisset
                  </div>
              <div class="modal-body">
                    @isset($suspended_user)
                      <img src="/images/success.png" class="center-block" style="width: 100px">
                      <h4 class="modal-title text-center">User with email id: {{$suspended_user->email}} successfully Suspended from system</h4>
                      @endisset
                    @isset($failed_user)
                      <img src="/images/error.png" class="center-block" style="width: 100px">
                      <h4 class="modal-title text-center">You don't have permission to take action on User with email id: {{$failed_user->email}}</h4>
                      @endisset
                    @isset($activated_user)
                      <img src="/images/success.png" class="center-block" style="width: 100px">
                      <h4 class="modal-title text-center">User with email id: {{$activated_user->email}} successfully Modified</h4>
                      @endisset
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection

@section('additional-js')
        @isset($suspended_user)
        <script type="text/javascript">
            
            $('#parameters-success-modal').modal('show');

        </script>
        @endisset
        @isset($activated_user)
        <script type="text/javascript">
            
            $('#parameters-success-modal').modal('show');

        </script>
        @endisset
        @isset($failed_user)
        <script type="text/javascript">
            
            $('#parameters-success-modal').modal('show');

        </script>
        @endisset
@endsection