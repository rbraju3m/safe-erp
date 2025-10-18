@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $ModuleTitle }}</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.gallery.folders') }}">{{ $ModuleTitle }}</a></li>
            </ol>

            <div class="breadcrumb breadcrumbbutton">
                <a href="javascript:history.back()" class="btn btn-warning pull-right m-l-5">Back</a>
                @if(Route::currentRouteName() != 'admin.gallery.inactive')
                    <a href="{{ route('admin.gallery.inactive') }}" class="btn btn-danger pull-right m-l-5">Inactive Gallery</a>
                @endif
                @if(Route::currentRouteName() != 'admin.gallery.index')
                    <a href="{{ route('admin.gallery.folders') }}" class="btn btn-success pull-right m-l-5">Active Gallery</a>
                @endif
                @if(Route::currentRouteName() != 'admin.gallery.create')
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary pull-right m-l-5">Add Gallery</a>
                @endif
            </div>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="row">
                @if(count($data) > 0)
                    @foreach($data as $values)
                            <?php
                            $user = App\Modules\User\Models\User::find($values->created_by);
                            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ url('uploads/gallery/'.$values->image_link) }}" data-toggle="lightbox" data-title="{{ $values->title }}" data-gallery="gallery">
                                        <img src="{{ url('uploads/gallery/'.$values->image_link) }}" class="card-img-top img-fluid" alt="{{ $values->title }}" style="height: 220px; object-fit: cover;">
                                    </a>
                                    <div class="card-img-overlay d-flex flex-column justify-content-end p-2" style="background: rgba(0,0,0,0.4); opacity:0; transition:0.3s;">
                                        <h5 class="text-white font-weight-bold">{{ $values->title }}</h5>
                                        <p class="text-white small">{{ $values->discription }}</p>
                                    </div>
                                </div>
                                <div class="card-body text-center py-2">
                                    <div class="mb-2">
                                        <img src="{{ url('uploads/member/'.$user->image_link) }}" class="img-circle" style="width:40px; height:40px;" alt="{{ $user->name }}">
                                        <span class="ml-2">{{ $user->name }}</span>
                                    </div>
                                    <small class="text-muted">{{ $values->image_day }}, {{ $values->image_date }} - {{ $values->image_time }}</small>
                                </div>
                                <div class="card-footer text-center py-2">
                                    @if(isset($Cancel) && $Cancel == 'Cancel')
                                        <a href="{{ route('admin.gallery.rollback', $values->id) }}" class="btn btn-warning btn-sm m-1" onclick="return confirm('Move to active gallery?')"><i class="fa fa-repeat"></i></a>
                                        @if(Auth::user()->type == 'Admin')
                                            <a href="{{ route('admin.gallery.delete', $values->id) }}" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure to permanently delete?')"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @else
                                        <a href="{{ url('uploads/file/download.php?nama='.url('uploads/gallery/'.$values->image_link)) }}" class="btn btn-success btn-sm m-1"><i class="fa fa-download"></i></a>
                                        @if(Auth::user()->type == 'Admin' || $values->created_by == Auth::user()->id)
                                            <a href="{{ route('admin.gallery.edit', $values->id) }}" class="btn btn-primary btn-sm m-1"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.gallery.destroy', $values->id) }}" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure to Inactive?')"><i class="fa fa-ban"></i></a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center">No images found in this folder.</div>
                    </div>
                @endif
            </div>
        </section>
    </div>

@endsection

@section('styles')
    <style>
        .card:hover .card-img-overlay {
            opacity: 1;
        }
        .card-img-overlay h5, .card-img-overlay p {
            color: #fff;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox(); // using ekko-lightbox plugin
        });
    </script>
@endsection
