const botao = document.querySelector('.botao-menu');
const menulateral = document.querySelector('.menu-lateral');
const fundo = document.querySelector('.fundo');


botao.addEventListener('click', () => {
    menulateral.classList.toggle('ativo')
    botao.classList.toggle('ativo')    
    fundo.classList.toggle('ativo')
    document.body.style.backgroundColor = menulateral.classList.contains("ativo") ? '#34495e' : '#ecf0f1'
    
})
fundo.addEventListener('click', () => {
    menulateral.classList.remove('ativo')
    botao.classList.remove('ativo')   
    fundo.classList.remove('ativo')
})
const body = document.body;
const escuro = getComputedStyle(root).getPropertyValue('--escuro');



if (!body.classList.contains('ativo')) {
    body.style.backgroundColor = escuro;
} else {
    body.style.backgroundColor = "rgba(0,0,0,0.5";
}
