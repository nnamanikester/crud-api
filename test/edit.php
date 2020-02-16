<?php

$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1 id="pName"></h1>
    <form method="post" onsubmit="editProduct(<?php echo $id; ?>)">

        <label for="">Name: </label><br>
        <input type="text" id="name"><br>

        <label for="price">Price: </label><br>
        <input type="number" id="price"><br>

        <label for="catName">Category: </label><br>
        <input type="text" id="catName"><br>

        <label for="desc">Description: </label><br>
        <textarea name="" id="desc" cols="30" rows="10"></textarea><br>

        <button type="submit">Update</button>

    </form>
    
    <script src="app.js"></script>
    <script>
        const id = <?php echo $id; ?>;
        
        const p = {
            name: null
        };

        window.onload = function() {
            fetch(`${apiUrl}/product/read_one.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    document.querySelector('title').innerHTML = "Edit " + data.name;
                    document.querySelector('#pName').innerHTML = "Edit " + data.name;
                    document.querySelector('#name').value = data.name;
                    document.querySelector('#desc').value = data.description;
                    document.querySelector('#catName').value = data.category_name;
                    document.querySelector('#price').value = data.price;
                })
                .catch(err => {
                    console.log(err);
                })
        }
    </script>
</body>
</html>