const nom = document.querySelector('#nomJ');
const apeP = document.querySelector('#apepJ');
const apeM = document.querySelector('#apemJ');
const area = document.querySelector('#areaJ');
const tipo = document.querySelector('#tipoJ');

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

