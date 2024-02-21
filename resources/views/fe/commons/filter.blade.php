<form action="">
<div class="d-flex">
    <div class="dropdown mr-1 ml-md-auto">
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Thương hiệu
      </button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
        @foreach ($brands as $brand)
        <label for="" class="dropdown-item ">
            <input {{(request("brand")[$brand->id]??"")==$brand->name ? 'checked' : ''}} type="checkbox"name="brand[{{$brand->id}}]" value="{{$brand->name}}" onchange="this.form.submit();">{{$brand->name}}
        </label>
        @endforeach
    </div>

    </div>
    <div class="dropdown mr-1 ml-md-auto">
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        MÀU SẮC
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
        @foreach ($colors as $color)
        <label for="" class="dropdown-item ">
            <input {{(request("color")[$color->id]??"")==$color->name ? 'checked' : ''}} type="checkbox"name="color[{{$color->id}}]" value="{{$color->name}}" onchange="this.form.submit();">{{$color->name}}
        </label>
        @endforeach
    </div>
    </div>
    <div class="dropdown mr-1 ml-md-auto">
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        LOẠI GIÀY
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
        @foreach ($types as $type)
        <label for="" class="dropdown-item ">
            <input {{(request("type")[$type->id]??"")==$type->name ? 'checked' : ''}} type="checkbox"name="type[{{$type->id}}]" value="{{$type->name}}" onchange="this.form.submit();">{{$type->name}}
        </label>
        @endforeach
    </div>
    </div>
    <div class="dropdown mr-1 ml-md-auto">
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        SIZE GIÀY
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
        @foreach ($sizes as $size)
        <label for="" class="dropdown-item ">
            <input {{(request("size")[$size->id]??"")==$size->size ? 'checked' : ''}} type="checkbox" name="size[{{$size->id}}]" value="{{$size->size}}" onchange="this.form.submit();">{{$size->size}}
        </label>
        @endforeach
    </div>
    </div>
    <div class="dropdown mr-1 ml-md-auto">
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        CHẤT LIỆU
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
        @foreach ($materials as $material)
        <label for="" class="dropdown-item ">
            <input {{(request("material")[$material->id]??"")==$material->name ? 'checked' : ''}} type="checkbox" name="material[{{$material->id}}]" value="{{$material->name}}" onchange="this.form.submit();">{{$material->name}}
        </label>
        @endforeach
    </div>
    </div>

  </div>
  </form>
