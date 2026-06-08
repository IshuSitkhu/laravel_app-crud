<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a product</h1>
    <form method="post" action= "{{route('product.store')}}">
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
        @method('post')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter your name"> 

            <label>Quality</label>
            <input type="text" name="qty" placeholder="Enter quality"> 

            <label>Price</label>
            <input type="text" name="price" placeholder="Enter Price"> 

            <label>Description</label>
            <input type="text" name="description" placeholder="Description"> 

            
        </div>

        <div>
            <input type="submit" value=" save a new product"/>
        </div>
        


    </form>
</body>
</html>