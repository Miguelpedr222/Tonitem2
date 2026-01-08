function filtrarProdutos(event) {
  event.preventDefault();
  
  const termo = document.getElementById('pesquisa').value.toLowerCase();
  const categoria = document.getElementById('categoria').value;
  const produtos = document.querySelectorAll('.produto');

  produtos.forEach(produto => {
    const titulo = produto.querySelector('h3').textContent.toLowerCase();
    const categoriaProduto = produto.getAttribute('data-categoria');

    const correspondeTermo = titulo.includes(termo);
    const correspondeCategoria = !categoria || categoria === categoriaProduto;

    if (correspondeTermo && correspondeCategoria) {
      produto.style.display = 'block';
    } else {
      produto.style.display = 'none';
    }
  });
}
