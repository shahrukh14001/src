@extends('layouts.app')

@section('header')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group pull-right">
                <a class="btn btn-primary" href="{{ route('documents.index') }}"><i class="fa fa-arrow-left"></i> Back to list</a>
            </div>
        </div>
    </div>
@stop

@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit document</h3>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter a document name" autocomplete="off" value="{{ $document->name }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input class="form-control" type="text" name="description" id="description" placeholder="Enter document description" autocomplete="off" value="{{ $document->description }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="0">Select a category</option>
                                        @foreach($category as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $document->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="url">Document url</label>
                                    <input type="text" class="form-control" name="url" id="url" placeholder="Enter document url" autocomplete="off" value="{{ $document->url }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="thumbnail_url">Thumbnail url</label>
                                    <input type="text" class="form-control" name="thumbnail_url" id="thumbnail_url" placeholder="Enter document thumbnail url" autocomplete="off" value="{{ $document->thumbnail_url }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_css')

@stop