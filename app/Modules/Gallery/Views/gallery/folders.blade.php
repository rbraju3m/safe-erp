

@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gallery Folders</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Gallery Folders</li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary pull-right" style="font-weight: bold;">Add Gallery</a>
                <a href="{{ route('admin.gallery.inactive') }}" class="btn btn-danger pull-right" style="margin-right: 8px; font-weight: bold;">Inactive Gallery</a>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                @if($folders->count() > 0)
                    @foreach($folders as $folder)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="card folder-card text-center"
                                 onclick="window.location.href='{{ route('admin.gallery.index', $folder->folder) }}'">
                                <div class="card-body">
                                    <div class="folder-icon">
                                        <i class="fa fa-folder-open"></i>
                                    </div>
                                    <h4 class="folder-name">{{ $folder->folder }}</h4>
                                    <p class="image-count">{{ $folder->image_count }} {{ Str::plural('Image', $folder->image_count) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> No folders found!
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

    {{-- Custom Styles --}}
    <style>
        .folder-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            margin-bottom: 20px;
            padding: 20px;
        }
        .folder-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .folder-icon {
            font-size: 50px;
            color: #f0ad4e;
            margin-bottom: 10px;
        }
        .folder-name {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }
        .image-count {
            color: #777;
            font-size: 14px;
        }
    </style>
@endsection
