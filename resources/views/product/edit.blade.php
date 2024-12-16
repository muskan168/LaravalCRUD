<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>laravel crud </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h1 class="text-white text-center">laravel crud</h1>
    </div>

    <div class="container">

    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('product.index')}}" class="btn btn-dark">back</a>
        </div>
      </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit products</h3>
                    </div>

                    <form enctype="multipart/form-data" action="  {{ route('product.update',$product->id) }}" method="post">
                        @method('put')
                        @csrf

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="" class="form-label h5">name</label>
                            <input type="text" value="{{ old('name',$product->name)}}" class=" @error('name') is-invalid @enderror form-control form-control-lg" placeholder="name" name="name">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label h5">sku</label>
                            <input type="text" value="{{ old('sku',$product->sku)}}" class=" @error('sku') is-invalid @enderror form-control form-control-lg" placeholder="sku" name="sku">
                            @error('sku')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label h5">price</label>
                            <input type="text" value="{{ old('price',$product->price)}}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="price" name="price">
                            @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label h5">description</label>
                            <textarea value="{{ old('description',$product->description)}}" placeholder="description" class="form-control" name="description" cols="30" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label h5">image</label>
                            <input type="file" class="form-control form-control-lg " name="image">
                            @if ($product->image != "")
                              <img class="w-50 my-3" src="{{ asset('uploads/product/'.$product->image) }}" >
                            @endif
                        </div>

                        <div class="d-grid bg-success w-25 h-25 rounded-pill mx-auto">
                            <button class="btn btn-lg text-white">update</button>
                        </div>

                        
                    </div>
</form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
