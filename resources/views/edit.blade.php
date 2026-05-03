<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css'])
    <title>Edit product</title>
</head>
<body>

<h2>Edit product</h2>
<p style="color:red;">
    FORM ACTION: /update/{{ $product->id }}
</p>
<form action="/update/{{ $product->id }}" method="POST" enctype="multipart/form-data">
    @csrf

    <p>Upload new images (optional)</p>
    <input type="file" name="images[]" multiple>

    <br><br>

    <input type="text" name="productName" value="{{ $product->productName }}" placeholder="Product Name">

    <br><br>

    <input type="number" name="productPrice" value="{{ $product->productPrice }}" placeholder="Price">

    <br><br>

    <input type="text" name="productDesc" value="{{ $product->productDesc }}" placeholder="Description">

    <br><br>

    <select name="type" style="width:200px; padding:8px;">
        <option value="soap_flower" {{ $product->type == 'soap_flower' ? 'selected' : '' }}>Soap Flower</option>
        <option value="twist_stick" {{ $product->type == 'twist_stick' ? 'selected' : '' }}>Twist Stick</option>
        <option value="real_flower" {{ $product->type == 'real_flower' ? 'selected' : '' }}>Real Flower</option>
    </select>

    <br><br>

    <button type="submit">Update</button>
</form>

<br><br>

<form action="/delete/{{ $product->id }}" method="POST">
    @csrf
    <button type="submit" onclick="return confirm('Are you sure to delete?')">
        Delete
    </button>
</form>

</body>
</html>
