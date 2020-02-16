const apiUrl = "http://localhost/crud-api/api";

const productList = document.querySelector('#data');

window.onload = function() {
    fetch(`${apiUrl}/product/read.php`)
        .then(res => res.json())
        .then(data => {
            data.records.forEach(p => {
                productListData = document.createElement('tr');
                productListData.innerHTML = `
                    <td>${p.id}</th>
                    <td>${p.name}</td>
                    <td>${p.description}</td>
                    <td>${p.price}</td>
                    <td>${p.category_name}</td>
                    <td>
                        <b><a href="#" onclick="editProduct(${p.id})">edit</a></b> |
                        <b><a href="#" onclick="deleteProduct(${p.id})">delete</a><?b>
                    </td>
                `;
                productList.appendChild(productListData);
            })
        })
        .catch(err => {
            console.log(err);
        })
}

function editProduct(id) {

}

function deleteProduct(id) {

}
