var shopCart = document.getElementById('shop-cart');
var shopCartContent = document.getElementById('shop-cart-content');


document.getElementById('btn-shop-cart').onclick = () => {
    console.log('shop')
    shopCart.classList.toggle('d-none');
}
