@extends('layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Template</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Template</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" method="post" enctype="multipart/form-data" action="{{ route('template.update', ['id' => $template->id]) }}">
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="template-image" value="0">
                        <input type="hidden" name="template-icon" value="0">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   value="{{ old('name', $template->name) }}"
                                   placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="image" id="image">
                        </div>
                        @if($template->image)
                            <div class="image-wrapper">
                                <div data-id="template-image" class="delete-image-icon">
                                    ✖
                                </div>
                                <img id="template-image" class="img-thumbnail rounded mt-2 template-image" src="{{ asset("/storage/$template->image") }}" alt="Template Image">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="icon">Icon (Max icon size is 100х100)</label>
                            <input class="form-control @error('icon') is-invalid @enderror" type="file" accept=".jpg, .jpeg, .png" name="icon" id="icon">
                        </div>
                        @if($template->icon)
                            <div class="image-wrapper">
                                <div data-id="template-icon" class="delete-image-icon">
                                    ✖
                                </div>
                                <img id="template-icon" class="img-thumbnail rounded mt-2 template-image" src="{{ asset("/storage/$template->icon") }}" alt="Template Icon">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="open_url">Open Url</label>
                            <input type="url" class="form-control @error('open_url') is-invalid @enderror" value="{{ old('open_url', $template->open_url) }}" id="open_url" name="open_url">
                        </div>

                        <div class="form-group">
                            <label for="deeplink">Deeplink (For IOS or Android)</label>
                            <input type="text" class="form-control @error('deeplink') is-invalid @enderror" id="deeplink" value="{{ old('deeplink', $template->deeplink) }}" name="deeplink">
                        </div>

                    </div>
                    <div class="col-xl-6 col-sm-12">
                        @livewire('message-form', ['title' => $template->title, 'message' => $template->body])
                    </div>
                    <!-- /.col -->
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                    </div>

                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        $('.delete-image-icon').click(function () {
            const id = $(this).data('id')
            $('#' + id).remove()
            $(`[name="${id}"]`).val(1)
            $(this).remove()
        })
    </script>
@endsection
