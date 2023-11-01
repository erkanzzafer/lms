@extends('layouts.master')
@section('css')

@section('title')
    Classroom
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_trans.Sınıf Listesi') }}</h4>
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


                <div class="row">
                    <button type="button" data-target="#yeniEkle" data-toggle="modal"
                        class="btn btn-primary mb-3">{{ trans('main_trans.Yeni Ekle') }}</button>

                    <button type="button" id="btn_delete_all" class="btn x-small mb-3">Hepsini Sil</button>
                    <div class="col-md-3">
                        <form action="{{ route('classroom.filter-classes') }}" method="post">
                            @csrf
                            <select class="form-select mt-1" data-style="btn-info" name="grade_id" required
                                onchange="this.form.submit()">
                                <option value="0" selected>Tümünü Seç </option>
                                @foreach ($grades as $grade)
                                    <option {{ @$selected == $grade->id ? 'selected' : '' }} value="{{ $grade->id }}">
                                        {{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox"
                                        onclick="CheckAll('box1', this)" /></th>
                                <th scope="col">#</th>
                                <th scope="col">İsim</th>
                                <th scope="col">Departman</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($classrooms as $classroom)
                                <tr>
                                    <td><input type="checkbox" value="{{ $classroom->id }}" class="box1"></td>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $classroom->id }}" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $classroom->id }}" title="Edit"><i
                                                class="fa fa-trash"></i></button>

                                    </td>


                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1"
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
                                                    <form action="{{ route('classroom.destroy', $classroom->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        {{ trans('main_trans.Silme Uyarı') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $classroom->id }}">
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
                                    <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog"
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
                                                    <form action="{{ route('classroom.update', $classroom->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="İsim" class="mr-sm-2">İsim
                                                                    :</label>
                                                                <input id="Name" type="text" name="name"
                                                                    class="form-control"
                                                                    value="{{ $classroom->getTranslation('name', 'tr') }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name_en" class="mr-sm-2">Name
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    name="name_en"
                                                                    value="{{ $classroom->getTranslation('name', 'en') }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('main_trans.Grades') }}
                                                                    :</label>

                                                                <div class="box">
                                                                    <select class="fancyselect" name="grade_id">
                                                                        @foreach ($grades as $grade)
                                                                            <option
                                                                                {{ $grade->id == $classroom->grade_id ? 'selected' : '' }}
                                                                                value="{{ $grade->id }}">
                                                                                {{ $grade->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
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


    <!-- add_modal_class -->
    <div class="modal fade" id="yeniEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('main_trans.Yeni Sınıf Ekle') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>

                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('main_trans.Sınıf Adı') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name" />
                                            </div>


                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('main_trans.Sınıf Adı En') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('main_trans.Grades') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('main_trans.İşlemler') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ trans('main_trans.Sil') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('main_trans.Yeni Ekle') }}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('main_trans.İptal') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('main_trans.Onayla') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>


    <!--delete all modal -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Silmek istiyor musunz?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('classroom.deleteAll') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Emin misiniz?
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id"
                            value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                        <button type="submit" class="btn btn-danger">Evet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>

</div>

<!-- row closed -->


</div>




<!-- row closed -->
@endsection
@push('js')
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();

            //id si datatable olan input ları checkbox olan ve checked özelliği olan her birinin value sunu sakla
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            } else {
                alert("Seçilği öğe yok");
            }
        });
    });
</script>
@endpush
