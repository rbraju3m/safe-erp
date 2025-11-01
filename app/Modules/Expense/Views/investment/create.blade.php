@extends('backend.layout.master')
@section('body')
    <div class="content-wrapper">
        <section class="content-header">

            <h1 style="text-transform: uppercase;font-weight: bold;font-size: 18px;">

                {{$ModuleTitle}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.investment.index')}}">{{$ModuleTitle.' > '}}</a><a
                        href="{{route('admin.investment.create')}}">{{$pageTitle}}</a></li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a style="margin-left: 2px;font-weight: bold;" href="javascript:history.back()"
                   class="btn btn-warning waves-effect pull-right">Back</a>

                @if (Route::currentRouteName() != 'admin.investment.inactive')
                    <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.investment.inactive')}} "
                       class="btn btn-danger waves-effect pull-right">Inactive investment</a>
                @endif

                @if (Route::currentRouteName() != 'admin.investment.index')
                    <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.investment.index')}} "
                       class="btn btn-success waves-effect pull-right">Active investment</a>
                @endif

                @if (Route::currentRouteName() != 'admin.investment.create')
                    @if(Auth::user()->type == 'Admin')

                        <a style="margin-left: 2px;font-weight: bold;" href=" {{route('admin.investment.create')}} "
                           class="btn btn-primary waves-effect pull-right">Add investment</a>
                    @endif
                @endif

            </ol>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"
                        style="text-transform: uppercase;font-weight: bold;font-size: 18px;">{{$pageTitle}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::open(['route' => 'admin.investment.store','enctype'=>'multipart/form-data',  'files'=> true, 'id'=>'investmentform', 'class' => '']) !!}

                    @include('Expense::investment._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>

@endsection

