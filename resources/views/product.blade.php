<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory Management</title>
    @vite('resources/css/app.css')
</head>

<body>

<h2 style="text-align:center">Product Inventory Management</h2>

<br>

{{-- FORM --}}
<form action="/product" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Image</label>
<input type="file" name="images[]" multiple>

    <label>Product Name</label>
    <input type="text" name="productName">

    <label>Product Price</label>
    <input type="text" name="productPrice">

    <label>Type</label>
    <select name="type">
        <option value="香皂花">香皂花</option>
        <option value="扭扭棒">扭扭棒</option>
        <option value="真花">真花</option>
    </select>

    <label>Description</label>
    <input type="text" name="productDesc">

    <button type="submit">Add Product</button>


  <label>Upload Excel File</label>
<input type="file" name="excelFile" accept=".xlsx,.xls">
    <button type="submit">Add file</button>

</form>
<br>


</body>
</html>

