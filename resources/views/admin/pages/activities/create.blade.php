@extends('admin.app')
@section('section')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            Create Activity
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                <form action="{{route('activities-create')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">Activity Picture</div>
                                <div class="card-body text-center">
                                    <div class="image-preview" id="imagePreview"></div>
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB
                                    </div>
                                </div>
                                <div class="custom-image-input text-center">
                                    <label for="imageInput">Choose Image</label>
                                    <input type="file" id="imageInput" accept="image/*" name="image"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!--  details card-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="small mb-1" for="title">Title*</label>
                                        <input class="form-control" id="title" type="text" name="title"

                                               placeholder="Enter title"/>
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="description">Description</label>
                                        <textarea class="form-control w-100" id="description" type="text"
                                                  name="description"
                                                  placeholder="Enter description"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="small mb-1" for="date">Date*</label>
                                            <input class="form-control" id="date" type="date" name="date"/>
                                            @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div
                                            class="form-group col-md-6 d-flex align-items-center pl-4 custom-control custom-checkbox custom-control-solid">
                                            <input class="form-check-input custom-control-input" type="checkbox"
                                                   name="is_public"
                                                   id="is_public">
                                            <label class="form-check-label custom-control-label" for="is_public">
                                                Public activity
                                            </label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="users_list" class="small mb-1">Select Users</label>
                                            @if($users)
                                                <select id="users_list" class="selectpicker form-control" name="users[]"
                                                        multiple
                                                        data-live-search="true">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts-create')
        <script src="{{asset('admin/js/custom-create.js')}}"></script>
    @endpush
@endsection
