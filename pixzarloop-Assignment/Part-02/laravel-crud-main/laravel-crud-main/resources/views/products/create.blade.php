<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>create a product</h1>


    <div>
        @if($errors-> any())
        <ul>
            @foreach($errors->all() as $error)

             <li>{{$error}}</li>
            @endforeach
        </ul>

        @endif
    </div>

    <form action="{{route('product.store')}}" method="post">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="name"/>
        </div>
        <div>
            <label>QTY</label>
            <input type="text" name="qty" placeholder="2"/>
        </div>
        <div>
            <label>Price</label>
            <input type="text" name="price" placeholder="20"/>
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="lorem ipsum"/>
        </div>
        <div>
            <input type="submit" value="Save"/>
        </div>
    </form>
</body>
</html>