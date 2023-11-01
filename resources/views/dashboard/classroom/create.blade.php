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
            <h4 class="mb-0"> Sınıflar</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
            <a href="{{ route('grade.index') }}" class="btn btn-primary"> Geri Dön</a>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('success'))
                    <div class="p-3 mb-2 bg-success text-white">{{ session('success') }}</div>
                @endif
                <form action="{{ route('grade.store') }}" method="post">
                    @csrf
                    <input type="text" class="form-control" name="name" placeholder="Sınıf ismi...">
                    @error('name')
                        <div class="p-3 mb-2 bg-danger text-white">{{ $message }}</div>
                    @enderror
                    <br>
                    <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('notes')
                        <div class="p-3 mb-2 bg-danger text-white">{{ $message }}</div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('js')
@endpush
