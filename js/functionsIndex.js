function typeWriter(elemento) {
    const textoArray = elemento.innerHTML.split('');
    elemento.innerHTML = '';
    textoArray.forEach((letra, i) => {
      setTimeout(() => elemento.innerHTML += letra, 38 * i);
    });
  }

  const titulo = document.querySelector('h1');
  typeWriter(titulo);