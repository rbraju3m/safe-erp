@extends('backend.layout.master')

@section('body')
    <div class="content-wrapper">
        {{-- HEADER --}}
        <section class="content-header d-flex flex-wrap justify-content-between align-items-center p-3 mb-3 bg-gradient-primary text-white rounded shadow-sm">
            <div>
                <h2 class="fw-bold mb-1"><i class="fa fa-image me-2"></i>{{ $ModuleTitle }}</h2>
                <p class="mb-0 small opacity-75">Manage and explore all gallery images</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="javascript:history.back()" class="btn btn-light text-dark btn-sm fw-semibold shadow-sm">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>

                @if(Route::currentRouteName() != 'admin.gallery.inactive')
                    <a href="{{ route('admin.gallery.inactive') }}" class="btn btn-danger btn-sm fw-semibold shadow-sm">
                        <i class="fa fa-ban me-1"></i> Inactive Gallery
                    </a>
                @endif

                @if(Route::currentRouteName() != 'admin.gallery.index')
                    <a href="{{ route('admin.gallery.folders') }}" class="btn btn-success btn-sm fw-semibold shadow-sm">
                        <i class="fa fa-check-circle me-1"></i> Active Gallery
                    </a>
                @endif

                @if(Route::currentRouteName() != 'admin.gallery.create')
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm fw-semibold shadow-sm">
                        <i class="fa fa-plus me-1"></i> Add Gallery
                    </a>
                @endif
            </div>
        </section>

        {{-- GALLERY --}}
        <section class="content">
            @include('backend.layout.msg')

            @if(count($data) > 0)
                <div class="row g-3">
                    @foreach($data as $values)
                        @php
                            $user = App\Modules\User\Models\User::find($values->created_by);
                        @endphp

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="gallery-card border-0 shadow-sm rounded overflow-hidden position-relative">
                                {{-- IMAGE --}}
                                <a href="{{ url('uploads/gallery/'.$values->image_link) }}"
                                   data-toggle="lightbox"
                                   data-gallery="gallery"
                                   data-title="{{ $values->title }}">
                                    <img src="{{ url('uploads/gallery/'.$values->image_link) }}"
                                         class="w-100 gallery-img"
                                         alt="{{ $values->title }}">
                                    <div class="gallery-overlay d-flex flex-column justify-content-center align-items-center text-center">
                                        <h6 class="text-white mb-1 fw-semibold">{{ Str::limit($values->title, 20) }}</h6>
                                        <small class="text-white-50">{{ Str::limit($values->discription, 30) }}</small>
                                    </div>
                                </a>

                                {{-- INFO --}}
                                <div class="p-2 bg-white text-center">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <img src="{{ url('uploads/member/'.$user->image_link) }}"
                                             class="rounded-circle me-2"
                                             style="width:28px; height:28px;" alt="">
                                        <small class="fw-semibold">{{ $user->name }}</small>
                                    </div>
                                    <small class="text-muted d-block">{{ $values->image_day }}, {{ $values->image_date }}</small>
                                </div>

                                {{-- ACTIONS --}}
                                <div class="gallery-actions text-center py-2 bg-light border-top">
                                    @if(isset($Cancel) && $Cancel == 'Cancel')
                                        <a href="{{ route('admin.gallery.rollback', $values->id) }}"
                                           class="btn btn-outline-warning btn-xs"
                                           title="Restore"
                                           data-bs-toggle="tooltip">
                                            <i class="fa fa-repeat"></i>
                                        </a>
                                        @if(Auth::user()->type == 'Admin')
                                            <a href="{{ route('admin.gallery.delete', $values->id) }}"
                                               class="btn btn-outline-danger btn-xs"
                                               title="Delete Permanently"
                                               onclick="return confirm('Are you sure to permanently delete?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ url('uploads/file/download.php?nama='.url('uploads/gallery/'.$values->image_link)) }}"
                                           class="btn btn-outline-success btn-xs"
                                           title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        @if(Auth::user()->type == 'Admin' || $values->created_by == Auth::user()->id)
                                            <a href="{{ route('admin.gallery.edit', $values->id) }}"
                                               class="btn btn-outline-primary btn-xs"
                                               title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.gallery.destroy', $values->id) }}"
                                               class="btn btn-outline-danger btn-xs"
                                               title="Move to Inactive"
                                               onclick="return confirm('Are you sure to Inactive?')">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center mt-4">
                    <i class="fa fa-info-circle"></i> No images found in this folder.
                </div>
            @endif
        </section>
    </div>
@endsection

@section('styles')
    <style>
        /* HEADER BAR */
        .bg-gradient-primary {
            background: linear-gradient(90deg, #007bff, #00c3ff);
            color: white;
        }

        /* GALLERY */
        .gallery-img {
            height: 140px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-card {
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            background: #fff;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }

        /* OVERLAY */
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 10px;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        /* ACTION BUTTONS */
        .btn-xs {
            padding: 3px 7px;
            font-size: 12px;
            margin: 2px;
            border-radius: 4px;
        }

        .btn-xs i {
            font-size: 13px;
        }

        .gallery-actions {
            border-radius: 0 0 10px 10px;
        }

        @media (max-width: 767px) {
            .gallery-img {
                height: 110px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection
