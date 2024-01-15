@extends('admin.app')
@section('section')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            {{$user ?  $user['name'] : ''}}  Activities
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-end">
                @if(Auth::user()->hasRole('super_admin') && empty($user))
                    <a class="btn btn-success" href="{{route('activities-create-view')}}">
                        <i data-feather="plus"></i> Add
                    </a>
                @endif
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($activities)
                            @foreach($activities as $activity)
                                <tr>
                                    <td>{{$activity->id}}</td>
                                    <td>{{$activity->title}}</td>
                                    <td>{{$activity->description}}</td>
                                    <td class="text-center">
                                        @if($activity->image_path &&  Storage::exists('public/Activity/' . $activity->image_name))
                                            <img style="width:100px; height: 80px" src="{{$activity->image_path}}"
                                                 alt="">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$activity->date ? date('d/m/Y', strtotime($activity->date)) : ''}}</td>
                                    @if($activity->is_public == 1)
                                        <td>
                                            <div class="badge badge-success badge-pill">Public</div>
                                        </td>
                                    @elseif($activity->is_public == 0)
                                        <td>
                                            <div class="badge badge-danger badge-pill">Private</div>
                                        </td>
                                    @endif
                                    <td class="d-flex">
                                        @if(Auth::user()->hasRole('super_admin'))
                                            <a href="{{route('activities-update-view', ['activity'=>$activity])}}">
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i
                                                        data-feather="edit"></i></button>
                                            </a>
                                            <form action="{{ route('activity-delete', ['id' => $activity->id]) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark"
                                                        onclick="return confirm('Are you sure you want to delete this activity?')">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{route('activities-view', ['activity'=>$activity])}}">
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i
                                                        data-feather="eye"></i></button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
