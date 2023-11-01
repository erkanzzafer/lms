@extends('layouts.master')
@section('css')

@section('title')
    DENEME BAŞLIK
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.Departman Listesi') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main_trans.Anasayfa') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('main_trans.Departman Listesi') }}</li>
            </ol>


        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="button" data-target="#yeniEkle" data-toggle="modal"
                class="btn btn-primary mb-3">{{ trans('main_trans.Yeni Ekle') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">İsim</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $grade->id }}" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}" title="Edit"><i
                                                class="fa fa-trash"></i></button>

                                    </td>


                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        Siliniyor..
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('grade.destroy', $grade->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        {{ trans('main_trans.Silme Uyarı') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $grade->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('main_trans.İptal') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('main_trans.Onayla') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- update_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('Grades_trans.add_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- update_form -->
                                                    <form action="{{ route('grade.update', $grade->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="İsim" class="mr-sm-2">İsim
                                                                    :</label>
                                                                <input id="Name" type="text" name="name"
                                                                    class="form-control"
                                                                    value="{{ $grade->getTranslation('name', 'tr') }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name_en" class="mr-sm-2">Name
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    name="name_en"
                                                                    value="{{ $grade->getTranslation('name', 'en') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Notes
                                                                :</label>
                                                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
                                                        </div>
                                                        <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('main_trans.İptal') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('main_trans.Onayla') }}</button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <th colspan="4">
                                        <div class="p-3 mb-2 bg-info text-white text-center">
                                            {{ trans('main_trans.Kayıt Bulunamadı') }}</div>
                                    </th>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">İsim</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add_modal_Grade -->
    <div class="modal fade" id="yeniEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Grades_trans.add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grade.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="İsim" class="mr-sm-2">İsim
                                    :</label>
                                <input id="Name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">Name
                                    :</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Notes
                                :</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('main_trans.İptal') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('main_trans.Onayla') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>


</div>




<!-- row closed -->
@endsection
@push('js')
@endpush
