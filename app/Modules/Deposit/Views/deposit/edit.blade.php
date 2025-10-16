@extends('backend.layout.master')
@section('body')

    <div class="content-wrapper">
        <section class="content-header">

            <h1>
                {{$ModuleTitle}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.deposit.index')}}">{{$ModuleTitle.' > '}}</a><a
                        href="{{route('admin.deposit.create')}}">{{$pageTitle}}</a></li>
            </ol>

            <ol class="breadcrumb breadcrumbbutton">
                <a style="margin-left: 3px;font-weight: bold;" href="javascript:history.back()"
                   class="btn btn-warning waves-effect pull-right">Back</a>

                @if (Route::currentRouteName() != 'admin.deposit.inactive')
                    <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.deposit.inactive')}} "
                       class="btn btn-danger waves-effect pull-right inactive">Inactive Deposit</a>
                @endif

                @if (Route::currentRouteName() != 'admin.deposit.index')
                    <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.deposit.index')}} "
                       class="btn btn-success waves-effect pull-right">Active Deposit</a>
                @endif

                @if (Route::currentRouteName() != 'admin.deposit.create')
                    @if(Auth::user()->type == 'Admin')

                        <a style="margin-left: 3px;font-weight: bold;" href=" {{route('admin.deposit.create')}} "
                           class="btn btn-primary waves-effect pull-right">Add Deposit</a>
                    @endif
                @endif

            </ol>
        </section>

        <section class="content">
            @include('backend.layout.msg')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$pageTitle}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.deposit.update', $data->id],"class"=>"", 'id' => '']) !!}

                    @include('Deposit::deposit._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>

@endsection

