const nom = document.querySelector('#nom');
const apeP = document.querySelector('#apep');
const apeM = document.querySelector('#apem');
const area = document.querySelector('#area');
const tipo = document.querySelector('#tipo');

//funcion de cambio de minusculas a mayusculas

mayus = ( nodo )=>{ 
    let dato = nodo.value;
    dato = dato.toUpperCase();
    nodo.value = dato;
}

//enventos para hacer el cambio

nom.addEventListener('blur', ()=>{
    mayus( nom );
});

apeP.addEventListener('blur', ()=>{
    mayus( apeP );
})

apeM.addEventListener('blur', ()=>{
    mayus( apeM );
});

area.addEventListener('blur', ()=>{
    mayus( area );
});

tipo.addEventListener('blur', ()=>{
    mayus( tipo );
});

