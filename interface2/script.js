const botao = document.querySelector('.botao-menu');
const menulateral = document.querySelector('.menu-lateral');
const fundo = document.querySelector('.fundo');


botao.addEventListener('click', () => {
    menulateral.classList.toggle('ativo')
    botao.classList.toggle('ativo')    
    fundo.classList.toggle('ativo')
    
    
})
fundo.addEventListener('click', () => {
    menulateral.classList.remove('ativo')
    botao.classList.remove('ativo')   
    fundo.classList.remove('ativo')
})
