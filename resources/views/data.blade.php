@extends('layouts.app')

@section('content')

<div class="row bite">
  
    <div id="newsfeed" class="col-md-8 graph bx-cnt">
        <h1>Lorem ipsum dolor sit amet.</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, quaerat in? Inventore amet eligendi cupiditate fugit aut nihil repellat debitis, nisi labore incidunt modi provident suscipit natus necessitatibus in voluptatem, ad repellendus non culpa. Nemo non at, recusandae dolore, eum, similique ratione voluptas eligendi nisi expedita fuga error! Vero facilis, optio dolore repudiandae alias officia reiciendis animi soluta commodi facere debitis sint consectetur, ducimus repellendus, porro rem! Provident esse eaque non iste, doloribus vitae repudiandae rerum eligendi quas sequi! Harum cupiditate magni commodi esse, officia, facilis quam perspiciatis dolor a earum laborum id iste accusamus fugit! Ipsa nesciunt dignissimos dolores.    </div>
        </p>
    </div>
    
    <div class="col-md-4 bx-cnt">
        <script src="{{ asset('js/stockData.js') }}" type="text/javascript"></script>
        <div>
            <ul id="data"></ul>
        </div>
    </div>

</div>


@endsection