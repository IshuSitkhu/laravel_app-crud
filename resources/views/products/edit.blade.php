<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit a product</h1>
    <form method="post" action= "{{route('product.update',['product'=> $product])}}">
        <!-- inorder to print error -->
        <div>
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>

            @endif
        </div>
        @csrf
        @method('put')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter your name" value="{{$product->name}}" /> 

            <label>Quality</label>
            <input type="text" name="qty" placeholder="Enter quality" value="{{$product->qty}}" /> 

            <label>Price</label>
            <input type="text" name="price" placeholder="Enter Price" value="{{$product->price}}" /> 

            <label>Description</label>
            <input type="text" name="description" placeholder="Description" value="{{$product->description}}" /> 

            
        </div>

        <div>
            <input type="submit" value=" Edit product"/>
        </div>
        


    </form>
</body>
</html>