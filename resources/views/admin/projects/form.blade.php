@extends('layouts.app')

@section('page-name', 'Modifica DB')

@section('content')

<section class="container pt-4">

    <!-- Se sono presenti errori nella compilazione del form -->
    @include('layouts.partials._validation-errors')

    <div class="text-center">
        <h1 class="my-4">{{$project->id ? 'Modifica progetto - ' . $project->title : 'Aggiungi un nuovo progetto'}}</h1>

        <a href="{{route('admin.projects.index')}}" class="btn btn-primary">
            Torna alla lista
        </a>
    </div>

    <div class="card my-5">
        <div class="card-body">

            @if ($project->id)
                <form method="POST" action="{{route('admin.projects.update', $project)}}" enctype="multipart/form-data" class="row">
                @method('put')
            @else
                <form method="POST" action="{{route('admin.projects.store')}}" enctype="multipart/form-data" class="row">
            @endif 
                @csrf
    
                <div class="col-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="title" class="form-label">
                                Titolo    
                            </label> 
                            <input type="text" name="title" id="title" class="@error('title') is-invalid @enderror form-control" value="{{old('title', $project->title)}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
    
                        <div class="col-8">
                            <label for="image" class="form-label">
                                Immagine    
                            </label> 
                            <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{old('image', $project->image)}}">
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4 border p-2">
                            <img src="{{$project->getImageUri()}}" alt="{{$project->title}}" class="img-fluid" id="image_preview">
                        </div>
                    </div>
                </div>
    
                <div class="col-8">
                    <label for="description" class="form-label">
                        Descrizione    
                    </label>
                    <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control"  rows="6">{{old('description', $project->description)}}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-12 mt-4">
                    <label for="is_published" class="form-label">
                        Pubblicato    
                    </label>
                    <input type="checkbox" name="is_published" id="is_published" class="@error('is_published') is-invalid @enderror form-check-control" value="1" @checked(old('is_published', $project->is_published))>
                    @error('is_published')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="offset-8 col-4 text-end my-4">
                    <button type="submit" class="btn btn-primary">
                        Salva
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script>
    const imageEl = document.getElementById('image');
    const imagePreviewEl = document.getElementById('image_preview');
    const imagePlaceholder = imagePreviewEl.src;

    imageEl.addEventListener(
        'change', () => {
            if (imageEl.files && imageEl.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageEl.files[0]);

                reader.onload = e => {
                    imagePreviewEl.src = e.target.result;
                }
            } else {
                imagePreviewEl.src = imagePlaceholder;
            }
        });
</script>

@endsection