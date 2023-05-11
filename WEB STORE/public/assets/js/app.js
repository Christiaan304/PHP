/* app.js */

function addToCart(id) {
    axios.defaults.withCredentials = true;
    axios.get('?a=add_to_cart&id=' + id).then(function (response) {
        var cart = response.data;
        document.getElementById('quantityCart').innerText = cart;
    });
}

function otherData() {
    /*
    busca os dados dos inputs
    envia por axios via post para o metodo do controller
    metodo do controller recebe os dados e coloca na sessão
    */

    axios.defaults.withCredentials = true;
    axios({
        method: 'post',
        url: '?a=other_data',
        data: {
            email: document.getElementById('inputEmailOther').value,
            phone: document.getElementById('inputPhoneOther').value,
            address: document.getElementById('inputAddressOther').value,
            city: document.getElementById('inputCityOther').value
        }
    });
}

function toggleOtherAddress() {
    //mostrar ou esconder o campo do  endereço
    var e = document.getElementById('check_other_address');

    if (e.checked) {
        document.getElementById('other_address').style.display = 'block';
    }
    else {
        document.getElementById('other_address').style.display = 'none';
    }
}