@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gallery Folders</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Gallery Folders</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">All Gallery Folders</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Folder Name</th>
                                    <th>Image Count</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($folders as $index => $folder)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $folder->folder }}</td>
                                        <td>{{ $folder->image_count }}</td>
                                        <td>
                                            <a href="{{ route('admin.gallery.index', $folder->folder) }}" class="btn btn-primary btn-sm">
                                                View Images
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No folders found!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
