@extends('admin.app')
@section('section')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            View Activity
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
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">Activity Picture</div>
                            <div class="card-body text-center">
                                <div class="image-preview" id="imagePreview"></div>
                                <div id="updateImage"><img style="width:100%;"
                                                           src="{{$activity->image_path}}"
                                                           alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!--  details card-->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Title</label>
                                    <input class="form-control" id="title" type="text" name="title"
                                           value="{{$activity->title}}" disabled

                                           placeholder="Enter title"/>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="description">Description</label>
                                    <textarea class="form-control w-100" id="description" type="text" disabled
                                              name="description"
                                              placeholder="Enter description">{{$activity->description}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="small mb-1" for="date">Date</label>
                                        <input class="form-control" id="date" type="date" name="date"
                                               value="{{$activity->date}}" disabled/>
                                    </div>
                                </div>
                                <div class="form-row pt-3 float-right">
                                    @if($activity->is_public == 1)
                                        <div class="alert alert-success alert-solid" role="alert">Public activity</div>
                                    @else
                                        <div class="alert alert-danger alert-solid" role="alert">Private activity</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
